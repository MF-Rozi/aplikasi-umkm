<?php

namespace App\Events;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmed implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $payment;
    public $transaction;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Payment $payment, Transaction $transaction)
    {
        $this->payment = $payment;
        $this->transaction = $transaction;
    }

    public function broadcastOn() {
        return new PrivateChannel('payment');
    }

}
