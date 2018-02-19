<?php

namespace sleptor\epayments\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 *  Purchase Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function getEndpoint()
    {
        if ($this->getRequest()->getTestMode()) {
            return 'https://api.sandbox.epayments.com/merchant/prepare';
        } else {
            return 'https://api.epayments.com/merchant/prepare';
        }
    }

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->getEndpoint();
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->data;
    }
}
