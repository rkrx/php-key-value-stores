<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests\Helpers;

use Kir\Stores\KeyValueStores\Store;

interface StoreFactory {
	/**
	 * @return Store
	 */
	public function getStore();
} 