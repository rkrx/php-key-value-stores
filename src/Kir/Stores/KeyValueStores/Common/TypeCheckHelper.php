<?php
namespace Kir\Stores\KeyValueStores\Common;

use Kir\Stores\KeyValueStores\InvalidArgumentException;

final class TypeCheckHelper {
	/**
	 * @param mixed $value
	 * @param string $title
	 * @throws InvalidArgumentException
	 * @return string
	 */
	static public function convertKey($value, $title = 'Key') {
		if(is_null($value)) {
			throw new InvalidArgumentException("{$title} must not be null.");
		}
		return self::convertValue($value, $title);
	}

	/**
	 * @param mixed $value
	 * @param string $title
	 * @throws InvalidArgumentException
	 * @return string
	 */
	static public function convertValue($value, $title = 'Value') {
		if(is_null($value)) {
			throw new InvalidArgumentException("{$title} must not be null.");
		}
		return self::convertDefault($value, $title);
	}

	/**
	 * @param mixed $value
	 * @param string $title
	 * @throws InvalidArgumentException
	 * @return string
	 */
	static public function convertDefault($value, $title = 'Default') {
		if(is_object($value)) {
			if(!method_exists($value, '__toString')) {
				throw new InvalidArgumentException("{$title} must not be an object or implement the __toString() method.");
			}
			$value = (string) $value;
		}
		if(is_float($value)) {
			throw new InvalidArgumentException("{$title} must not be float value, because of its inconclusive nature. Please convert float-values to string and proceed.");
		}
		if(is_resource($value)) {
			throw new InvalidArgumentException("{$title} must not be a resource.");
		}
		if(!(is_string($value) || is_int($value) || is_null($value))) {
			$type = gettype($value);
			throw new InvalidArgumentException("{$title} must be null, string or int. Current type is {$type}.");
		}
		return (string) $value;
	}
}