<?php
/**
 * This source file is part of Xloit project.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License that is bundled with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * <http://www.opensource.org/licenses/mit-license.php>
 * If you did not receive a copy of the license and are unable to obtain it through the world-wide-web,
 * please send an email to <license@xloit.com> so we can send you a copy immediately.
 *
 * @license   MIT
 * @link      http://xloit.com
 * @copyright Copyright (c) 2016, Xloit. All rights reserved.
 */

namespace Xloit\Std;

use Closure;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Inflector\Inflector;
use Zend\Filter;
use Zend\Filter\StaticFilter;

/**
 * A {@link StringUtils} abstract class of string manipulation methods.
 *
 * @abstract
 * @package Xloit\Std
 */
abstract class StringUtils extends Inflector
{
    /**
     * Alphanumeric characters.
     *
     * @var string
     */
    const ALNUM = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     *
     *
     * @var string
     */
    public static $encoding;

    /**
     *
     *
     * @var Slugify
     */
    public static $slugify;

    /**
     * Replaces newline with <br> or <br />.
     *
     * @param string  $string The input string
     * @param boolean $xhtml  (optional) Should we return XHTML?
     *
     * @return string
     */
    public static function nl2br($string, $xhtml = false)
    {
        return str_replace(
            [
                "\r\n",
                "\n\r",
                "\n",
                "\r"
            ], $xhtml ? '<br />' : '<br>', $string
        );
    }

    /**
     * Replaces <br> and <br /> with newline.
     *
     * @param string $string The input string
     *
     * @return string
     */
    public static function br2nl($string)
    {
        return str_replace(
            [
                '<br>',
                '<br/>',
                '<br />'
            ], "\n", $string
        );
    }

    /**
     * Convert the given string to title case.
     *
     * @param string $value
     * @param string $encoding
     *
     * @return string
     * @throws \Zend\Filter\Exception\ExceptionInterface
     */
    public static function title($value, $encoding = null)
    {
        $options  = [];
        $encoding = $encoding ?: static::$encoding;

        if ($encoding) {
            $options['encoding'] = $encoding;
        }

        return StaticFilter::execute(static::camelCaseToUnderscore($value), Filter\UpperCaseWords::class, $options);
    }

    /**
     * Creates url friendly string.
     *
     * @param string $string    The input string
     * @param string $separator The separator string
     * @param array  $options
     *
     * @return string
     */
    public static function slug($string, $separator = '-', array $options = [])
    {
        if (!static::$slugify instanceof Slugify) {
            static::$slugify = Slugify::create($options);
        }

        return mb_strtolower(static::$slugify->slugify($string, $separator));
    }

    /**
     * Converts underscore to camel case.
     *
     * @param string $value The input string
     *
     * @return string
     * @throws \Zend\Filter\Exception\ExceptionInterface
     */
    public static function underscoreToCamelCase($value)
    {
        return StaticFilter::execute($value, Filter\Word\UnderscoreToCamelCase::class);
    }

    /**
     * Converts camel case to underscore.
     *
     * @param string $value The input string
     *
     * @return string
     * @throws \Zend\Filter\Exception\ExceptionInterface
     */
    public static function camelCaseToUnderscore($value)
    {
        return StaticFilter::execute($value, Filter\Word\CamelCaseToUnderscore::class);
    }

    /**
     * Returns the plural form of a noun (english only).
     *
     * @param string $noun  Noun to pluralize
     * @param int    $count (optional) Number of nouns
     *
     * @return string
     */
    public static function pluralized($noun, $count = null)
    {
        if ($count > 1) {
            static::pluralize($noun);
        }

        return static::singularize($noun);
    }

    /**
     * Limits the number of characters in a string.
     *
     * @param string $string     The input string
     * @param int    $characters (optional) Number of characters to allow
     * @param string $suffix     (optional) Suffix to add if number of characters is reduced
     *
     * @return string
     */
    public static function limitChars($string, $characters = 100, $suffix = '...')
    {
        return (mb_strlen($string) > $characters) ? trim(mb_substr($string, 0, $characters)) . $suffix : $string;
    }

    /**
     * Limits the number of words in a string.
     *
     * @param string $string The input string
     * @param int    $words  (optional) Number of words to allow
     * @param string $suffix (optional) Suffix to add if number of words is reduced
     *
     * @return string
     */
    public static function limitWords($string, $words = 100, $suffix = '...')
    {
        preg_match('/^\s*+(?:\S++\s*+){1,' . $words . '}/', $string, $matches);

        /** @noinspection UnSafeIsSetOverArrayInspection */
        if (isset($matches[0]) && mb_strlen($matches[0]) < mb_strlen($string)) {
            return trim($matches[0]) . $suffix;
        }

        return $string;
    }

