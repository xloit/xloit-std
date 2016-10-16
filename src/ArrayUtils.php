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
use Traversable;
use Zend\Stdlib\ArrayUtils as ZendArrayUtils;
use Zend\Stdlib\ArrayUtils\MergeRemoveKey;
use Zend\Stdlib\ArrayUtils\MergeReplaceKeyInterface;

/**
 * An {@link ArrayUtils} abstract class of array manipulation methods.
 *
 * @abstract
 * @package Xloit\Std
 */
abstract class ArrayUtils extends ZendArrayUtils
{
    /**
     *
     *
     * @var string
     */
    const PATH_DELIMITER = '.';

    /**
     *
     *
     * @var string
     */
    const PATH_WILDCARD = '*';

    /**
     * Set an array value using "dot notation".
     *
     * @param array  $values Array you want to modify
     * @param string $path   Array path
     * @param mixed  $value  Value to set
     */
    public static function set(&$values, $path, $value)
    {
        $segments = explode(static::PATH_DELIMITER, $path);

        while (count($segments) > 1) {
            $segment = array_shift($segments);

            /** @noinspection ReferenceMismatchInspection */
            if (!array_key_exists($segment, $values) || !is_array($values[$segment])) {
                $values[$segment] = [];
            }

            $values =& $values[$segment];
        }

        $values[array_shift($segments)] = $value;
    }

    /**
     * Search for an array value using "dot notation". Returns TRUE if the array key exists and FALSE if not.
     *
     * @param array  $values Array we're going to search
     * @param string $path   Array path
     *
     * @return boolean
     */
    public static function has(array $values, $path)
    {
        /** @var array $segments */
        $segments = explode(static::PATH_DELIMITER, $path);

        foreach ($segments as $segment) {
            if (!array_key_exists($segment, $values) || !is_array($values)) {
                return false;
            }

            $values = $values[$segment];
        }

        return true;
    }

    /**
     * Gets a value from an array using a dot separated path. Using a wildcard "*" will search intermediate arrays
     * and return an array.
     *
     * @example
     * // Get the value of $array['foo']['bar']
     * $value = ArrayUtils::get($array, 'foo.bar');
     * // Get the values of "color" in theme
     * $colors = ArrayUtils::get($array, 'theme.*.color');
     * // Using an array of keys
     * $colors = ArrayUtils::get($array, array('theme', '*', 'color'));
     *
     * @param array        $values  array to search
     * @param string|array $path    key path string (delimiter separated) or array of keys
     * @param mixed        $default default value if the path is not set
     * @param boolean      $nullAble
     *
     * @return mixed
     * @throws Exception\RuntimeException
     */
    public static function get($values, $path, $default = null, $nullAble = true)
    {
        if (!static::isArray($values)) {
            // This is not an array!
            return $default;
        }

        /** @noinspection IsEmptyFunctionUsageInspection */
        if (empty($values)) {
            return $default;
        }

        if (is_array($path)) {
            // The path has already been separated into segments
            $segments = $path;
            $path     = implode(static::PATH_DELIMITER, $path);
        } else {
            $path = (string) $path;

            if (array_key_exists($path, $values)) {
                // No need to do extra processing
                return $values[$path];
            }

            // Remove starting delimiters and spaces
            $path = ltrim($path, sprintf('%s ', static::PATH_DELIMITER));
            // Remove ending delimiters, spaces, and wildcards
            $path = rtrim($path, sprintf('%s %s', static::PATH_DELIMITER, static::PATH_WILDCARD));
            // Split the segments by delimiter
            $segments = explode(static::PATH_DELIMITER, $path);
        }

        $defaultRecursive = sprintf('%s::%s -> %s', static::class, __METHOD__, 'RECURSIVE');
        $result           = $default;

        while (count($segments) > 0 && static::isArray($values)) {
            $key = array_shift($segments);

            if (ctype_digit($key)) {
                // Make the key an integer
                $key = (int) $key;
            }

            if (array_key_exists($key, $values)) {
                if (count($segments) > 0) {
                    if (static::isArray($values[$key])) {
                        // Dig down into the next part of the path
                        $values = $values[$key];
                    } else {
                        // Unable to dig deeper
                        throw new Exception\RuntimeException(
                            sprintf(
                                'The given item value is not an array, trying to grab %s',
                                $path
                            )
                        );
                    }
                } else {
                    // Found the path requested
                    $result = $values[$key];

                    break;
                }
            } elseif ($key === static::PATH_WILDCARD) {
                // Handle wildcards
                $result = [];

                foreach ($values as $value) {
                    $values = static::get(
                        $value,
                        implode(static::PATH_DELIMITER, $segments),
                        $defaultRecursive,
                        $nullAble
                    );

                    if ($values !== $defaultRecursive) {
                        $result[] = $values;
                    } elseif (!$nullAble) {
                        // Unable to dig deeper
                        throw new Exception\RuntimeException(
                            sprintf(
                                'The given item value is not found, trying to grab %s of %s',
                                implode(static::PATH_DELIMITER, $segments),
                                $path
                            )
                        );
                    }
                }

                /** @noinspection IsEmptyFunctionUsageInspection */
                if (empty($result)) {
                    $result = $default;
                }

                // Unable to dig deeper or we found the requested values
                break;
            } else {
                if (!$nullAble) {
                    // Unable to dig deeper
                    throw new Exception\RuntimeException(
                        sprintf(
                            'The given item value is not found, trying to grab %s',
                            $path
                        )
                    );
                }
            }
        }

        return $result;
    }

