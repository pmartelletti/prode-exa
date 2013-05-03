HipMandrillBundle
=================

[![Build Status](https://api.travis-ci.org/Hipaway-Travel/HipMandrillBundle.png?branch=master)] (http://travis-ci.org/Hipaway-Travel/HipMandrillBundle)

Send transactional mail through mandrill.com. This bundle provides an easy api for Symfony2 Projects.

All settings inside message class represent attributes of Mandrill's API. Please refer to their API documentation for Details:

https://mandrillapp.com/api/docs/messages.html

Prerequisites
-------------

Before you're able to use this bundle you must sign up with Mandrill.

http://mandrill.com

Mandrill is a great way to send your transactional emails and provides detailed advances reports.

Mandrill is free for limited number of email per day, please read through pricing section on the website for more information:

http://mandrill.com/pricing/

Installation
-----------

Add the bundle to your composer.json

```json
# composer.json
{
 "require": {
     "hipaway-travel/mandrill-bundle": "dev-master",
 }
}
```

Run composer install

```sh
php ./composer.phar install
```

Enable the bundle in the kernel

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Hip\MandrillBundle\HipMandrillBundle(),
        );
    }

Configuration
-------------

Add configuration to config.yml.

Log in to Mandrill and go to "Settings" -> "SMTP and API Credentials". Create an API Key and use it in your Symfony2 Configuration.

```yaml
# config.yml

hip_mandrill:
    api_key: xxxxx
    default:
        sender: info@example.com
        sender_name: John Doe
```

Now you're all set, send your first transactional mails:

Use
---

Simple controller Example:

```php

<?php

// src/Hip/ExampleBundle/Controller/ExampleController.php
namespace Hip\ExampleBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Hip\MandrillBundle\Message;
use Hip\MandrillBundle\Dispatcher;

class ExampleController
{
    public function indexAction()
    {
        $dispatcher = $this->get('hip_mandrill.dispatcher');

        $message = new Message();

        $message
            ->setFromEmail('mail@example.com')
            ->setFromName('Customer Care')
            ->addTo('max.customer@email.com')
            ->setSubject('Some Subject')
            ->setHtml('<html><body><h1>Some Content</h1></body></html>');

        $result = $dispatcher->send($message);

        return new Response('<pre>' . print_r($result, true) . '</pre>');

    }

}

```
