<?php

/*
 * This file is part of the BeSimpleSoapBundle.
 *
 * (c) Christian Kerl <christian-kerl@web.de>
 * (c) Francis Besset <francis.besset@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace BeSimple\SoapBundle\ServiceBinding;

use BeSimple\SoapBundle\ServiceDefinition\Method;
use BeSimple\SoapBundle\ServiceDefinition\Strategy\PropertyComplexType;
use BeSimple\SoapBundle\ServiceDefinition\Strategy\MethodComplexType;
use BeSimple\SoapCommon\Util\MessageBinder;

/**
 * @author Christian Kerl <christian-kerl@web.de>
 * @author Francis Besset <francis.besset@gmail.com>
 */
class RpcLiteralResponseMessageBinder implements MessageBinderInterface
{
    private $messageRefs = array();
    private $definitionComplexTypes;

    public function processMessage(Method $messageDefinition, $message, array $definitionComplexTypes = array())
    {
        $this->definitionComplexTypes = $definitionComplexTypes;

        return $this->processType($messageDefinition->getReturn()->getPhpType(), $message);
    }

    private function processType($phpType, $message)
    {
        $isArray = false;

        if (preg_match('/^([^\[]+)\[\]$/', $phpType, $match)) {
            $isArray = true;
            $phpType = $match[1];
        }

        if (isset($this->definitionComplexTypes[$phpType])) {
            if ($isArray) {
                $array = array();

                // See https://github.com/BeSimple/BeSimpleSoapBundle/issues/29
                if (is_array($message) && in_array('BeSimple\SoapCommon\Type\AbstractKeyValue', class_parents($phpType))) {
                    $keyValue = array();
                    foreach ($message as $key => $value) {
                        $keyValue[] = new $phpType($key, $value);
                    }

                    $message = $keyValue;
                }

                foreach ($message as $complexType) {
                    $array[] = $this->checkComplexType($phpType, $complexType);
                }

                $message = $array;
            } else {
                $message = $this->checkComplexType($phpType, $message);
            }
        }

        return $message;
    }

    private function checkComplexType($phpType, $message)
    {
        $hash = spl_object_hash($message);
        if (isset($this->messageRefs[$hash])) {
            return $this->messageRefs[$hash];
        }

        $this->messageRefs[$hash] = $message;

        if (!$message instanceof $phpType) {
            throw new \InvalidArgumentException(sprintf('The instance class must be "%s", "%s" given.', get_class($message), $phpType));
        }

        $messageBinder = new MessageBinder($message);
        foreach ($this->definitionComplexTypes[$phpType] as $type) {
            $property = $type->getName();
            $value = $messageBinder->readProperty($property);

            if (null !== $value) {
                $value = $this->processType($type->getValue(), $value);

                $messageBinder->writeProperty($property, $value);
            }

            if (!$type->isNillable() && null === $value) {
                throw new \InvalidArgumentException(sprintf('"%s::%s" cannot be null.', $phpType, $type->getName()));
            }
        }

        return $message;
    }
}
