<?php
namespace Kir\Stores\KeyValueStores\ComplianceTests;

interface ContextRepositoryTestInterface {
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
	public function testRemove();

	/**
	 */
	public function testRemove_InvalidArgumentException();

	/**
	 */
	public function testRemove_InvalidOperationException();
}