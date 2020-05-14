<?php

namespace Kristoffer\PageTypes\Controller\PageType;

use Magento\Framework\Controller\ResultFactory as resultFactory;

class ReturnPageType extends \Magento\Framework\App\Action\Action
{
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        resultFactory $resultFactory
    ) {
        parent::__construct($context);
        $this->resultFactory = $resultFactory;
    }

    public function execute()
    {
        $type = $this->getRequest()->getParam('type');

        switch ($type) {
            case "json":
                $resultJson = $this->resultFactory->create(
                    resultFactory::TYPE_JSON
                );

                $resultJson->setData(
                    [
                        'success'=>true
                    ]
                );

                return $resultJson;
            case "raw":
                $resultRaw = $this->resultFactory->create(
                    resultFactory::TYPE_RAW
                );
                $resultRaw->setHeader('Content-Type', 'text/xml');
                $resultRaw->setContents('<root><success>true</success></root>');

                return $resultRaw;
            case "redirect":
                $resultRedirect = $this->resultFactory->create(
                    resultFactory::TYPE_REDIRECT
                );

                $resultRedirect->setPath(
                    'home'
                );

                return $resultRedirect;
            case "forward":
            case "page":

        }




    }
}
