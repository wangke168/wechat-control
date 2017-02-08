<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class UserDairyDetail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UserDairyDetail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'UserDairyDetail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        for ($x=-16; $x<=-1; $x++) {
            $y=$x+1;
            $z=$x+16;
            $from = date("Y-m-d", strtotime($x." day"));
            $to = date("Y-m-d", strtotime($y." day"));
            $row = DB::table('wx_user_add')
                ->whereDate('adddate', '>=', $from)
                ->whereDate('adddate', '<', $to)
                ->count();
            DB::table('wx_user_dairy_detail')
                ->insert('');
//            $date=strtotime("2002-02-20 UTC") * 1000;
//            $add[] = array('date' => $z, 'numbers' => $row);
        }
    }
    private function order_dairy()
    {

        $row_confirm = DB::table('wx_order_confirm')
            ->whereDate('adddate','>=', date("Y-m-d", strtotime("-1 day")))
            ->whereDate('adddate', '<', date("Y-m-d"))
            ->count();

        $row_send = DB::table('wx_order_send')
            ->whereDate('adddate','>=', date("Y-m-d", strtotime("-1 day")))
            ->whereDate('adddate', '<', date("Y-m-d"))
            ->count();
//            $other=$row_confirm-$row_send;

        DB::table('wx_order_dairy_detail')
            ->insert(['submit'=>$row_confirm,'confirm'=>$row_send,'date'=>date("Y-m-d", strtotime("-1 day"))]);
    }
    private function user_dairy()
    {
        $row_add = DB::table('wx_user_add')
            ->whereDate('adddate','>=', date("Y-m-d", strtotime("-1 day")))
            ->whereDate('adddate', '<', date("Y-m-d"))
            ->count();

        $row_esc = DB::table('wx_user_esc')
            ->whereDate('esc_time','>=', date("Y-m-d", strtotime("-1 day")))
            ->whereDate('esc_time', '<', date("Y-m-d"))
            ->count();
//            $other=$row_confirm-$row_send;

        DB::table('wx_user_dairy_detail')
            ->insert(['add'=>$row_add,'esc'=>$row_esc,'date'=>date("Y-m-d", strtotime("-1 day"))]);
    }
}
