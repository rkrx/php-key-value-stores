<?php
namespace Kir\Stores\KeyValueStores;

use InvalidArgumentException;

interface WritableStore extends WriteOnlyReadWriteStore {
	/**
	 * @param $key
	 * @return $this
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function remove($key);
}