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

}