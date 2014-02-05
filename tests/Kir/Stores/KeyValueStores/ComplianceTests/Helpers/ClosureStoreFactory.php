<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests\Helpers;

use Closure;
use Exception;
use Kir\Stores\KeyValueStores\Store;

class ClosureStoreFactory implements StoreFactory {
	/**
	 * @var Closure
	 */
	private $closure = null;

	/**
	 * @param Closure $closure
	 */
	public function __construct(Closure $closure) {
		$this->closure = $closure;
	}

	/**
	 * @throws Exception
	 * @return Store
	 */
	public function getStore() {
		$store = call_user_func($this->closure);
		if(!($store instanceof Store)) {
			$type = gettype($store);
			throw new Exception("Expected store to be an instance of Kir\\Stores\\KeyValueStores\\Store. Found type {$type}.");
		}
		return $store;
	}
}