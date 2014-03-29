<?php
namespace Kir\Stores\KeyValueStores\Common;

use Kir\Stores\KeyValueStores\InvalidArgumentException;
use Kir\Stores\KeyValueStores\InvalidOperationException;
use Kir\Stores\KeyValueStores\ReadWriteStore;

class ReadWriteStoreKeyPrefixProxy implements ReadWriteStore {
	/**
	 * @var ReadWriteStore
	 */
	private $store = null;

	/**
	 * @var string
	 */
	private $keyPrefix = null;

	/**
	 * @var string
	 */
	private $concatenator;

	/**
	 * @param ReadWriteStore $store
	 * @param string $keyPrefix
	 * @param string $concatenator
	 */
	public function __construct(ReadWriteStore $store, $keyPrefix, $concatenator = '.') {
		$this->store = $store;
		$this->keyPrefix = $keyPrefix;
		$this->concatenator = $concatenator;
	}

	/**
	 * @param string $key
	 * @param mixed $default If the key does not exist, use this
	 * @return mixed
	 * @throws InvalidArgumentException
	 * @throws InvalidOperationException
	 */
	public function get($key, $default = null) {
		return $this->store->get($this->keyPrefix . $this->concatenator . $key, $default);
	}

	/**
	 * @param string $key
	 * @return bool
	 * @throws InvalidArgumentException
	 * @throws InvalidOperationException
	 */
	public function has($key) {
		return $this->store->has($this->keyPrefix . $this->concatenator . $key);
	}

	/**
	 * @param string $key
	 * @return $this
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function remove($key) {
		return $this->store->remove($this->keyPrefix . $this->concatenator . $key);
	}

	/**
	 * @param string $key
	 * @param mixed $value The value to store.
	 * @return $this
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function set($key, $value) {
		return $this->store->set($this->keyPrefix . $this->concatenator . $key, $value);
	}
}