<?php
namespace sleptor\epayments;

use Omnipay\Tests\GatewayTestCase;
use sleptor\epayments\Message as Message;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(['amount' => '10.00']);
        $this->assertInstanceOf(Message\PurchaseRequest::class, $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase(['amount' => '10.00']);
        $this->assertInstanceOf(Message\CompletePurchaseRequest::class, $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testFetchTransaction()
    {
	//TODO
        //$request = $this->gateway->fetchTransaction(array('transactionReference' => 'abc123'));
        //$this->assertInstanceOf('sleptor\epayments\Message\FetchTransactionRequest', $request);
        //$this->assertSame('abc123', $request->getTransactionReference());
    }
}
