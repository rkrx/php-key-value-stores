<?php
namespace Kir\Stores\KeyValueStores;

use InvalidArgumentException;

interface ReadOnlyStore {
	/**
	 * @param string $key
	 * @param mixed $default If the key does not exist, use this
	 * @return mixed
	 * @throws InvalidArgumentException
	 * @throws InvalidOperationException
	 */
	public function get($key, $default=null);
}