    /**
     * Deletes an array value using "dot notation".
     *
     * @param array  $values Array you want to modify
     * @param string $path   Array path
     *
     * @return boolean
     */
    public static function delete(&$values, $path)
    {
        /** @noinspection ReferenceMismatchInspection */
        if (!static::isArray($values)) {
            // This is not an array!
            return false;
        }

        $segments = explode(static::PATH_DELIMITER, $path);

        while (count($segments) > 1) {
            $segment = array_shift($segments);

            /** @noinspection ReferenceMismatchInspection */
            if (!array_key_exists($segment, $values) || !is_array($values[$segment])) {
                return false;
            }

            $values =& $values[$segment];
        }

        unset($values[array_shift($segments)]);

        return true;
    }

    /**
     * Test if a value is an array with an additional check for array-like objects.
     *
     * @param mixed $value value to check
     *
     * @return bool
     */
    public static function isArray($value)
    {
        if (is_array($value)) {
            // Definitely an array
            return true;
        }

        // Possibly a Traversable object, functionally the same as an array
        return (is_object($value) && $value instanceof Traversable);
    }

    /**
     * Returns a random value from an array.
     *
     * @param array $values Array you want to pick a random value from
     *
     * @return mixed
     */
    public static function random(array $values)
    {
        return $values[array_rand($values)];
    }

    /**
     * Returns TRUE if the array is associative and FALSE if not.
     *
     * @param array $values Array to check
     *
     * @return bool
     */
    public static function isAssoc(array $values)
    {
        return count(array_filter(array_keys($values), 'is_string')) === count($values);
    }

    /**
     * Returns the values from a single column of the input array, identified by the key.
     *
     * @param array  $values Array to pluck from
     * @param string $key    Array key
     *
     * @return array
     */
    public static function pluck(array $values, $key)
    {
        return array_map(
            function($value) use ($key) {
                return is_object($value) ? $value->{$key} : $value[$key];
            }, $values
        );
    }

    /**
     * Build a new array using a callback.
     *
     * @param array   $values
     * @param Closure $callback
     *
     * @return array
     */
    public static function build($values, Closure $callback)
    {
        $results = [];

        foreach ($values as $key => $value) {
            list($innerKey, $innerValue) = call_user_func(
                $callback, $key, $value
            );

            $results[$innerKey] = $innerValue;
        }

        return $results;
    }

    /**
     * Divide an array into two arrays. One with keys and the other with values.
     *
     * @param array $values
     *
     * @return array
     */
    public static function divide(array $values)
    {
        return [
            array_keys($values),
            array_values($values)
        ];
    }

    /**
     * Get all of the given array except for a specified array of items.
     *
     * @param array        $values
     * @param array|string $keys
     *
     * @return array
     */
    public static function except(array $values, $keys)
    {
        return array_diff_key($values, array_flip((array) $keys));
    }

    /**
     * Fetch a flattened array of a nested array element.
     *
     * @param array  $values
     * @param string $key
     *
     * @return array
     */
    public static function fetch($values, $key)
    {
        /** @var array $segments */
        $segments = explode(static::PATH_DELIMITER, $key);
        $results  = [];

        foreach ($segments as $segment) {
            $results = [];

            foreach ($values as $value) {
                $value     = (array) $value;
                $results[] = $value[$segment];
            }

            $values = array_values($results);
        }

        return array_values($results);
    }

    /**
     * Get a subset of the items from the given array.
     *
     * @param array        $values
     * @param array|string $keys
     *
     * @return array
     */
    public static function only(array $values, $keys)
    {
        return array_intersect_key($values, array_flip((array) $keys));
    }

