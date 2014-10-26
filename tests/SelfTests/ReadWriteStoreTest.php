<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests\SelfTests;

use Kir\Stores\KeyValueStores\ComplianceTests\Helpers\ClosureStoreFactory;
use Kir\Stores\KeyValueStores\ComplianceTests\SelfTests\Mock\MockReadWriteStore;
use Kir\Stores\KeyValueStores\ComplianceTests\Common\ReadWriteStoreTest as TestBase;

class ReadWriteStoreTest extends TestBase {
	public function setUp() {
		parent::setUp();
		$factory = new ClosureStoreFactory(function () {
			return new MockReadWriteStore(array('mock-key' => 123));
		});
		$this->setStoreFactory($factory);
	}
}