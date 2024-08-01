<?php

namespace App\Http\Controllers;

use App\Services\MqttService;
use Illuminate\Http\Request;

class MqttController extends Controller
{
    protected $mqttService;

    public function __construct(MqttService $mqttService)
    {
        $this->mqttService = $mqttService;
    }

    public function publish(Request $request)
    {
        $topic = $request->input('topic');
        $message = $request->input('message');

        \Log::info('MQTT Publish Request Received', ['topic' => $topic, 'message' => $message]);

        if ($this->mqttService->publish($topic, $message)) {
            return response()->json(['message' => 'Message published successfully']);
        }

        return response()->json(['message' => 'Failed to publish message'], 500);
    }

    public function subscribe()
    {
        $topics['test/topic'] = ['qos' => 0, 'function' => function($topic, $msg){
            echo "Msg Received: " . date("r") . "\n";
            echo "Topic: {$topic}\n\n";
            echo "\t$msg\n\n";
        }];

        $this->mqttService->subscribe($topics);
    }
}

