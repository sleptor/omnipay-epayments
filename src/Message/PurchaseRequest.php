<?php

namespace sleptor\epayments\Message;

/**
 * Purchase Request
 */
class PurchaseRequest extends \Omnipay\Common\Message\AbstractRequest
{
    public function getPartnerId()
    {
        return $this->getParameter('partnerId');
    }

    public function setPartnerId($value)
    {
        return $this->setParameter('partnerId', $value);
    }

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    public function getDetails()
    {
        return $this->getParameter('details');
    }

    public function setDetails($value)
    {
        return $this->setParameter('details', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    public function getNickName()
    {
        return $this->getParameter('NickName');
    }

    public function setNickName($value)
    {
        return $this->setParameter('NickName', $value);
    }

    public function getSign()
    {
        $parts = [
            $this->getPartnerId(),
            $this->getSecret(),
            $this->getOrderId(),
            $this->getAmount(),
            $this->getCurrency(),
        ];
        return md5(implode(';', $parts));
    }

    public function getData()
    {
        $this->validate('partnerId', 'secret', 'orderId', 'amount', 'currency', 'details');

        $data = [];
        $data['partnerid'] = $this->getPartnerId();
        $data['orderid'] = $this->getOrderId();
        $data['amount'] = $this->getAmount();
        $data['currency'] = $this->getCurrency();
        $data['sign'] = $this->getSign();
        $data['nickname'] = $this->getNickName();
        $data['details'] = $this->getDetails();
        $data['successurl'] = $this->getReturnUrl();
        $data['declineurl'] = $this->getCancelUrl();

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
