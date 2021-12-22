<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $transactionCode;
    public $customer;
    public $amount;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($customer, $transactionCode, $amount)
    {
        $this->customer = $customer;
        $this->transactionCode = $transactionCode;
        $this->amount = $amount;

        $this->message = "{$customer} memesan dengan kode: {$transactionCode} sejumlah {$amount}";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('order-received');
    }
}
