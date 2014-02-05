<?php
namespace Kir\Stores\KeyValueStores;

interface WriteOnlyStore extends Store {
	/**
	 * @param string $key
	 * @param mixed $value The value to store.
	 * @return $this
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function set($key, $value);
}