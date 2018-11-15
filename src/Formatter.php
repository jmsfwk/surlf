<?php

namespace Jmsfwk\Surlf;

class Formatter
{
    protected const FORMAT_CHARACTERS = [
        'scheme' => 's',
        'host'   => 'h',
        'port'   => 'P',
        'path'   => 'p',
        'query'  => 'q',
    ];

    public static function format(string $format, string $url): string
    {
        $parts = static::parse($url);
        $patterns = static::patterns($parts);

        $result = preg_replace($patterns, $parts, $format);
        $result = preg_replace('/%%/', '%', $result);

        return $result;
    }

    /**
     * Split the url into an array of parts
     *
     * Splits the url and trims any leading forward slash
     *
     * @param string $url
     * @return array
     */
    protected static function parse(string $url): array
    {
        $parts = parse_url($url);
        $parts = array_map(function (string $part) {
            return ltrim($part, '/');
        }, $parts);

        $parts = array_intersect_key($parts, self::FORMAT_CHARACTERS);

        return $parts;
    }

    /**
     *
     * @param array $parts
     * @return array
     */
    protected static function patterns(array $parts): array
    {
        $activeParts = array_intersect_key(self::FORMAT_CHARACTERS, $parts);

        return array_map(function (string $character) {
            return "/(?<!%)%{$character}/";
        }, array_values($activeParts));
    }
}
