<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SendTextJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private String $host;
    private String $user;
    private String $pass;
    private String $port;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->host = env('RABBITMQ_HOST');
        $this->user = env('RABBITMQ_USER');
        $this->pass = env('RABBITMQ_PASSWORD');
        $this->port = env('RABBITMQ_PORT');
    }
    /**
     * Выведет текст в консоли
     */
    public function handle($data)
    {
        $exchange = 'laravel_exchange';

        $connection = new AMQPSSLConnection($this->host, $this->port, $this->user, $this->pass);
        $channel = $connection->channel();
        $channel->exchange_declare($exchange, 'fanout', false, true, false);
        $channel->queue_declare('laravel_queue', false, true, false, false);

        $msg = new AMQPMessage($data);
        $channel->basic_publish($msg, $exchange);

        $channel->close();
        $connection->close();
    }

}
