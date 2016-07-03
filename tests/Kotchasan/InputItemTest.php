<?php

namespace Kotchasan;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-06-25 at 19:40:18.
 */
class InputItemTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var InputItem
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new InputItem();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{

	}

	/**
	 * Generated from @assert create(true)->toBoolean() [==] 1.
	 *
	 * @covers Kotchasan\InputItem::toBoolean
	 */
	public function testToBoolean()
	{

		$this->assertEquals(
			1, $this->object->create(true)->toBoolean()
		);
	}

	/**
	 * Generated from @assert create(false)->toBoolean() [==] 0.
	 *
	 * @covers Kotchasan\InputItem::toBoolean
	 */
	public function testToBoolean2()
	{

		$this->assertEquals(
			0, $this->object->create(false)->toBoolean()
		);
	}

	/**
	 * Generated from @assert create(1)->toBoolean() [==] 1.
	 *
	 * @covers Kotchasan\InputItem::toBoolean
	 */
	public function testToBoolean3()
	{

		$this->assertEquals(
			1, $this->object->create(1)->toBoolean()
		);
	}

	/**
	 * Generated from @assert create(0)->toBoolean() [==] 0.
	 *
	 * @covers Kotchasan\InputItem::toBoolean
	 */
	public function testToBoolean4()
	{

		$this->assertEquals(
			0, $this->object->create(0)->toBoolean()
		);
	}

	/**
	 * Generated from @assert create(null)->toBoolean() [==] 0.
	 *
	 * @covers Kotchasan\InputItem::toBoolean
	 */
	public function testToBoolean5()
	{

		$this->assertEquals(
			0, $this->object->create(null)->toBoolean()
		);
	}

	/**
	 * Generated from @assert create(0.454)->toDouble() [==] 0.454.
	 *
	 * @covers Kotchasan\InputItem::toDouble
	 */
	public function testToDouble()
	{

		$this->assertEquals(
			0.454, $this->object->create(0.454)->toDouble()
		);
	}

	/**
	 * Generated from @assert create(0.545)->toDouble() [==] 0.545.
	 *
	 * @covers Kotchasan\InputItem::toDouble
	 */
	public function testToDouble2()
	{

		$this->assertEquals(
			0.545, $this->object->create(0.545)->toDouble()
		);
	}

	/**
	 * Generated from @assert create(0.454)->toFloat() [==] 0.454.
	 *
	 * @covers Kotchasan\InputItem::toFloat
	 */
	public function testToFloat()
	{

		$this->assertEquals(
			0.454, $this->object->create(0.454)->toFloat()
		);
	}

	/**
	 * Generated from @assert create(0.545)->toFloat() [==] 0.545.
	 *
	 * @covers Kotchasan\InputItem::toFloat
	 */
	public function testToFloat2()
	{

		$this->assertEquals(
			0.545, $this->object->create(0.545)->toFloat()
		);
	}

	/**
	 * Generated from @assert create(0.454)->toInt() [==] 0.
	 *
	 * @covers Kotchasan\InputItem::toInt
	 */
	public function testToInt()
	{

		$this->assertEquals(
			0, $this->object->create(0.454)->toInt()
		);
	}

	/**
	 * Generated from @assert create(2.945)->toInt() [==] 2.
	 *
	 * @covers Kotchasan\InputItem::toInt
	 */
	public function testToInt2()
	{

		$this->assertEquals(
			2, $this->object->create(2.945)->toInt()
		);
	}

	/**
	 * Generated from @assert create('test')->toObject() [==] (object)'test'.
	 *
	 * @covers Kotchasan\InputItem::toObject
	 */
	public function testToObject()
	{

		$this->assertEquals(
			(object)'test', $this->object->create('test')->toObject()
		);
	}

	/**
	 * Generated from @assert create('ทดสอบ')->toString() [==] 'ทดสอบ'.
	 *
	 * @covers Kotchasan\InputItem::toString
	 */
	public function testToString()
	{

		$this->assertEquals(
			'ทดสอบ', $this->object->create('ทดสอบ')->toString()
		);
	}

	/**
	 * Generated from @assert create('1')->toString() [==] '1'.
	 *
	 * @covers Kotchasan\InputItem::toString
	 */
	public function testToString2()
	{

		$this->assertEquals(
			'1', $this->object->create('1')->toString()
		);
	}

	/**
	 * Generated from @assert create(1)->toString() [==] '1'.
	 *
	 * @covers Kotchasan\InputItem::toString
	 */
	public function testToString3()
	{

		$this->assertEquals(
			'1', $this->object->create(1)->toString()
		);
	}

	/**
	 * Generated from @assert create(null)->toString() [==] null.
	 *
	 * @covers Kotchasan\InputItem::toString
	 */
	public function testToString4()
	{

		$this->assertEquals(
			null, $this->object->create(null)->toString()
		);
	}

	/**
	 * Generated from @assert create(' ทด\/สอบ'."\r\n\t".'<?php echo \'555\'?> ')->topic() [==] 'ทด&#92;/สอบ &lt;?php echo &#039;555&#039;?&gt;'.
	 *
	 * @covers Kotchasan\InputItem::topic
	 */
	public function testTopic()
	{

		$this->assertEquals(
			'ทด&#92;/สอบ &lt;?php echo &#039;555&#039;?&gt;', $this->object->create(' ทด\/สอบ'."\r\n\t".'<?php echo \'555\'?> ')->topic()
		);
	}

	/**
	 * Generated from @assert create(" http://www.kotchasan.com?a=1&b=2&amp;c=3 ")->url() [==] 'http://www.kotchasan.com?a=1&amp;b=2&amp;c=3'.
	 *
	 * @covers Kotchasan\InputItem::url
	 */
	public function testUrl()
	{

		$this->assertEquals(
			'http://www.kotchasan.com?a=1&amp;b=2&amp;c=3', $this->object->create(" http://www.kotchasan.com?a=1&b=2&amp;c=3 ")->url()
		);
	}

	/**
	 * Generated from @assert create("javascript:alert('xxx')")->url() [==] 'alertxxx'.
	 *
	 * @covers Kotchasan\InputItem::url
	 */
	public function testUrl2()
	{

		$this->assertEquals(
			'alertxxx', $this->object->create("javascript:alert('xxx')")->url()
		);
	}

	/**
	 * Generated from @assert create("http://www.xxx.com/javascript/")->url() [==] 'http://www.xxx.com/javascript/'.
	 *
	 * @covers Kotchasan\InputItem::url
	 */
	public function testUrl3()
	{

		$this->assertEquals(
			'http://www.xxx.com/javascript/', $this->object->create("http://www.xxx.com/javascript/")->url()
		);
	}

	/**
	 * Generated from @assert create(' admin@demo.com')->username() [==] 'admin@demo.com'.
	 *
	 * @covers Kotchasan\InputItem::username
	 */
	public function testUsername()
	{

		$this->assertEquals(
			'admin@demo.com', $this->object->create(' admin@demo.com')->username()
		);
	}

	/**
	 * Generated from @assert create('012 3465')->username() [==] '0123465'.
	 *
	 * @covers Kotchasan\InputItem::username
	 */
	public function testUsername2()
	{

		$this->assertEquals(
			'0123465', $this->object->create('012 3465')->username()
		);
	}

	/**
	 * Generated from @assert create(" 0\n12   34\r\r6\t5 ")->password() [==] '0123465'.
	 *
	 * @covers Kotchasan\InputItem::password
	 */
	public function testPassword()
	{

		$this->assertEquals(
			'0123465', $this->object->create(" 0\n12   34\r\r6\t5 ")->password()
		);
	}

	/**
	 * Generated from @assert create(" ทด\/สอบ<?php echo '555'?> ")->text() [==] 'ทด&#92;/สอบ&lt;?php echo &#039;555&#039;?&gt;'.
	 *
	 * @covers Kotchasan\InputItem::text
	 */
	public function testText()
	{

		$this->assertEquals(
			'ทด&#92;/สอบ&lt;?php echo &#039;555&#039;?&gt;', $this->object->create(" ทด\/สอบ<?php echo '555'?> ")->text()
		);
	}

	/**
	 * Generated from @assert create("ทด\/สอบ\n<?php echo '555'?>")->textarea() [==] "ทด&#92;/สอบ\n&lt;?php echo '555'?&gt;".
	 *
	 * @covers Kotchasan\InputItem::textarea
	 */
	public function testTextarea()
	{

		$this->assertEquals(
			"ทด&#92;/สอบ\n&lt;?php echo '555'?&gt;", $this->object->create("ทด\/สอบ\n<?php echo '555'?>")->textarea()
		);
	}

	/**
	 * Generated from @assert create('ทด\/สอบ<?php echo "555"?>')->description() [==] 'ทด สอบ'.
	 *
	 * @covers Kotchasan\InputItem::description
	 */
	public function testDescription()
	{

		$this->assertEquals(
			'ทด สอบ', $this->object->create('ทด\/สอบ<?php echo "555"?>')->description()
		);
	}

	/**
	 * Generated from @assert create('ทด\/สอบ<style>body {color: red}</style>')->description() [==] 'ทด สอบ'.
	 *
	 * @covers Kotchasan\InputItem::description
	 */
	public function testDescription2()
	{

		$this->assertEquals(
			'ทด สอบ', $this->object->create('ทด\/สอบ<style>body {color: red}</style>')->description()
		);
	}

	/**
	 * Generated from @assert create('ทด\/สอบ<b>ตัวหนา</b>')->description() [==] 'ทด สอบตัวหนา'.
	 *
	 * @covers Kotchasan\InputItem::description
	 */
	public function testDescription3()
	{

		$this->assertEquals(
			'ทด สอบตัวหนา', $this->object->create('ทด\/สอบ<b>ตัวหนา</b>')->description()
		);
	}

	/**
	 * Generated from @assert create('ทด\/สอบ{LNG_Language name}')->description() [==] 'ทด สอบ'.
	 *
	 * @covers Kotchasan\InputItem::description
	 */
	public function testDescription4()
	{

		$this->assertEquals(
			'ทด สอบ', $this->object->create('ทด\/สอบ{LNG_Language name}')->description()
		);
	}

	/**
	 * Generated from @assert create('ทด\/สอบ[code]ตัวหนา[/code]')->description() [==] 'ทด สอบ'.
	 *
	 * @covers Kotchasan\InputItem::description
	 */
	public function testDescription5()
	{

		$this->assertEquals(
			'ทด สอบ', $this->object->create('ทด\/สอบ[code]ตัวหนา[/code]')->description()
		);
	}

	/**
	 * Generated from @assert create('ทด\/สอบ[b]ตัวหนา[/b]')->description() [==] 'ทด สอบตัวหนา'.
	 *
	 * @covers Kotchasan\InputItem::description
	 */
	public function testDescription6()
	{

		$this->assertEquals(
			'ทด สอบตัวหนา', $this->object->create('ทด\/สอบ[b]ตัวหนา[/b]')->description()
		);
	}

	/**
	 * Generated from @assert create('ท&amp;ด&quot;\&nbsp;/__ส-อ+บ')->description() [==] 'ท ด ส อ บ'.
	 *
	 * @covers Kotchasan\InputItem::description
	 */
	public function testDescription7()
	{

		$this->assertEquals(
			'ท ด ส อ บ', $this->object->create('ท&amp;ด&quot;\&nbsp;/__ส-อ+บ')->description()
		);
	}

	/**
	 * Generated from @assert create('ทด\/สอบ<?php echo "555"?>')->detail() [==] 'ทด&#92;/สอบ'.
	 *
	 * @covers Kotchasan\InputItem::detail
	 */
	public function testDetail()
	{

		$this->assertEquals(
			'ทด&#92;/สอบ', $this->object->create('ทด\/สอบ<?php echo "555"?>')->detail()
		);
	}

	/**
	 * Generated from @assert create("<b>ทด</b>   \r\nสอบ")->keywords() [==] 'ทด สอบ'.
	 *
	 * @covers Kotchasan\InputItem::keywords
	 */
	public function testKeywords()
	{

		$this->assertEquals(
			'ทด สอบ', $this->object->create("<b>ทด</b>   \r\nสอบ")->keywords()
		);
	}

	/**
	 * Generated from @assert create("ทด'สอบ")->quote() [==] "ทด&#39;สอบ".
	 *
	 * @covers Kotchasan\InputItem::quote
	 */
	public function testQuote()
	{

		$this->assertEquals(
			"ทด&#39;สอบ", $this->object->create("ทด'สอบ")->quote()
		);
	}

	/**
	 * Generated from @assert create('admin,1234')->filter('0-9a-zA-Z,') [==] 'admin,1234'.
	 *
	 * @covers Kotchasan\InputItem::filter
	 */
	public function testFilter()
	{

		$this->assertEquals(
			'admin,1234', $this->object->create('admin,1234')->filter('0-9a-zA-Z,')
		);
	}

	/**
	 * Generated from @assert create('adminกข,12ฟ34')->filter('0-9a-zA-Z,') [==] 'admin,1234'.
	 *
	 * @covers Kotchasan\InputItem::filter
	 */
	public function testFilter2()
	{

		$this->assertEquals(
			'admin,1234', $this->object->create('adminกข,12ฟ34')->filter('0-9a-zA-Z,')
		);
	}

	/**
	 * Generated from @assert create('2016-01-01 20:20:20')->date() [==] '2016-01-01 20:20:20'.
	 *
	 * @covers Kotchasan\InputItem::date
	 */
	public function testDate()
	{

		$this->assertEquals(
			'2016-01-01 20:20:20', $this->object->create('2016-01-01 20:20:20')->date()
		);
	}

	/**
	 * Generated from @assert create('#000')->color() [==] '#000'.
	 *
	 * @covers Kotchasan\InputItem::color
	 */
	public function testColor()
	{

		$this->assertEquals(
			'#000', $this->object->create('#000')->color()
		);
	}

	/**
	 * Generated from @assert create('red')->color() [==] 'red'.
	 *
	 * @covers Kotchasan\InputItem::color
	 */
	public function testColor2()
	{

		$this->assertEquals(
			'red', $this->object->create('red')->color()
		);
	}

	/**
	 * Generated from @assert create(12345)->number() [==] '12345'.
	 *
	 * @covers Kotchasan\InputItem::number
	 */
	public function testNumber()
	{

		$this->assertEquals(
			'12345', $this->object->create(12345)->number()
		);
	}

	/**
	 * Generated from @assert create(0.12345)->number() [==] '012345'.
	 *
	 * @covers Kotchasan\InputItem::number
	 */
	public function testNumber2()
	{

		$this->assertEquals(
			'012345', $this->object->create(0.12345)->number()
		);
	}

	/**
	 * Generated from @assert create(ทด0123สอ4บ5)->number() [==] '012345'.
	 *
	 * @covers Kotchasan\InputItem::number
	 */
	public function testNumber3()
	{

		$this->assertEquals(
			'012345', $this->object->create(ทด0123สอ4บ5)->number()
		);
	}

	/**
	 * @covers Kotchasan\InputItem::create
	 * @todo   Implement testCreate().
	 */
	public function testCreate()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Kotchasan\InputItem::all
	 * @todo   Implement testAll().
	 */
	public function testAll()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Kotchasan\InputItem::isGet
	 * @todo   Implement testIsGet().
	 */
	public function testIsGet()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Kotchasan\InputItem::isPost
	 * @todo   Implement testIsPost().
	 */
	public function testIsPost()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Kotchasan\InputItem::isSession
	 * @todo   Implement testIsSession().
	 */
	public function testIsSession()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Kotchasan\InputItem::isCookie
	 * @todo   Implement testIsCookie().
	 */
	public function testIsCookie()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Kotchasan\InputItem::isDefault
	 * @todo   Implement testIsDefault().
	 */
	public function testIsDefault()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}
}