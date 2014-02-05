<?php
namespace Kir\Stores\KeyValueStores;

use InvalidArgumentException;

interface WriteOnlyReadWriteStore extends ReadWriteStore {
	/**
	 * @param string $key
	 * @param mixed $value The value to store.
	 * @return $this
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function set($key, $value);
}