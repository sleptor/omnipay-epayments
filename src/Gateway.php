<?php

namespace sleptor\epayments;

use Omnipay\Common\AbstractGateway;
use sleptor\epayments\Message as Message;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'ePayments';
    }

    public function getDefaultParameters()
    {
        return [
        ];
    }

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    public function getPartnerId()
    {
        return $this->getParameter('partnerId');
    }

    public function setPartnerId($value)
    {
        return $this->setParameter('partnerId', $value);
    }

    public function getNickName()
    {
        return $this->getParameter('NickName');
    }

    public function setNickName($value)
    {
        return $this->setParameter('NickName', $value);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

    public function getCancelUrl()
    {
        return $this->getParameter('cancelUrl');
    }

    public function setCancelUrl($value)
    {
        return $this->setParameter('cancelUrl', $value);
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest(Message\PurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(Message\CompletePurchaseRequest::class,
            $parameters);
    }
}