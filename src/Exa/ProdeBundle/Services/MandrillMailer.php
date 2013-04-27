<?php

namespace Exa\ProdeBundle\Services;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\MailerInterface;
use Hip\MandrillBundle\Message;
use Hip\MandrillBundle\Dispatcher;

use Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper;

/**
 * Description of MandrillMailer
 *
 * @author pablo
 */
class MandrillMailer implements MailerInterface {
    
    protected $mailer;
    protected $router;
    protected $twig;
    
    public function __construct(Dispatcher $mailer, RouterHelper $router, \Twig_Environment $twig) {
        $this->mailer = $mailer;
        $this->router = $router;
        $this->twig = $twig;
    }




    public function sendConfirmationEmailMessage(UserInterface $user) {
        $template = "";
        $url = $this->router->generate('fos_user_registration_confirm', array('token' => $user->getConfirmationToken()), true);
        $context = array(
            'user' => $user,
            'confirmationUrl' => $url
        );

        $this->sendMessage($template, $context, $user->getEmail());
    }

    public function sendResettingEmailMessage(UserInterface $user) {
        $template = "ExaProdeBundle:Mailing:resetting.email.twig";
        $url = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);
        $context = array(
            'user' => $user,
            'confirmationUrl' => $url
        );

        $this->sendMessage($template, $context, $user->getEmail());
    }
    
    /**
     * @param string $templateName
     * @param array  $context
     * @param string $fromEmail
     * @param string $toEmail
     */
    protected function sendMessage($templateName, $context, $toEmail)
    {   
        
        $message = new Message();
        
        $template = $this->twig->loadTemplate($templateName);
        $subject = $template->renderBlock('subject', $context);
        $textBody = $template->renderBlock('body_text', $context);
        $htmlBody = $template->renderBlock('body_html', $context);

        $message
            ->addTo($toEmail)
            ->setSubject($subject)
            ->setText($textBody)
            ->setHtml($htmlBody);

        $this->mailer->send($message);
    }
}
