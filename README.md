php-key-value-stores
====================

This project aims to provide a standard interface to common key-value-stores like memcache, redis or similar. If an author of a specific driver develops against these interfaces, is can be used everywhere the interfaces are implemented. This project does not ship a concrete implementations to existing stores.

Common interfaces
-----------------

The simple version of the key value stores provide methods to set, get and remove a entry. There is also a method to test if a entry is existing:

```PHP
interface Store {
	/** ... */
	public function has($key);

	/** ... */
	public function get($key, $default=null);

	/** ... */
	public function set($key, $value);

	/** ... */
	public function remove($key);
}
```