<?php

namespace sleptor\epayments\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * CompletePurchaseResponse constructor.
     * @param RequestInterface $request
     * @param mixed $data
     * @throws \Exception
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        if ($this->getCode()) {
            $parts = [
                $this->getOrderId(),
                $this->getCode(),
                $this->request->getSecret(),
            ];
        } else {
            $parts = [
                $this->getOrderId(),
                $this->getTransactionReference(),
                $this->request->getSecret(),
            ];
        }

        $sign = md5(implode(';', $parts));

        if (!isset($this->data['sign']) || $this->data['sign'] !== strtoupper($sign)) {
            throw new \Exception('bad signature');
        }
    }

    public function getMessage()
    {
        return $this->data['msg'] ?? 'Something went wrong';
    }

    public function getCode()
    {
        return $this->data['code'] ?? null;
    }

    public function getOrderId()
    {
        return $this->data['orderId'] ?? null;
    }

    public function isSuccessful()
    {
        return $this->getTransactionReference() !== null;
    }

    public function getTransactionReference()
    {
        return $this->data['transactionId'] ?? null;
    }

    public function isRedirect()
    {
        return false;
    }
}
