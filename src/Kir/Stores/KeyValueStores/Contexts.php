<?php
namespace Kir\Stores\KeyValueStores;

use InvalidArgumentException;

interface Contexts {
	/**
	 * @param string $name
	 * @return bool
	 * @throws InvalidArgumentException
	 */
	public function has($name);

	/**
	 * @param string $name
	 * @return Store
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function get($name);

	/**
	 * @param string $name
	 * @return $this
	 * @throws InvalidOperationException
	 * @throws InvalidArgumentException
	 */
	public function remove($name);
}