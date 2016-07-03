<?php

namespace Kotchasan;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-02-19 at 08:22:57.
 */
class ObjectTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Object
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new Object;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{

	}

	/**
	 * Generated from @assert ((object)array('one' => 1), array('two' => 2)) [==] (object)array('one' => 1, 'two' => 2).
	 *
	 * @covers Kotchasan\Object::replace
	 */
	public function testReplace()
	{

		$this->assertEquals(
		(object)array('one' => 1, 'two' => 2), \Kotchasan\Object::replace((object)array('one' => 1), array('two' => 2))
		);
	}

	/**
	 * Generated from @assert ((object)array('one' => 1), (object)array('two' => 2)) [==] (object)array('one' => 1, 'two' => 2).
	 *
	 * @covers Kotchasan\Object::replace
	 */
	public function testReplace2()
	{

		$this->assertEquals(
		(object)array('one' => 1, 'two' => 2), \Kotchasan\Object::replace((object)array('one' => 1), (object)array('two' => 2))
		);
	}
}