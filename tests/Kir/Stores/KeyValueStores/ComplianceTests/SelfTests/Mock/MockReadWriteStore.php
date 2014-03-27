<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests\SelfTests\Mock;

use Kir\Stores\KeyValueStores\Helpers\TypeCheckHelper;
use Kir\Stores\KeyValueStores\InvalidArgumentException;
use Kir\Stores\KeyValueStores\InvalidOperationException;
use Kir\Stores\KeyValueStores\ReadWriteStore;

class MockReadWriteStore implements ReadWriteStore {
	/**
	 * @var mixed[]
	 */
	private $store = array();

	/**
	 * @param array $defaults
	 */
	public function __construct(array $defaults = array()) {
		$this->store = $defaults;
	}

	/**
	 * @param string $key
	 * @return bool
	 * @throws InvalidArgumentException
	 * @throws InvalidOperationException
	 */
	public function has($key) {
		$key = TypeCheckHelper::convertKey($key);
		$result = array_key_exists($key, $this->store);
		return $result;
	}

	/**
	 * @param string $key
	 * @param mixed $default If the key does not exist, use this
	 * @return mixed
	 * @throws InvalidArgumentException
	 * @throws InvalidOperationException
	 */
	public function get($key, $default = null) {
		$key = TypeCheckHelper::convertKey($key);
		$default = TypeCheckHelper::convertDefault($default);
		if(!$this->has($key)) {
			return $default;
		}
		return $this->store[$key];
	}

	/**
	 * @param string $key
	 * @param mixed $value The value to store.
	 * @return $this
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function set($key, $value) {
		$key = TypeCheckHelper::convertKey($key);
		$value = TypeCheckHelper::convertValue($value);
		$this->store[$key] = $value;
		return $this;
	}

	/**
	 * @param string $key
	 * @return $this
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function remove($key) {
		$key = TypeCheckHelper::convertKey($key);
		if(!$this->has($key)) {
			$safeKey = htmlentities($key);
			$safeKey = json_encode($safeKey);
			throw new InvalidOperationException(sprintf("Entry %s not found", $safeKey));
		}
		unset($this->store[$key]);
		return $this;
	}
}
