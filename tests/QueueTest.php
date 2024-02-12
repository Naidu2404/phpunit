<?php

use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    //we add fixtures to avoid dependencies which we acheived by using the #[Depends('')]
    //to add a fixture we use the setUp method

    protected $queue;

    //runs before each test
    protected function setUp(): void
    {
        $this->queue = new Queue;
        // static::$queue->clear();
    }

    //runs after each test
    protected function tearDown(): void
    {
        unset($this->queue);
    }

    //the setUpBeforeClass method is run only before the first test
    //the tearDownAfterClass method is run only after the last test

    // public static function setUpBeforeClass(): void
    // {
    //     static::$queue = new Queue;
    // }

    // public static function tearDownAfterClass(): void
    // {
    //     unset(static::$queue);
    // }

    public function testNewQueueIsEmpty()
    {
        $this->assertEquals(0, $this->queue->getCount());
    }
    public function testAnItemIsAddedToTheQueue()
    {

        $this->queue->push(1);

        $this->assertEquals(1, $this->queue->getCount());
    }
    public function testAnItemIsRemovedFromTheQueue()
    {
        $this->queue->push(1);

        $item = $this->queue->pop();

        $this->assertEquals(0, $this->queue->getCount());

        $this->assertEquals(1, $item);
    }

    public function testAnItemIsRemovedFromTheFrontOfTheQueue()
    {
        $this->queue->push(1);
        $this->queue->push(2);

        $this->assertEquals(1, $this->queue->pop());
    }

    public function testMaxNumberOfItemsCanBeAdded()
    {
        for ($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            $this->queue->push($i);
        }

        $this->assertEquals(Queue::MAX_ITEMS, $this->queue->getCount());
    }

    public function testExceptionThrownWhenAddingAnItemToAFullQueue()
    {
        for ($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            $this->queue->push($i);
        }

        //to check the exception we expect the exception to be done before

        $this->expectException(QueueException::class);

        //we can check using the exception message as well

        $this->expectExceptionMessage("Queue is Full");

        $this->queue->push('x');
    }
}
