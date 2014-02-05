<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests\Helpers;

use Kir\Stores\KeyValueStores\ContextRepository;

interface ContextRepositoryFactory {
	/**
	 * @return ContextRepository
	 */
	public function getContextRepository();
} 