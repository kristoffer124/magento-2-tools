# **Output email to local file**

```

<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ;

use Zend\Mime\Mime;
use Zend\Mime\Part;

/**
 * Class Message for email transportation
 */
class Magento\Framework\Mail\Message implements MailMessageInterface{
...
    public function getBody()
    {
        $body = $this->zendMessage->getBody()
        file_put_contents('/var/www/email.html', $body);
        return $body;
    }
...

}


```