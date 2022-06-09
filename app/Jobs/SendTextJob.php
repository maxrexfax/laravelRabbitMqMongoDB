<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SendTextJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Выведет текст в консоли
     */
    public function handle()
    {
        $host = env('RABBITMQ_HOST');
        $vhost = '/';   // The default vhost is /
        $user = env('RABBITMQ_USER'); // The default user is guest
        $pass = env('RABBITMQ_PASSWORD'); // The default password is guest
        $port = env('RABBITMQ_PORT');

        $exchange = 'laravel_direct';

        $connection = new AMQPSSLConnection($host, $port, $user, $pass);
        $channel = $connection->channel();

        $channel->queue_declare('laravel_queue', false, true, false, false);

        $msg = new AMQPMessage($this->data);
        $channel->basic_publish($msg, $exchange);


        $channel->close();
        $connection->close();
        echo 'Message:"' . $this->data . "\" has been sent\n";
    }
}
