<?php

namespace Kumatch\Test\Purity;

use Kumatch\Purity\Purity;

class PurityTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    public function testStart()
    {
        $this->assertInstanceOf('\Kumatch\Purity\Purity', Purity::start(null));
    }

    public function testToBlank()
    {
        $purity = new Purity(null);

        $this->assertEquals('', $purity->toBlank()->getValue());

        $purity = new Purity(0);

        $this->assertEquals(0, $purity->toBlank()->getValue());
        $this->assertEquals('', $purity->toBlank(array(null, 0))->getValue());
    }

    public function testToNull()
    {
        $purity = new Purity('');

        $this->assertNull($purity->toNull()->getValue());

        $purity = new Purity(0);

        $this->assertEquals(0, $purity->toBlank()->getValue());
        $this->assertNull($purity->toNull(array('', 0))->getValue());
    }

    public function testToBoolean()
    {
        $purity = new Purity('');
        $this->assertFalse($purity->toBoolean()->getValue());
        $purity = new Purity(null);
        $this->assertFalse($purity->toBoolean()->getValue());
        $purity = new Purity(0);
        $this->assertFalse($purity->toBoolean()->getValue());
        $purity = new Purity('0');
        $this->assertFalse($purity->toBoolean()->getValue());
        $purity = new Purity(false);
        $this->assertFalse($purity->toBoolean()->getValue());
        $purity = new Purity('false');
        $this->assertFalse($purity->toBoolean()->getValue());

        $purity = new Purity('1');
        $this->assertTrue($purity->toBoolean()->getValue());
        $purity = new Purity(1);
        $this->assertTrue($purity->toBoolean()->getValue());
        $purity = new Purity(true);
        $this->assertTrue($purity->toBoolean()->getValue());
        $purity = new Purity('true');
        $this->assertTrue($purity->toBoolean()->getValue());
        $purity = new Purity('on');
        $this->assertTrue($purity->toBoolean()->getValue());
        $purity = new Purity('off');
        $this->assertTrue($purity->toBoolean()->getValue());
    }

    public function testToDefault()
    {
        $default = 42;

        $purity = new Purity('');
        $this->assertEquals($default, $purity->toDefault($default)->getValue());

        $purity = new Purity(null);
        $this->assertEquals($default, $purity->toDefault($default)->getValue());

        $purity = new Purity(false);
        $this->assertNotEquals($default, $purity->toDefault($default)->getValue());
        $this->assertEquals($default, $purity->toDefault($default, array(false, null, ''))->getValue());
    }
}