<?php

namespace App\Console\Commands;
use App\Models\User;
use App\Events\TugilganKun;

use Carbon\Carbon;
use Illuminate\Console\Command;

class tkun extends Command
{
    protected $signature = 'demo:tkun';

    protected $description = 'Tugilgan kunlarga sms yuborish';

    public function handle(){
        $today = Carbon::today();
        $Tkunlar = User::whereRaw("DATE_FORMAT(tkun, '%m-%d') = ?", [$today->format('m-d')])->get();
        $Users = array();
        foreach($Tkunlar as $key => $item){
            TugilganKun::dispatch($item->id);
        }
    }
}
