<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\PengajuanKeuangan;
class PengajuanKeuanganIsCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pengajuan_keuangan;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PengajuanKeuangan $pengajuan_keuangan)
    {
        $this->pengajuan_keuangan = $pengajuan_keuangan;
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
