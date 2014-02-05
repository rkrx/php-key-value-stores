<?php
namespace Kir\Stores\KeyValueStores;

interface ReadOnlyStore extends Store {
	/**
	 * @param string $key
	 * @param mixed $default If the key does not exist, use this
	 * @return mixed
	 * @throws InvalidArgumentException
	 * @throws InvalidOperationException
	 */
	public function get($key, $default=null);
}