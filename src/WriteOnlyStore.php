<?php
namespace Kir\Stores\KeyValueStores;

interface WriteOnlyStore extends Store {
	/**
	 * @param string $key
	 * @param mixed $value The value to store.
	 * @param int|null $ttl
	 * @return $this
	 */
	public function set($key, $value, $ttl = null);
}