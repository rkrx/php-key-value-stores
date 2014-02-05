<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests\SelfTests\Mock;

use Kir\Stores\KeyValueStores\Common\TypeCheckHelper;
use Kir\Stores\KeyValueStores\ContextRepository;
use Kir\Stores\KeyValueStores\InvalidArgumentException;
use Kir\Stores\KeyValueStores\InvalidOperationException;
use Kir\Stores\KeyValueStores\ReadWriteStore;

class MockContextRepository implements ContextRepository {
	/**
	 * @var MockReadWriteStore[]
	 */
	private $stores = array();

	/**
	 * @param string $name
	 * @return bool
	 * @throws InvalidArgumentException
	 */
	public function has($name) {
		$name = TypeCheckHelper::convertKey($name);
		return array_key_exists($name, $this->stores);
	}

	/**
	 * @param string $name
	 * @return ReadWriteStore
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function get($name) {
		$name = TypeCheckHelper::convertKey($name);
		if(!$this->has($name)) {
			$this->stores[$name] = new MockReadWriteStore();
		}
		return $this->stores[$name];
	}

	/**
	 * @param string $name
	 * @return $this
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function remove($name) {
		$name = TypeCheckHelper::convertKey($name);
		if(!$this->has($name)) {
			$safeKey = htmlentities($name);
			$safeKey = json_encode($safeKey);
			throw new InvalidOperationException(sprintf("Store %s not found", $safeKey));
		}
		unset($this->stores[$name]);
		return $this;
	}
}