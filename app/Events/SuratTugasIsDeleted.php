<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\SuratTugas;

class SuratTugasIsDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $surat_tugas;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SuratTugas $surat_tugas)
    {
        $this->surat_tugas = $surat_tugas;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
