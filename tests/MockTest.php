<?php

use PHPUnit\Framework\TestCase;

class MockTest extends TestCase
{
    public function testMock()
    {
        //to mock a class
        $mock = $this->createMock(Mailer::class);

        //to mock the return value of a method
        $mock->method('sendMessage')
            ->willReturn(true);

        //checking the functionality using the mock we created
        $result = $mock->sendMessage('t@mail.com', 'Hello');

        $this->assertTrue($result);
    }
}
