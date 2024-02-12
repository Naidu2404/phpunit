<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testReturnsFullName()
    {

        $user = new User;
        $user->first_name = "Mother";
        $user->surname = "Teresa";

        $this->assertEquals("Mother Teresa", $user->getFullName());
    }

    public function testFullNameIsEmptyByDefault()
    {

        $user = new User;

        $this->assertEquals("", $user->getFullName());
    }

    public function testNotificationIsSent()
    {
        $user = new User;

        //we need to mock the mailer here
        $mock_mailer = $this->createMock(Mailer::class);

        //we can expect how many times this method is called
        //we can also expect the values which we were sent
        $mock_mailer->expects($this->once())
            ->method('sendMessage')
            ->with($this->equalTo('t@mail.com'), $this->equalTo('Hello'))
            ->willReturn(true);

        $user->setMailer($mock_mailer);

        $user->email = "t@mail.com";

        $this->assertTrue($user->notify("Hello"));
    }

    public function testCannotNotifyUserWithNoEmail()
    {
        $user = new User;
        //instead of creating like this we can use getMockBuilder->getMock()
        //to add the mock functionality to the created mock same as original
        $mock_mailer = $this->createMock(Mailer::class);

        //we can mock the exception thrown as well
        $mock_mailer->method('sendMessage')
            ->will($this->throwException(new Exception));

        // $mock_mailer = $this->getMockBuilder(Mailer::class)
        //     ->onlyMethods([])
        //     ->getMock();

        $user->setMailer($mock_mailer);

        $this->expectException(Exception::class);

        $user->notify("Hello");
    }

}