<?php

//we extend the TestCase from the php unit framework to make tha class as a test
class ExampleTest extends \PHPUnit\Framework\TestCase

{
    public function testAddingTwoPlusTwoResultsInFour()
    {
        $this->assertEquals(4, 2 + 2);
    }
}