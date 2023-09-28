<?php

namespace App\Jobs;

use App\Model\MtPegawai;
use App\Model\TxRent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;
use App\Notifications\NotifAlert;
use App\User;
use Illuminate\Notifications\Notification as NotificationsNotification;

class NotifPeminjaman implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pinjam = TxRent::where('is_done', false)->get();

        foreach ($pinjam as $item) {
            $DeferenceInDays = \Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($item->tgl_akhir);
            $user = User::find($item->user_id);
            if($DeferenceInDays >= 1){
                $user->notify(new NotifAlert());
            }
        }
    }
}
