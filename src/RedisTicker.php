<?php
namespace pastuhov\yii2redisticker;

use Yii;
use yii\base\Component;
use yii\redis\Connection;
use yii\di\Instance;

/**
 * Redis ticker.
 */
class RedisTicker extends Component
{

    /**
     * @var \yii\redis\Connection
     */
    public $redis;

    /**
     * Init.
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->redis = Instance::ensure($this->redis, Connection::className());

    }

    /**
     * Acquires tick by given name.
     *
     * @param string $name of the tick to be acquired.
     * @param integer $timeout to wait for tick to become released.
     *
     * @return boolean tick result.
     */
    public function tick($name, $timeout = 1)
    {
        $redis = $this->getConnection();
        $tickValue = 1;
        $params = [
            $name, // Key name
            $tickValue, // Key value
            'NX', // Set if Not eXists
            'EX', // Expire time
            $timeout // Seconds
        ];
        $response = $redis->executeCommand('SET', $params);

        if ($response === true) {

            return true;
        }

        return false;
    }

    /**
     * @return \yii\redis\Connection
     */
    protected function getConnection()
    {
        return $this->redis;
    }
}
