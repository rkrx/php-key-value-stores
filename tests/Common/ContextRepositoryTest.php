<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests\Common;

use Closure;
use Kir\Stores\KeyValueStores\ComplianceTests\ContextRepositoryTestInterface;
use Kir\Stores\KeyValueStores\ComplianceTests\Helpers\ContextRepositoryFactory;
use Kir\Stores\KeyValueStores\ComplianceTests\Helpers\StoreFactory;
use Kir\Stores\KeyValueStores\ComplianceTests\ReadWriteStoreTestInterface;
use Kir\Stores\KeyValueStores\ContextRepository;
use Kir\Stores\KeyValueStores\InvalidArgumentException;
use Kir\Stores\KeyValueStores\InvalidOperationException;
use Kir\Stores\KeyValueStores\ReadWriteStore;

class ContextRepositoryTest extends \PHPUnit_Framework_TestCase implements ContextRepositoryTestInterface {
	const MSG_UNEXPECTED_BOOL_PARAMETER =
		'It is not allowed to set an bool as the first parameter. Expected exception not thrown.';

	const MSG_UNEXPECTED_FLOAT_PARAMETER =
		'It is not allowed to set an float as the first parameter. Expected exception not thrown.';

	const MSG_UNEXPECTED_ARRAY_PARAMETER =
		'It is not allowed to set an array as the first parameter. Expected exception not thrown.';

	const MSG_UNEXPECTED_OBJECT_PARAMETER =
		'It is not allowed to set an object as the first parameter. Expected exception not thrown.';

	const MSG_UNEXPECTED_RESOURCE_PARAMETER =
		'It is not allowed to set an resource as the first parameter. Expected exception not thrown.';

	const MSG_UNEXPECTED_CLOSURE_PARAMETER =
		'It is not allowed to set an closure as the first parameter. Expected exception not thrown.';

	/**
	 * @var ContextRepositoryFactory
	 */
	private $factory = null;

	/**
	 */
	public function testHas() {
		$repos = $this->getContextRepository();
		$this->assertFalse($repos->has('test-has'));
		$repos->get('test-has');
		$this->assertTrue($repos->has('test-has'));
		$repos->remove('test-has');
		$this->assertFalse($repos->has('test-has'));
	}

	/**
	 */
	public function testHas_InvalidArgumentException() {
		$repos = $this->getContextRepository();
		$this->checkExpectedExceptions(function ($parameter) use ($repos) {
			$repos->has($parameter);
		});
	}

	/**
	 */
	public function testHas_InvalidOperationException() {
		# Not possible here
		$this->assertTrue(true);
	}

	/**
	 */
	public function testGet() {
		$repos = $this->getContextRepository();
		$store = $repos->get('test-get');
		$this->assertInstanceOf('Kir\\Stores\\KeyValueStores\\Store', $store);
	}

	/**
	 */
	public function testGet_InvalidArgumentException() {
		$repos = $this->getContextRepository();
		$this->checkExpectedExceptions(function ($parameter) use ($repos) {
			$repos->get($parameter);
		});
	}

	/**
	 */
	public function testGet_InvalidOperationException() {
		# Not possible here
		$this->assertTrue(true);
	}

	/**
	 */
	public function testRemove() {
		$repos = $this->getContextRepository();
		$store1 = $repos->get('test-remove');
		$repos->remove('test-remove');
		$store2 = $repos->get('test-remove');
		$this->assertFalse($store1 === $store2);
	}

	/**
	 */
	public function testRemove_InvalidArgumentException() {
		$repos = $this->getContextRepository();
		$this->checkExpectedExceptions(function ($parameter) use ($repos) {
			try {
				$repos->remove($parameter);
			} catch (InvalidOperationException $e) {
			}
		});
	}

	/**
	 */
	public function testRemove_InvalidOperationException() {
		# Not possible here
		$this->assertTrue(true);
	}

	/**
	 */
	protected function setContextRepository(ContextRepositoryFactory $factory) {
		$this->factory = $factory;
	}

	/**
	 * @return ContextRepository
	 */
	private function getContextRepository() {
		$repository = $this->factory->getContextRepository();
		\PHPUnit_Framework_Assert::assertInstanceOf('Kir\\Stores\\KeyValueStores\\ContextRepository', $repository);
		return $repository;
	}

	/**
	 */
	private function checkExpectedExceptions(Closure $callback) {
		try {
			call_user_func($callback, true);
			\PHPUnit_Framework_Assert::assertTrue(false, self::MSG_UNEXPECTED_BOOL_PARAMETER);
		} catch (InvalidArgumentException $e) {
		}
		try {
			call_user_func($callback, 99.99);
			\PHPUnit_Framework_Assert::assertTrue(false, self::MSG_UNEXPECTED_FLOAT_PARAMETER);
		} catch (InvalidArgumentException $e) {
		}
		try {
			call_user_func($callback, array());
			\PHPUnit_Framework_Assert::assertTrue(false, self::MSG_UNEXPECTED_ARRAY_PARAMETER);
		} catch (InvalidArgumentException $e) {
		}
		try {
			call_user_func($callback, new \stdClass());
			\PHPUnit_Framework_Assert::assertTrue(false, self::MSG_UNEXPECTED_OBJECT_PARAMETER);
		} catch (InvalidArgumentException $e) {
		}
		try {
			$res = fopen('php://memory', 'r+');
			call_user_func($callback, $res);
			\PHPUnit_Framework_Assert::assertTrue(false, self::MSG_UNEXPECTED_RESOURCE_PARAMETER);
		} catch (InvalidArgumentException $e) {
		}
		try {
			call_user_func($callback, function () {});
			\PHPUnit_Framework_Assert::assertTrue(false, self::MSG_UNEXPECTED_CLOSURE_PARAMETER);
		} catch (InvalidArgumentException $e) {
		}
	}
}