<?php

use Mockery\Adapter\Phpunit\MockeryTestCase;

class OrderTest extends MockeryTestCase
{
    // public function testOrderIsProcessed()
    // {
    //     $gateway = $this->getMockBuilder('PaymentGateway')
    //         ->onlyMethods(['charge'])
    //         ->getMock();

    //     $gateway->method('charge')
    //         ->with($this->equalTo(200))
    //         ->willReturn(true);

    //     $order = new Order($gateway);

    //     $order->amount = 200;

    //     $this->assertTrue($order->process());
    // }

    public function testOrderIsProcessedUsingMockery()
    {
        $gateway = Mockery::mock('PaymentGateway');

        //instead of using the onlymethods we call shouldreceive in mockery
        $gateway->shouldReceive('charge')
        // to call the method once
            ->once()
            ->with(200)->andReturn(true);

        $order = new Order($gateway);

        $order->amount = 200;

        $this->assertTrue($order->process());
    }
}
