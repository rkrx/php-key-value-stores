<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests\SelfTests;

use Kir\Stores\KeyValueStores\ComplianceTests\ContextRepositoryTestInterface;
use Kir\Stores\KeyValueStores\ComplianceTests\Common\ContextRepositoryTest as TestBase;
use Kir\Stores\KeyValueStores\ComplianceTests\Helpers\ClosureContextRepositoryFactory;
use Kir\Stores\KeyValueStores\ComplianceTests\SelfTests\Mock\MockContextRepository;

class ContextRepositoryTest extends TestBase implements ContextRepositoryTestInterface {
	public function setUp() {
		parent::setUp();
		$factory = new ClosureContextRepositoryFactory(function () {
			return new MockContextRepository();
		});
		$this->setContextRepository($factory);
	}
}
 