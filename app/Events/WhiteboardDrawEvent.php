<?php

namespace App\Events;

use App\Models\WhiteboardSession;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WhiteboardDrawEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $sessionCode;
    public int $userId;
    public string $userName;
    public array $drawingData;

    /**
     * Create a new event instance.
     */
    public function __construct(string $sessionCode, int $userId, string $userName, array $drawingData)
    {
        $this->sessionCode = $sessionCode;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->drawingData = $drawingData;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new PresenceChannel('whiteboard.' . $this->sessionCode),
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'drawing';
    }
}
