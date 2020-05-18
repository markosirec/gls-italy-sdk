<?php

namespace GlsItaly\Tests;

use PHPUnit\Framework\TestCase;
use MarkoSirec\GlsItaly\SDK\Adapters\BaseAdapter as BaseAdapter;

class BaseAdapterTest extends \PHPUnit\Framework\TestCase
{

    public function testFormatStringForXml(): void
    {
        $inst = new BaseAdapterTestInstance();
        $this->assertEquals("AEIOUaeioumnk ert", $inst->testFormatStringForXml("ÀÈÌÒÙàèìòùmnk ert"));
    }
}

class BaseAdapterTestInstance extends BaseAdapter 
{
    public function get() 
    {
    }

    public function testFormatStringForXml(string $string, int $maxLength = null): string
    {
        return $this->formatStringForXml($string, $maxLength);
    }
}
