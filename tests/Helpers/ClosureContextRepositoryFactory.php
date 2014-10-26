<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests\Helpers;

use Closure;
use Exception;
use Kir\Stores\KeyValueStores\ContextRepository;

class ClosureContextRepositoryFactory implements ContextRepositoryFactory {
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
	 * @throws \Exception
	 * @return ContextRepository
	 */
	public function getContextRepository() {
		$store = call_user_func($this->closure);
		if(!($store instanceof ContextRepository)) {
			$type = gettype($store);
			throw new Exception("Expected context-repository to be an instance of Kir\\Stores\\KeyValueStores\\ContextRepository. Found type {$type}.");
		}
		return $store;
	}
} 