    /**
     * Return the last element in an array passing a given truth test.
     *
     * @param array   $values
     * @param Closure $callback
     * @param mixed   $default
     *
     * @return mixed
     */
    public static function last(array $values, Closure $callback, $default = null)
    {
        return static::first(array_reverse($values), $callback, $default);
    }

    /**
     * Return the first element in an array passing a given truth test.
     *
     * @param array   $values
     * @param Closure $callback
     * @param mixed   $default
     *
     * @return mixed
     */
    public static function first(array $values, Closure $callback, $default = null)
    {
        foreach ($values as $key => $value) {
            if (call_user_func($callback, $key, $value)) {
                return $value;
            }
        }

        return $default instanceof Closure ? call_user_func($default, $values) : $default;
    }

    /**
     * Flatten a multi-dimensional array into a single level.
     *
     * @param array $values
     *
     * @return array
     */
    public static function flatten(array $values)
    {
        $results = [];

        array_walk_recursive(
            $values,
            function($value) use (&$results) {
                $results[] = $value;
            }
        );

        return $results;
    }

    /**
     * Filter the array using the given Closure.
     *
     * @param array   $values
     * @param Closure $callback
     *
     * @return array
     */
    public static function where($values, Closure $callback)
    {
        $filtered = [];

        foreach ($values as $key => $value) {
            if (call_user_func($callback, $key, $value)) {
                $filtered[$key] = $value;
            }
        }

        return $filtered;
    }

    /**
     * Flattening a multi-dimensional array into a single-dimensional one. The resulting keys are a string-separated
     * list of the original keys:
     *
     * a[x][y][z] becomes a[implode(sep, array(x,y,z))]
     *
     * @param array  $values
     * @param string $sep
     *
     * @return array
     */
    public static function flattenSeparated(array $values, $sep = '.')
    {
        $result = [];
        $stack  = [
            [
                '',
                $values
            ]
        ];

        while (count($stack) > 0) {
            list($prefix, $values) = array_pop($stack);

            foreach ($values as $key => $value) {
                $newKey = $prefix . (string) $key;

                if (is_array($value)) {
                    $stack[] = [
                        $newKey . $sep,
                        $value
                    ];
                } else {
                    $result[$newKey] = $value;
                }
            }
        }

        return $result;
    }

    /**
     * Remove any elements where the callback returns true.
     *
     * @param array   $values   the array to walk
     * @param Closure $callback callback takes ($value, $key, $data)
     * @param mixed   $data     additional data passed to the callback.
     *
     * @return array
     */
    public static function arrayWalkRecursiveDelete(array &$values, Closure $callback, $data = null)
    {
        foreach ($values as $key => &$value) {
            if (is_array($value)) {
                $value = static::arrayWalkRecursiveDelete(
                    $value, $callback, $data
                );
            }

            if ($callback($value, $key, $data)) {
                unset($values[$key]);
            }
        }

        return $values;
    }

    /**
     * A version of in_array() that does a sub string match on $needle.
     *
     * @param mixed $needle   The searched value
     * @param array $haystack The array to search in
     *
     * @return bool
     */
    public static function substrInArray($needle, array $haystack)
    {
        $filtered = array_filter(
            $haystack, function($item) use ($needle) {
            return false !== strpos($item, $needle);
        }
        );

        /** @noinspection IsEmptyFunctionUsageInspection */
        return !empty($filtered);
    }

    /**
     * Merge two arrays together.
     * If an integer key exists in both arrays and preserveNumericKeys is false, the value from the second array
     * will be appended to the first array if it does not exists. If both values are arrays, they are merged together,
     * else the value of the second array overwrites the one of the first array.
     *
     * @param array   $first
     * @param array   $second
     * @param boolean $preserveNumericKeys
     *
     * @return array
     */
    public static function mergeUnique(array $first, array $second, $preserveNumericKeys = false)
    {
        foreach ($second as $key => $value) {
            if ($value instanceof MergeReplaceKeyInterface) {
                $first[$key] = $value->getData();
            } elseif (array_key_exists($key, $first)) {
                if ($value instanceof MergeRemoveKey) {
                    unset($first[$key]);
                } elseif (!$preserveNumericKeys && is_int($key)) {
                    if (!is_scalar($value) || !in_array($value, $first, true)) {
                        $first[] = $value;
                    }
                } elseif (is_array($value) && is_array($first[$key])) {
                    $first[$key] = static::merge($first[$key], $value, $preserveNumericKeys);
                } else {
                    $first[$key] = $value;
                }
            } else {
                if (!($value instanceof MergeRemoveKey)) {
                    $first[$key] = $value;
                }
            }
        }

        return $first;
    }
}
