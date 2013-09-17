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
        $this->assertEquals('', Purity::start(null)->toBlank()->getValue());

        $this->assertEquals(0,  Purity::start(0)->toBlank()->getValue());
        $this->assertEquals('', Purity::start(0)->toBlank(array(null, 0))->getValue());
    }

    public function testToNull()
    {
        $this->assertNull(Purity::start('')->toNull()->getValue());

        $this->assertEquals(0, Purity::start(0)->toNull()->getValue());
        $this->assertNull(Purity::start(0)->toNull(array('', 0))->getValue());
    }

    public function testToBoolean()
    {
        $this->assertFalse(Purity::start('')->toBoolean()->getValue());
        $this->assertFalse(Purity::start(null)->toBoolean()->getValue());
        $this->assertFalse(Purity::start(0)->toBoolean()->getValue());
        $this->assertFalse(Purity::start(0)->toBoolean()->getValue());
        $this->assertFalse(Purity::start(false)->toBoolean()->getValue());
        $this->assertFalse(Purity::start('false')->toBoolean()->getValue());

        $this->assertTrue(Purity::start('1')->toBoolean()->getValue());
        $this->assertTrue(Purity::start(1)->toBoolean()->getValue());
        $this->assertTrue(Purity::start(true)->toBoolean()->getValue());
        $this->assertTrue(Purity::start('true')->toBoolean()->getValue());
        $this->assertTrue(Purity::start('on')->toBoolean()->getValue());
        $this->assertTrue(Purity::start('off')->toBoolean()->getValue());
    }

    public function testToInteger()
    {

    }

    public function testToDefault()
    {
        $default = 42;

        $this->assertEquals($default, Purity::start('')->toDefault($default)->getValue());
        $this->assertEquals($default, Purity::start(null)->toDefault($default)->getValue());

        $this->assertNotEquals($default, Purity::start(false)->toDefault($default)->getValue());
        $this->assertEquals($default, Purity::start(false)->toDefault($default, array(false, null, ''))->getValue());
    }

    public function testTrim()
    {
        $value = "\0\r\n\t OK\t\0 \n\r";

        $this->assertEquals("OK", Purity::start($value)->trim()->getValue());
        $this->assertEquals("\t OK\t", Purity::start($value)->trim(" \n\r\0")->getValue());
        $this->assertEquals("\t OK\t", Purity::start($value)->trim(array(" ", "\n", "\r", "\0"))->getValue());

        $this->assertEquals(42, Purity::start(42)->trim()->getValue());
        $this->assertNull(Purity::start(null)->trim()->getValue());
    }

    public function testLtrim()
    {
        $value = "\0\r\n\t OK\t\0 \n\r";

        $this->assertEquals("OK\t\0 \n\r", Purity::start($value)->ltrim()->getValue());
        $this->assertEquals("\t OK\t\0 \n\r", Purity::start($value)->ltrim(" \n\r\0")->getValue());
        $this->assertEquals("\t OK\t\0 \n\r", Purity::start($value)->ltrim(array(" ", "\n", "\r", "\0"))->getValue());

        $this->assertEquals(42, Purity::start(42)->ltrim()->getValue());
        $this->assertNull(Purity::start(null)->ltrim()->getValue());
    }

    public function testRtrim()
    {
        $value = "\0\r\n\t OK \t\0 \n\r";

        $this->assertEquals("\0\r\n\t OK", Purity::start($value)->rtrim()->getValue());
        $this->assertEquals("\0\r\n\t OK \t", Purity::start($value)->rtrim(" \n\r\0")->getValue());
        $this->assertEquals("\0\r\n\t OK \t", Purity::start($value)->rtrim(array(" ", "\n", "\r", "\0"))->getValue());

        $this->assertEquals(42, Purity::start(42)->rtrim()->getValue());
        $this->assertNull(Purity::start(null)->rtrim()->getValue());
    }

    public function testToLoserCase()
    {
        $this->assertEquals("ok123success!!", Purity::start('OK123Success!!')->toLowerCase()->getValue());

        $this->assertTrue(is_int(Purity::start(42)->toLowerCase()->getValue()));
        $this->assertFalse(is_int(Purity::start('42')->toLowerCase()->getValue()));
    }

    public function testToUpperCase()
    {
        $this->assertEquals("OK123SUCCESS!!", Purity::start('ok123Success!!')->toUpperCase()->getValue());

        $this->assertTrue(is_int(Purity::start(42)->toUpperCase()->getValue()));
        $this->assertFalse(is_int(Purity::start('42')->toUpperCase()->getValue()));
    }
}