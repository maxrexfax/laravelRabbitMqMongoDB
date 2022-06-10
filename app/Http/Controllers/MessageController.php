<?php

namespace App\Http\Controllers;

use App\Models\RabbitMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return view('messages.index', [
            'messages' => RabbitMessage::all()
        ]);
    }
}
