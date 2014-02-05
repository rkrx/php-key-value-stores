php-key-value-stores
====================

This project aims to provide a standard interface to common key-value-stores like memcache, redis or similar. If an author of a specific driver develops against these interfaces, is can be used everywhere the interfaces are implemented. This project does not ship a concrete implementations to existing stores.

Common interfaces
-----------------

The simple version of the key value stores provide methods to set, get and remove a entry. There is also a method to test if a entry is existing:

```
interface ReadWriteStore
	public function has($key);
	public function get($key, $default=null);
	public function set($key, $value);
	public function remove($key);
```

The `ReadWriteStore`-Interface has no own methods. It extends the 2 Interfaces `ReadableStore` and `WritableStore` which in turn extend from other, more basic interfaces. The idea behind this is described [here](http://en.wikipedia.org/wiki/Interface_segregation_principle).

![Inheritance](assets/diagram.png)