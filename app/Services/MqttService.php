<?php
// app/Services/MqttService.php

namespace App\Services;

use Bluerhinos\phpMQTT;

class MqttService
{
    protected $mqtt;

    public function __construct()
    {
        $server = env('MQTT_SERVER', '127.0.0.1');
        $port = env('MQTT_PORT', 1883);

        $this->mqtt = new phpMQTT($server, $port, uniqid());
    }

    public function publish($topic, $message, $qos = 0, $retain = false)
    {
        if ($this->mqtt->connect()) {
            $this->mqtt->publish($topic, $message, $qos, $retain);
            $this->mqtt->close();
            return true;
        }
        return false;
    }

    public function subscribe($topics)
    {
        if ($this->mqtt->connect()) {
            $this->mqtt->subscribe($topics, 0);
            while ($this->mqtt->proc()) {
            }
            $this->mqtt->close();
        }
    }
}
