<?php
namespace pastuhov\yii2redisticker\tests;

use Yii;
use pastuhov\yii2redisticker;

/**
 * Ticker test
 */
class RedisTickerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Basic test
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function testBasic()
    {
        $redis = $this->getRedis();
        /** @var \pastuhov\yii2redisticker\RedisTicker $ticker */
        $ticker = \Yii::createObject([
            'class' => \pastuhov\yii2redisticker\RedisTicker::className(),
            'redis' => $redis
        ]);
        $value = 0;
        $tickerName = 'tak';

        if ($ticker->tick($tickerName, 1)) {
            $value++;
        }

        $this->assertSame('1', $redis->get($tickerName));

        if ($ticker->tick($tickerName, 1)) {
            $value++;
        }

        sleep(1);

        $this->assertSame(null, $redis->get($tickerName));

        if ($ticker->tick($tickerName, 1)) {
            $value++;
        }
        $this->assertSame('1', $redis->get($tickerName));

        $this->assertSame(2, $value);

    }

    /**
     * @inheritdoc
     */
    public static function setUpBeforeClass()
    {
        \Yii::$app->setComponents(
            [
                'redis' => [
                    'class' => 'yii\redis\Connection',
                    'hostname' => 'localhost',
                    'port' => 6379,
                    'database' => 0,
                ],
            ]
        );
    }

    /**
     * @return \yii\redis\Connection
     */
    public static function getRedis()
    {
        /** @var \yii\redis\Connection $redis */
        $redis = \Yii::$app->redis;

        return $redis;
    }
}
