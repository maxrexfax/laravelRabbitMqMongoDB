<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Message\AMQPMessage;
use App\Jobs\SendTextJob;

class RabbitController extends Controller
{
    public function sendText()
    {
        $data = "info: Hello World!";
        (new SendTextJob())->handle($data);
    }

    public function getText()
    {
        (new SendTextJob())->getMessages();
    }
}
