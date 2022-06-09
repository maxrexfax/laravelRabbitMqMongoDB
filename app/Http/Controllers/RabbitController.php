<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Message\AMQPMessage;
use App\Jobs\SendTextJob;

class RabbitController extends Controller
{
    private $sendTextJob;

    public function __construct()
    {
        $this->sendTextJob = new SendTextJob();
    }

    public function index()
    {
        return view('rabbit.index');
    }

    public function sendText()
    {
        $data = "info: Hello World!";
        $this->sendTextJob->handle($data);
    }

    public function sendPost(Request $request)
    {
        $this->sendTextJob->handle($request->post('message'));
        return back();
    }
}
