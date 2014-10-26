<?php
namespace Kir\Stores\KeyValueStores;

use IteratorAggregate;

interface IterableReadWriteStore extends ReadWriteStore, IteratorAggregate {
}