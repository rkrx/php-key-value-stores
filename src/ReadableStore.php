<?php
namespace Kir\Stores\KeyValueStores;

interface ReadableStore extends ReadOnlyStore {
	/**
	 * @param string $key
	 * @return bool
	 * @throws InvalidArgumentException
	 * @throws InvalidOperationException
	 */
	public function has($key);
}