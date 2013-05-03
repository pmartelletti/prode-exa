<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\UserBundle\Model;

interface UserInterface extends \FOS\UserBundle\Model\UserInterface
{
    /**
     * @return string
     */
    public function getTwoStepVerificationCode();

    /**
     * @param string $code
     *
     * @return string
     */
    public function setTwoStepVerificationCode($code);
}
