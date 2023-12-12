<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\OrderEvent;

class OrderEventUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderEvent;

    public function __construct($data)
    {
        $this->orderEvent = $data;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel("order-events"),
        ];
    }

    public function broadcastAs(): string
    {
        return 'updateStatus';
    }

    public function broadcastWith(): array
    {
        return [
            'data' => $this->orderEvent,
        ];
    }
}
