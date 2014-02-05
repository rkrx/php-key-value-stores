<?php
namespace Kir\Stores\KeyValueStores;

use InvalidArgumentException;

interface WritableStore extends WriteOnlyStore {
	/**
	 * @param $key
	 * @return $this
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function remove($key);
}