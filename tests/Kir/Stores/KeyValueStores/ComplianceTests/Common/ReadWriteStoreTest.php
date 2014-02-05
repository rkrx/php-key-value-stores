<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests\Common;

use Closure;
use Kir\Stores\KeyValueStores\ComplianceTests\Helpers\StoreFactory;
use Kir\Stores\KeyValueStores\ComplianceTests\ReadWriteStoreTestInterface;
use Kir\Stores\KeyValueStores\InvalidArgumentException;
use Kir\Stores\KeyValueStores\ReadWriteStore;

class ReadWriteStoreTest extends \PHPUnit_Framework_TestCase implements ReadWriteStoreTestInterface {
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
	 * @var StoreFactory
	 */
	private $factory = null;

	/**
	 */
	public function testHas() {
		$store = $this->getStore();
		\PHPUnit_Framework_Assert::assertFalse($store->has('test'));

		$store->set('test', 123);
		\PHPUnit_Framework_Assert::assertTrue($store->has('test'));

		$store->remove('test');
		\PHPUnit_Framework_Assert::assertFalse($store->has('test'));
	}

	/**
	 */
	public function testHas_InvalidArgumentException() {
		$store = $this->getStore();
		try {
			$store->get('test');
		} catch (InvalidArgumentException $e) {
			\PHPUnit_Framework_Assert::assertFalse(false, 'Store has thrown an unexpected exception.');
		}
		$this->checkExpectedExceptions1(function ($parameter) use ($store) {
			$store->get($parameter);
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
		$store = $this->getStore();
		$store->set('test', 123);
		\PHPUnit_Framework_Assert::assertEquals(123, $store->get('test', 1234));

		$store->set('test', 1234);
		\PHPUnit_Framework_Assert::assertEquals(1234, $store->get('test', 123));

		$store->remove('test');
		\PHPUnit_Framework_Assert::assertEquals(123, $store->get('test', 123));
	}

	/**
	 */
	public function testGet_InvalidArgumentException() {
		$store = $this->getStore();
		try {
			$store->get('test', 1234);
		} catch (InvalidArgumentException $e) {
			\PHPUnit_Framework_Assert::assertFalse(false, 'Store has thrown an unexpected exception.');
		}
		$this->checkExpectedExceptions1(function ($parameter) use ($store) {
			$store->get($parameter, 1234);
		});
		$this->checkExpectedExceptions2(function ($parameter) use ($store) {
			$store->get('test', $parameter);
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
	public function testSet() {
		# Already tested by self::testGet()
		$this->assertTrue(true);
	}

	/**
	 */
	public function testSet_InvalidArgumentException() {
		$store = $this->getStore();
		try {
			$store->set('test', 1234);
		} catch (InvalidArgumentException $e) {
			\PHPUnit_Framework_Assert::assertTrue(false, 'Store has thrown an unexpected exception.');
		}
		$this->checkExpectedExceptions1(function ($parameter) use ($store) {
			$store->set($parameter, 1234);
		});
		$this->checkExpectedExceptions2(function ($parameter) use ($store) {
			$store->set('test', $parameter);
		});
	}

	/**
	 */
	public function testSet_InvalidOperationException() {
		# Not possible here
		$this->assertTrue(true);
	}

	/**
	 */
	public function testRemove() {
		$store = $this->getStore();
		$store->set('remove-me', 1234);
		$store->remove('remove-me');

		$this->setExpectedException('Kir\\Stores\\KeyValueStores\\InvalidOperationException');
		$store->remove('remove-me');
	}

	/**
	 */
	public function testRemove_InvalidArgumentException() {
		$store = $this->getStore();
		try {
			$store->set('test', 1234);
			$store->remove('test');
		} catch (InvalidArgumentException $e) {
			\PHPUnit_Framework_Assert::assertTrue(false, 'Store has thrown an unexpected exception.');
		}
		$this->checkExpectedExceptions1(function ($parameter) use ($store) {
			$store->remove($parameter);
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
	protected function setStoreFactory(StoreFactory $factory) {
		$this->factory = $factory;
	}

	/**
	 */
	private function checkExpectedExceptions1(Closure $callback) {
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

		$this->checkExpectedExceptions2($callback);
	}

	/**
	 */
	private function checkExpectedExceptions2(Closure $callback) {
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

	/**
	 * @return ReadWriteStore
	 */
	private function getStore() {
		$store = $this->factory->getStore();
		\PHPUnit_Framework_Assert::assertInstanceOf('Kir\\Stores\\KeyValueStores\\ReadWriteStore', $store);
		return $store;
	}
}