    /**
     * Returns a closure that will alternate between the defined strings.
     *
     * @param array $strings Array of strings to alternate between
     *
     * @return Closure
     */
    public static function alternator(array $strings)
    {
        return function() use ($strings) {
            static $i = 0;
            $index = $i++ % count($strings);

            return $strings[$index];
        };
    }

    /**
     * Returns a masked string where only the last n characters are visible.
     *
     * @param string $string  String to mask
     * @param int    $visible (optional) Number of characters to show
     * @param string $mask    (optional) Character used to replace remaining characters
     *
     * @return string
     */
    public static function mask($string, $visible = 3, $mask = '*')
    {
        if ($visible === 0) {
            return str_repeat($mask, mb_strlen($string));
        }

        $masked = mb_substr($string, -$visible);

        return str_pad(
            $masked,
            mb_strlen($string) + (strlen($masked) - mb_strlen($masked)),
            $mask,
            STR_PAD_LEFT
        );
    }

    /**
     * Increments a string by appending a number to it or increasing the number.
     *
     * @param string $string    String to increment
     * @param int    $start     Starting number
     * @param string $separator Separator
     *
     * @return string
     */
    public static function increment($string, $start = 1, $separator = '_')
    {
        preg_match(
            '/(.+)' . preg_quote($separator) . '([0-9]+)$/', $string, $matches
        );

        /** @noinspection UnSafeIsSetOverArrayInspection */
        return isset($matches[2]) ?
            $matches[1] . $separator . ((int) $matches[2] + 1)
            : $string . $separator . $start;
    }

