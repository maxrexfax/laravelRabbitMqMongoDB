<?php

namespace App\Console\Commands;

use App\Models\RabbitMessage;
use DateTime;
use DateTimeZone;
use http\Message;
use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class GetQueueMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'rabbitmq:consume';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $exchange = 'laravel_exchange';
        $queueName = 'laravel_queue';

        $host = env('RABBITMQ_HOST');
        $user = env('RABBITMQ_USER');
        $pass = env('RABBITMQ_PASSWORD');
        $port = env('RABBITMQ_PORT');
        $connection = new AMQPStreamConnection($host, $port, $user, $pass);
        $channel = $connection->channel();
        $channel->exchange_declare($exchange, 'fanout', false, true, false);
        $channel->queue_declare('laravel_queue', false, true, false, false);
        $channel->queue_bind($queueName, $exchange);
        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) {
            echo $this->getDateTimeString() . ' [x] Received ', $msg->body, "\n";
            sleep(substr_count($msg->body, '.'));
            echo " [x] Done\n";
            $this->saveMessageToDB($msg->body);
            $msg->ack();
        };

        $channel->basic_qos(null, 1, null);
        $channel->basic_consume('laravel_queue', '', false, false, false, false, $callback);

        while ($channel->is_open()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
        return 0;
    }

    private function getDateTimeString()
    {
        $date = new DateTime("now", new DateTimeZone('Europe/Kiev') );
        return $date->format('Y-m-d H:i:s');
    }

    private function saveMessageToDB($text)
    {
        $message = new RabbitMessage();
        $message->message = $text;
        $message->save();
    }
}
