<?php
namespace Kir\Stores\KeyValueStores;

interface WritableStore extends WriteOnlyStore {
	/**
	 * @param string $key
	 * @return $this
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function remove($key);
}