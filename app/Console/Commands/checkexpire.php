<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\job;
use App\personaldetails;
use App\empprofile;
use App\jbsdate;
use App\empdate;
use Carbon\Carbon;



class checkexpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exp:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Expires data of users';

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
        $nowFormat = date('Y-m-d');
        job::where('deadline', '<', $nowFormat)->update(['status' => '2']);

        $alljobs=Job::where('featured','=',1)->get();
        $trueempdate =empdate::where('start_date','<=',Carbon::now())->where('end_date','>=',Carbon::now())->get();
        $jbsn = Job::where('featured','=','0')->whereNotNull('data_featured')->get();

        //var_dump($trueempdate);


        $jbsdates= personaldetails::where('is_need','=',1)->get();
        $truejbsdate =jbsdate::where('start_date','<=',Carbon::now())->where('end_date','>=',Carbon::now())->get();
        //var_dump($truejbsdate);
        foreach($jbsdates as $jbd)
        {
            $jbd->is_need=0;
            $jbd->save();
        }
        foreach ($truejbsdate as $tjbs)
        {
            $jbs = personaldetails::where('jobseeker_id','=',$tjbs->jbsid)->get()->first();
            if ($tjbs->start_date==Carbon::now())
            {
                $jbs->data_need =Carbon::now();
            }
            if (!is_null($jbs))
            {
                $jbs->is_need=1;
                $jbs->save();

            }
        }


        foreach ($alljobs as $job)
        {
            $job->featured =0;
            $job->save();
        }

        foreach ($trueempdate as $temps)
        {
            $emp = job::find($temps->empid);
            if ($temps->start_date==Carbon::now())
            {
                $emp->data_featured =Carbon::now();
            }
            if (!is_null($emp)){
                $emp->featured=1;
                $emp->save();
            }
        }
        foreach ($jbsn as $jb)
        {
            $jb->data_featured=NULL;
            $jb->save();
        }

    }
}
