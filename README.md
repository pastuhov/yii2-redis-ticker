# Yii2 redis ticker

[![Build Status](https://travis-ci.org/pastuhov/yii2-redis-ticker.svg)](https://travis-ci.org/pastuhov/yii2-redis-ticker)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pastuhov/yii2-redis-ticker/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pastuhov/yii2-redis-ticker/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/pastuhov/yii2-redis-ticker/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/pastuhov/yii2-redis-ticker/?branch=master)
[![Total Downloads](https://poser.pugx.org/pastuhov/yii2-redis-ticker/downloads)](https://packagist.org/packages/pastuhov/yii2-redis-ticker)

## Install

Via Composer

``` bash
$ composer require pastuhov/yii2-redis-ticker
```

## Features

* Just tick

## Usage

```php
$ticker = \Yii::createObject([
	'class' => \pastuhov\yii2redisticker\RedisTicker::className(),
	'redis' => $redisConnection
]);

$tickerName = 'tak';

if ($ticker->tick($tickerName, 15)) {
	$value++;
}
// value = 1

if ($ticker->tick($tickerName, 15)) {
	$value++;
}
// value = 1

sleep(20);

if ($ticker->tick($tickerName, 15)) {
	$value++;
}
// value = 3
```

## Testing

```bash
$ composer test
```
or
```bash
$ phpunit
```

## Debugging

For debugging purposes use:

```bash
$ redis-cli monitor
```
or 

```bash
$ tail -f tests/runtime/logs/app.log -n 1000
```

## Security

If you discover any security related issues, please email kirill@pastukhov.su instead of using the issue tracker.

## Credits

- [Kirill Pastukhov](https://github.com/pastuhov)
- [All Contributors](../../contributors)

## License

GNU General Public License, version 2. Please see [License File](LICENSE) for more information.
