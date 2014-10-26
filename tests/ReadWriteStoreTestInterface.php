<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests;

interface ReadWriteStoreTestInterface {
	/**
	 */
	public function testHas();

	/**
	 */
	public function testHas_InvalidArgumentException();

	/**
	 */
	public function testHas_InvalidOperationException();

	/**
	 */
	public function testGet();

	/**
	 */
	public function testGet_InvalidArgumentException();

	/**
	 */
	public function testGet_InvalidOperationException();

	/**
	 */
	public function testSet();

	/**
	 */
	public function testSet_InvalidArgumentException();

	/**
	 */
	public function testSet_InvalidOperationException();

	/**
	 */
	public function testRemove();

	/**
	 */
	public function testRemove_InvalidArgumentException();

	/**
	 */
	public function testRemove_InvalidOperationException();
}