SafeStream: Safety for Files
============================

[![Downloads this Month](https://img.shields.io/packagist/dm/nette/safe-stream.svg)](https://packagist.org/packages/nette/safe-stream)
[![Tests](https://github.com/nette/safe-stream/workflows/Tests/badge.svg?branch=master)](https://github.com/nette/safe-stream/actions)
[![Coverage Status](https://coveralls.io/repos/github/nette/safe-stream/badge.svg?branch=master)](https://coveralls.io/github/nette/safe-stream?branch=master)
[![Latest Stable Version](https://poser.pugx.org/nette/safe-stream/v/stable)](https://github.com/nette/safe-stream/releases)
[![License](https://img.shields.io/badge/license-New%20BSD-blue.svg)](https://github.com/nette/safe-stream/blob/master/license.md)


Introduction
------------

SafeStream guarantees that every read and write to a file is isolated. This means that no thread will start reading a file that is not yet fully written, or multiple threads will not overwrite the same file.

Installation:

```shell
composer require nette/safe-stream
```


What is it good for?
--------------------

What are isolated operations actually good for? Let's start with a simple example that repeatedly writes to a file and then reads the same string from it:

```php
$s = str_repeat('Long String', 10000);

$counter = 1000;
while ($counter--) {
	file_put_contents('file', $s); // write it
	$readed = file_get_contents('file'); // read it
	if ($s !== $readed) { // check it
		echo 'strings are different!';
	}
}
```

It may seem that `echo 'strings differ!'` can never occur. The opposite is true. Try running this script in two browser tabs at the same time. The error will occur almost immediately.

One of the tabs will read the file at a time when the other hasn't had a chance to write it all, so the content will not be complete.

Therefore, the code is not safe if it is executed multiple times at the same time (i.e. in multiple threads). Which is not uncommon on the internet, often a server is responding to a large number of users at one time. So ensuring that your application works reliably even when executed in multiple threads (thread-safe) is very important. Otherwise, data will be lost and hard-to-detect errors will occur.

But as you can see, PHP's native file read and write functions are not isolated and atomic.


How to use SafeStream?
----------------------

SafeStream creates a secure protocol to read and write files in isolation using standard PHP functions. All you need to do is to specify `nette.safe://` before the file name:

```php
file_put_contents('nette.safe://file', $s);
$s = file_get_contents('nette.safe://file');
```

SafeStream ensures that at most one thread can write to the file at a time. The other threads are waiting in the queue. If no thread is writing, any number of threads can read the file in parallel.

All common PHP functions can be used with the protocol, for example:

```php
// 'r' means open read-only
$handle = fopen('nette.safe://file.txt', 'r');

$ini = parse_ini_file('nette.safe://translations.neon');
```

-----

Documentation can be found on the [website](https://doc.nette.org/safe-stream). If you like it, **[please make a donation now](https://github.com/sponsors/dg)**. Thank you!
