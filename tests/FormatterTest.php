<?php

namespace Tests\Surlf;

use Jmsfwk\Surlf\Formatter;
use PHPUnit\Framework\TestCase;

class FormatterTest extends TestCase
{
    /**
     * @test
     * @dataProvider formats
     */
    public function formats_urls(string $url, string $result, string $format)
    {
        $this->assertEquals($result, Formatter::format($format, $url));
    }

    /** @test */
    public function percent_symbols_can_be_escaped_by_doubling_them()
    {
        $url = 'https://example.com';

        $this->assertEquals('%h', Formatter::format('%%h', $url));
    }

    /** @test */
    public function missing_url_parts_are_not_replaced()
    {
        $url = '//example.com';

        $this->assertEquals('%s://example.com', Formatter::format('%s://%h', $url));
    }

    public function formats()
    {
        return [
            '%s' => ['https://example.com', 'https', '%s'],
            '%h' => ['http://example.com', 'example.com', '%h'],
            '%p' => ['http://example.com/test', 'test', '%p'],
            '%q' => ['http://example.com?test=value', 'test=value', '%q'],
            'literal $' => ['http://example.com?test=value', '%h', '%%h'],
        ];
    }
}