    /**
     * Returns a random string of the selected type and length.
     *
     * @param string $charLists Character pool to use
     * @param int    $length    (optional) Desired string length
     *
     * @return string
     */
    public static function random($charLists = null, $length = 32)
    {
        if (!$charLists) {
            $charLists = static::ALNUM;
        }

        $string   = '';
        $poolSize = mb_strlen($charLists) - 1;

        for ($i = 0; $i < $length; $i++) {
            $string .= mb_substr($charLists, mt_rand(0, $poolSize), 1);
        }

        return $string;
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param string       $haystack
     * @param string|array $needles
     *
     * @return boolean
     */
    public static function startsWith($haystack, $needles)
    {
        $needles = (array) $needles;

        foreach ($needles as $needle) {
            if ($needle && strpos($haystack, $needle) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given string ends with a given substring.
     *
     * @param string       $haystack
     * @param string|array $needles
     *
     * @return boolean
     */
    public static function endsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ((string) $needle === substr($haystack, -strlen($needle))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Cap a string with a single instance of a given value.
     *
     * @param string $value
     * @param string $cap
     *
     * @return string
     */
    public static function finish($value, $cap)
    {
        $quoted = preg_quote($cap, '/');

        return preg_replace('/(?:' . $quoted . ')+$/', '', $value) . $cap;
    }

    /**
     * Determine if a given string contains a given substring.
     *
     * @param string       $haystack
     * @param string|array $needles
     *
     * @return bool
     */
    public static function contains($haystack, $needles)
    {
        $needles = (array) $needles;

        foreach ($needles as $needle) {
            if ($needle && strpos($haystack, $needle) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Convert the given string to upper-case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function upper($value)
    {
        return mb_strtoupper($value);
    }

    /**
     * Convert the given string to lower-case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function lower($value)
    {
        return mb_strtolower($value);
    }

    /**
     * Return the length of the given string.
     *
     * @param string $value
     *
     * @return int
     */
    public static function length($value)
    {
        return mb_strlen($value);
    }

    /**
     * Determine if a given string matches a given pattern.
     *
     * @param string $pattern
     * @param string $value
     *
     * @return bool
     */
    public static function is($pattern, $value)
    {
        if ($pattern === $value) {
            return true;
        }

        $pattern = preg_quote($pattern, '#');
        /**
         * Asterisks are translated into zero-or-more regular expression wildcards to make it convenient to check
         * if the strings starts with the given pattern such as "library/*", making any string check convenient.
         */
        $pattern = str_replace('\*', '.*', $pattern) . '\z';

        return (bool) preg_match('#^' . $pattern . '#', $value);
    }

    /**
     * Binary-safe strrev().
     *
     * @param string $str
     *
     * @return string
     */
    public static function strrev($str)
    {
        $result = '';
        $strLen = static::length($str);

        if (!$strLen) {
            return $result;
        }

        for ($i = $strLen - 1; $i >= 0; $i--) {
            $result .= static::substr($str, $i, 1);
        }

        return $result;
    }

    /**
     * Pass through to iconv_substr().
     *
     * @param string $string
     * @param int    $offset
     * @param int    $length
     *
     * @return string
     */
    public static function substr($string, $offset, $length = null)
    {
        if ($length === null) {
            $length = static::length($string) - $offset;
        }

        return iconv_substr($string, $offset, $length, 'UTF-8');
    }

    /**
     * Find position of first occurrence of a string.
     *
     * @param string $haystack
     * @param string $needle
     * @param int    $offset
     *
     * @return int|bool
     */
    public static function strpos($haystack, $needle, $offset = null)
    {
        return iconv_strpos($haystack, $needle, $offset, 'UTF-8');
    }

    /**
     * Returns X random raw binary bytes.
     *
     * @param int $byteLength
     *
     * @return string
     * @throws \Xloit\Std\Exception\RuntimeException
     */
    public static function getRandomBytes($byteLength)
    {
        $results = null;

        if (function_exists('openssl_random_pseudo_bytes')) {
            $results = openssl_random_pseudo_bytes($byteLength);
        } elseif (is_readable('/dev/urandom')) {
            $fileHandler = fopen('/dev/urandom', 'rb');

            if ($fileHandler !== false) {
                $results = fread($fileHandler, $byteLength);

                fclose($fileHandler);
            }
        } elseif (function_exists('mcrypt_create_iv') && version_compare(PHP_VERSION, '5.3.0', '>=')) {
            $results = mcrypt_create_iv($byteLength, MCRYPT_DEV_URANDOM);
        } elseif (class_exists('COM')) {
            /** @noinspection BadExceptionsProcessingInspection */
            try {
                /** @noinspection PhpUndefinedClassInspection */
                /** @noinspection SpellCheckingInspection */
                $capiUtil = new \COM('CAPICOM.Utilities.1');
                /** @noinspection PhpUndefinedMethodInspection */
                /** @noinspection SpellCheckingInspection */
                $results = $capiUtil->GetRandom($byteLength, 0);
            } catch (\Exception $ex) {
            } // Fail silently
        }

        /** @noinspection IsEmptyFunctionUsageInspection */
        if (empty($results)) {
            throw new Exception\RuntimeException(
                'Unable to find a secure method for generating random bytes.'
            );
        }

        return $results;
    }

    /**
     * Check value to find if it was serialized.
     * If $json is not an string, then returned value will always be false. Serialized json is always a string.
     *
     * @param string  $json   Value to check to see if was serialized.
     * @param boolean $strict Optional. Whether to be strict about the end of the string. Default true.
     *
     * @return boolean If not serialized will return false; otherwise true.
     */
    public static function isSerializedJSON($json, $strict = true)
    {
        // if it isn't a string, it isn't serialized.
        if (!is_string($json)) {
            return false;
        }

        $json = trim($json);

        if ('N;' === $json) {
            return true;
        }

        if (strlen($json) < 4) {
            return false;
        }

        if (':' !== $json[1]) {
            return false;
        }

        if ($strict) {
            $lastCurlie = substr($json, -1);

            if (';' !== $lastCurlie && '}' !== $lastCurlie) {
                return false;
            }
        } else {
            $semicolon = strpos($json, ';');
            $brace     = strpos($json, '}');

            // Either ; or } must exist.
            if ($semicolon === false && $brace === false) {
                return false;
            }

            // But neither must be in the first X characters.
            if ($semicolon !== false && $semicolon < 3) {
                return false;
            }
            if ($brace !== false && $brace < 4) {
                return false;
            }
        }

        $token = $json[0];

        if ($token === 's') {
            if ($strict) {
                /** @noinspection SubStrUsedAsArrayAccessInspection */
                if (substr($json, -2, 1) !== '"') {
                    return false;
                }
            } elseif (strpos($json, '"') === false) {
                return false;
            }
        }

        if ($token === 'a' || $token === 'O') {
            return (bool) preg_match("/^{$token}:[0-9]+:/s", $json);
        } elseif ($token === 'b' || $token === 'i' || $token === 'd') {
            $end = $strict ? '$' : '';

            return (bool) preg_match("/^{$token}:[0-9.E-]+;$end/", $json);
        }

        return false;
    }

    /**
     *
     *
     * @param string $string
     *
     * @return string
     */
    public static function stringToHex($string)
    {
        // if it isn't a string, it isn't serialized.
        if (!is_string($string)) {
            return false;
        }

        $results = '';
        /** @var array $parts */
        $parts = str_split($string);

        foreach ($parts as $part) {
            $ord     = ord($part);
            $hexCode = dechex($ord);
            $results .= substr('0' . $hexCode, -2);
        }

        return strtoupper($results);
    }

    /**
     *
     *
     * @param string $string
     *
     * @return string
     */
    public static function hexToString($string)
    {
        // if it isn't a string, it isn't serialized.
        if (!is_string($string)) {
            return false;
        }

        $results = '';

        for ($i = 0; $i < strlen($string); $i++) {
            $ord = hexdec($string[$i]);
            $results .= chr($ord);
        }

        return $results;
    }
}
