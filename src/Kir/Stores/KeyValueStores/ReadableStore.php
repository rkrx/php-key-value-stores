<?php
namespace Kir\Stores\KeyValueStores;

use InvalidArgumentException;

interface ReadableStore extends ReadOnlyStore {
	/**
	 * @param string $key
	 * @return bool
	 * @throws InvalidArgumentException
	 * @throws InvalidOperationException
	 */
	public function has($key);
}