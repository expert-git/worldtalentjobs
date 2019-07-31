<?php

namespace App\Http\Controllers;

use App\Applied_job;
use App\block;
use App\catagory;
use App\enotification;
use App\job;
use App\notification;
use App\personaldetails;
use App\Utils\Utils;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Mail;

class alljobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('jobseeker');
    }

    public function index()
    {
        $ida = Auth::guard('jobseeker')->user()->id;

        // total apllied on specific user
        $totalApplied = $this->totalApplied($ida);
        return view('jobseeker.home', compact('totalApplied'));
    }

	##########Show All Jobs#########
    public function getmyjobs($id)
    {
        $comp = '=';
        if (!$id) {
            $id = 0;
        }
        if($id==0){
            $comp='>=';
        }
        $jobprofile = personaldetails::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get()[0];

        $applied = DB::table('applied_jobs')->where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get();
        $applied = count($applied);

        $accepted = DB::table('applied_jobs')->where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->where('status', 1)->get();
        $accepted = count($accepted);

        $scheduled = DB::table('applied_jobs')->where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->where('status', 3)->get();
        $scheduled = count($scheduled);

        $notifications = notification::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->where('sender', 1)->orderBy('created_at', 'desc')->take(2)->get();

        $catagories = catagory::all();
        $jobseeker_id = Auth::guard('jobseeker')->user()->id;
        $job = Applied_job::join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')
            ->join('empprofiles', 'empprofiles.employer_id', '=', 'applied_jobs.employer_id')
            ->select('applied_jobs.*', 'jobs.jobtitle', 'jobs.job_responsibilities', 'jobs.job_experiences_field', 'empprofiles.companyname', 'empprofiles.companylogo')
            ->where('applied_jobs.jobseeker_id', $jobseeker_id)->where('applied_jobs.status', $comp, $id)->paginate(10);
		$total = Applied_job::where("jobseeker_id", "=", Auth::guard('jobseeker')->user()->id)->count();
		$pageno = 1;
        if (count($job)) {
            //  echo $jobseeker_id."<br>";
            return view('jobseeker.job', compact('total', 'job', 'notifications', 'applied', 'jobprofile', 'catagories', 'pageno', 'id', 'accepted', 'scheduled'));
        } else {
            $message = 'no data found';
            return view('jobseeker.job', compact('total', 'message', 'notifications', 'applied', 'jobprofile', 'catagories', 'pageno', 'id', 'accepted', 'scheduled'));
        }

    }

    public function showalljobs()
    {
        $catagories = catagory::all();
        $jobseeker_id = Auth::guard('jobseeker')->user()->id;
        /*        $blockcheck=block::where('jobseeker_id',$jobseeker_id)->pluck('employer_id');
        $followcheck=follower::where('jobseeker_id',$jobseeker_id)->get();
        $fl='';
        foreach($followcheck as $f){
        $fl=$f->employer_id;
        }
        if(count($blockcheck)>0 && count($followcheck)>0){
        $job=job::where('published',1)->whereNotIn('employer_id',$blockcheck)->orderByRaw('employer_id in('.$fl.') desc, id desc')->paginate(2);

        if(count($job))

        {

        return view('jobseeker.job',compact('job','catagories'));
        }else{
        $message ='no data found';
        return view('jobseeker.job',compact('message','catagories'));
        }
        }
        else if(count($blockcheck)>0){
        $job=job::where('published',1)->whereNotIn('employer_id',$blockcheck)->orderBy('id','desc')->paginate(2);

        if(count($job))
        {

        return view('jobseeker.job',compact('job','catagories'));
        }else{
        $message ='no data found';
        return view('jobseeker.job',compact('message','catagories'));
        }
        }
        else if(count($followcheck)>0){
        $job=job::where('published',1)->orderByRaw('employer_id in ('.$fl.')desc, id desc')->paginate(2);

        if(count($job))

        {

        return view('jobseeker.job',compact('job','catagories'));
        }else{
        $message ='no data found';
        return view('jobseeker.job',compact('message','catagories'));
        }
        }
        else{*/

        $job = job::where('published', 1)->orderBy('id', 'desc')->paginate(10);
        if (count($job)) {

            return view('jobseeker.job', compact('job', 'catagories'));
        } else {
            $message = 'no data found';
            return view('jobseeker.job', compact('message', 'catagories'));
        }

        //    }
    }

    public function show($id)
    {
        $catagories = catagory::all();
        $jobseeker_id = Auth::guard('jobseeker')->user()->id;
        $blockcheck = block::where('jobseeker_id', $jobseeker_id)->pluck('employer_id');
        if (count($blockcheck) > 0) {
            //$job=job::where('published',1)->whereNotIn('employer_id',$blockcheck)->paginate(2);
            $catjobs = job::where('catagory_id', $id)->where('published', 1)->whereNotIn('employer_id', $blockcheck)->paginate(2);
            return view('jobseeker.showjobsbycat', compact('catjobs', 'catagories'));

        } else {

            $catjobs = job::where('catagory_id', $id)->where('published', 1)->paginate(2);
            return view('jobseeker.showjobsbycat', compact('catjobs', 'catagories'));
        }
    }

    public function jobsdescription($id)
    {
        $apply = 'false';
        $catid = DB::table('jobs')->where('jobs.id', $id)->pluck('catagory_id');
        //return $catid;
        $relatedJobs = DB::table('jobs')->where('jobs.catagory_id', $catid)->where('jobs.id', '!=', $id)->join('empprofiles', 'jobs.employer_id', '=', 'empprofiles.employer_id')->join('divisions', 'jobs.division_id', '=', 'divisions.id')->select('jobs.*', 'divisions.name as divname', 'empprofiles.companylogo as clogo')->
            take(10)->orderByRaw("Rand()")->get();

        $catagories = catagory::all();
        $jobdata = job::
            join('empprofiles', 'jobs.employer_id', '=', 'empprofiles.employer_id')
            ->join('catagories', 'jobs.catagory_id', '=', 'catagories.id')
            ->join('industrytypes', 'jobs.industrytype_id', '=', 'industrytypes.id')
            ->join('districts', 'jobs.district_id', '=', 'districts.id')
            ->join('divisions', 'jobs.division_id', '=', 'divisions.id')

            ->select('jobs.*', 'empprofiles.companyname', 'empprofiles.companylogo', 'empprofiles.companyaddress', 'catagories.catagoryname', 'industrytypes.industrytypename', 'districts.name as distname', 'divisions.name as divname')
            ->where('jobs.id', $id)
            ->get();
        if (Auth::guard('jobseeker')->check()) {
            $jobseeker_id = Auth::guard('jobseeker')->user()->id;

            $check = Applied_job::where('job_id', $id)->where('jobseeker_id', $jobseeker_id)->get();
            $num_rows = count($check);
            if ($num_rows > 0) {
                $apply = 'true';
            }

        }
        return view('jobseeker.showjobsbyid', compact('jobdata', 'catagories', 'apply', 'relatedJobs'));
        // return $jobdata;

    }

    public function applywithoutquestions($id)
    {
        $jobseeker_id = Auth::guard('jobseeker')->user()->id;
        $check = Applied_job::where('job_id', $id)->where('jobseeker_id', $jobseeker_id)->get();
        $num_rows = count($check);
        if ($num_rows > 0) {
            Session::flash('applied', 'You are allready applied for this job.');
            return redirect(url('jobseeker/alljobsshow/' . $id));
        } else {
            $job = job::find($id);

            $notif = new notification();
            $notif->job_id = $id;
            $notif->jobseeker_id = $jobseeker_id;
            $notif->sender = 0;
            $notif->message = "Applied for your job <b>" . $job->jobtitle . "</b>";
            $notif->save();

            $employerId = DB::table('jobs')->where('id', $id)->select('employer_id')->get();
            $newAppliedJob = new Applied_job([
                'job_id' => $id,
                'jobseeker_id' => $jobseeker_id,
                'employer_id' => $employerId[0]->employer_id]);
            $newAppliedJob->status = '0';
            $newAppliedJob->save();
            Session::flash('applied', 'You are succesfully applied');

            $jobprofile=personaldetails::where('jobseeker_id',$jobseeker_id)->first();
            Mail::send('Email.jobapplied', ['hasQuestions' => false, 'job' => $job, 'jobprofile' => $jobprofile, 'newAppliedJob' => $newAppliedJob], function ($m) use ($job, $jobprofile) {
                $m->from("worldtalentjobs@gmail.com", "WorldTalentJobs");
                $m->to($job->employer->email, $job->employer->name);
                $m->subject($jobprofile->first_name . ' ' . $jobprofile->last_name . ' applied for your job - ' . $job->jobtitle);
            });

            return redirect(url('jobseeker/managejobs/0'));
        }
    }

    public function applywithquestions(Request $data)
    {
        Validator::make($data->all(), [
            'language' => 'required',
        ])->validate();


        $jobseeker_id = Auth::guard('jobseeker')->user()->id;
        $check = Applied_job::where('job_id', $data->jobid)->where('jobseeker_id', $jobseeker_id)->get();
        $num_rows = count($check);
        if ($num_rows > 0) {
            Session::flash('applied', 'You are allready applied for this job.');
            return redirect(url('jobseeker/alljobsshow/' . $data->jobid));
        } else {
            $job = job::find($data->jobid);
            $rejected = false;
            if ($job->quest_notify == 1) {
                if ($job->quest_location_req == 1) {
                    if ($job->quest_location == 180 && $data->location != 1) {
                        $rejected = true;
                    }
                    if ($job->quest_location != 180 && $data->location == 1) {
                        $rejected = true;
                    }
                }
                if ($job->quest_exp_req == 1) {
                    if ($data->experience < $job->quest_exp_min || $data->experience > $job->quest_exp_max) {
                        $rejected = true;
                    }
                }
                if ($job->quest_salary_req == 1) {
                    $min_salary = 20000;
                    if ($data->salary == "1") $min_salary = 5000;
                    if ($data->salary == "2") $min_salary = 7000;
                    if ($data->salary == "3") $min_salary = 12000;
                    if ($data->salary == "4") $min_salary = 15000;
                    if ($data->salary == "5") $min_salary = 20000;
                    if ($job->quest_salary_max < $min_salary) {
                        $rejected = true;
                    }
                }
                if ($job->quest_license_req == 1) {
                    if ($data->license != 1) {
                        $rejected = true;
                    }
                }
                if ($job->quest_language_req == 1) {
                    if (strpos($job->quest_language, $data->language) === false) {
                        $rejected = true;
                    }
                }
                if ($job->quest_min_edu_req == 1) {
                    if ($job->quest_min_edu > $data->education) {
                        $rejected = true;
                    }
                }
            }
            if ($rejected == false) {
                $notif = new notification();
                $notif->job_id = $data->jobid;
                $notif->jobseeker_id = $jobseeker_id;
                $notif->sender = 0;
                $notif->message = "Applied for your job <b>" . $job->jobtitle . "</b>";
                $notif->save();
            }

            $employerId = DB::table('jobs')->where('id', $data->jobid)->select('employer_id')->get();
            $newAppliedJob = new Applied_job([
                'job_id' => $data->jobid,
                'jobseeker_id' => $jobseeker_id,
                'employer_id' => $employerId[0]->employer_id,
                'expected_salary' => $data->salary]);
            $newAppliedJob->location = $data->location;
            $newAppliedJob->license = $data->license;
            $newAppliedJob->experience = $data->experience;
            $newAppliedJob->language = $data->language;
            $newAppliedJob->education = $data->education;
            $newAppliedJob->status = $rejected ? '2' : '0';
            $newAppliedJob->save();
            Session::flash('applied', 'You are succesfully applied');

            if ($rejected == false) {
                $jobprofile=personaldetails::where('jobseeker_id',$jobseeker_id)->first();
                Mail::send('Email.jobapplied', ['hasQuestions' => false, 'job' => $job, 'jobprofile' => $jobprofile, 'newAppliedJob' => $newAppliedJob], function ($m) use ($job, $jobprofile) {
                    $m->from("worldtalentjobs@gmail.com", "WorldTalentJobs");
                    $m->to($job->employer->email, $job->employer->name);
                    $m->subject($jobprofile->first_name . ' ' . $jobprofile->last_name . ' applied for your job - ' . $job->jobtitle);
                });
            }

            return redirect(url('jobseeker/managejobs/0'));
        }
    }
    public function notifications()
    {
        $jobprofile = personaldetails::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get()[0];

        $applied = DB::table('applied_jobs')->where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get();
        $applied = count($applied);
        
        $notif = notification::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->where('sender', 1)->orderBy('created_at', 'desc')->paginate(20);
        $dt = [];
        $notif_count = 0;
        foreach($notif as $n){
            $d = DateTime::createFromFormat('Y-m-d H:i:s', $n->created_at);

            $interval = date_create('now')->diff($d);
            if($interval->d == 0){
                $dt[$n->id] = "Today";
            }
            else if($interval->d == 1){
                $dt[$n->id] = "Yesterday";
            }
            else{
                $dt[$n->id] = Utils::cdateformat2($n->created_at);
            }

            if ($n->job != null)
                $notif_count++;
        }

		$total = Applied_job::where("jobseeker_id", "=", Auth::guard('jobseeker')->user()->id)->count();

        $accepted = DB::table('applied_jobs')->where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->where('status', 1)->get();
        $accepted = count($accepted);

		$pageno=4;

        return view('jobseeker.notification', compact('total', 'applied', 'jobprofile', 'pageno', 'accepted', 'notif', 'notif_count', 'dt'));
	}
	
    public function applyjob(Request $data)
    {
        $jobseeker_id = Auth::guard('jobseeker')->user()->id;
        $check = Applied_job::where('job_id', $data->jobid)->where('jobseeker_id', $jobseeker_id)->get();
        $num_rows = count($check);
        if ($num_rows > 0) {
            Session::flash('applied', 'You are allready applied for this job.');
            return redirect(url('jobseeker/alljobsshow/' . $data->jobid));
        } else {

            $notif = new notification;
            $notif->jobseeker_id = Auth::guard('jobseeker')->user()->id;
            $notif->message = "Applied for job";
            $notif->job_id = $data->jobid;
            $notif->save();

/*    $enotif=new enotification;
$enotif->user_id=$data->employer_id;
$enotif->message="Applied for job";
$enotif->job_id=$data->jobid;
$entoif->jobseeker_id=Auth::guard('jobseeker')->user()->id;
$enotif->save();*/
            $employerId = DB::table('jobs')->where('id', $data->jobid)->select('employer_id')->get();
//return $employerId[0]->employer_id;
            Applied_job::create(['job_id' => $data->jobid, 'jobseeker_id' => $jobseeker_id, 'employer_id' => $employerId[0]->employer_id, 'expected_salary' => $data->expected_sallary]);
            Session::flash('applied', 'You are succesfully applied');
            return redirect(url('jobseeker/managejobs/0'));
        }
    }

// Specific jobseeker statastics

    private function totalApplied($id)
    {
        $applied = DB::table('applied_jobs')->where('jobseeker_id', $id)->get();
        return $totalApplied = count($applied);
    }

}
