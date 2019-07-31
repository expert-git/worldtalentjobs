<?php

namespace App\Http\Controllers;
use App\Constants\Constants;
use App\Utils\Utils;
use App\employmenttype;
use App\visatype;
use App\CityArea;
use App\Applied_job;
use App\catagory;
use App\nationality;
use App\division;
use App\Education;
use App\Employer;
use App\empprofile;
use App\enotification;
use App\notification;
use App\industrytype;
use App\invite;
use App\job;
use App\personaldetails;
use App\Workexperience;
use App\JobTag;
use Auth;
use DB;
use DateTime;
use Illuminate\Http\Request;
//use App\job;
use Illuminate\Support\Facades\Session;
use App\EducationLevel;

class jobController extends Controller
{
    public function __construct()
    {
        $this->middleware('employer');
    }

    public function invites()
    {
        $division = $this->get_division();
        $catagorys = $this->get_categorys();
        $jobseekerlist = $this->getJobseekerList();
        $jobinvites = DB::table('empprofile')->paginate(10);
        return view('employer.invite', compact('jobinvites', 'division', 'catagorys', 'jobseekerlist'));
    }

    public function pausestatus($id)
    {
        $db = job::find($id);
        $db->status = 1;
        $db->save();
        return redirect('/employer/managejobs');
    }

    public function closestatus($id)
    {
        $db = job::find($id);
        $db->status = 2;
        $db->save();
        return redirect('/employer/managejobs');
    }

    public function activestatus($id)
    {
        $db = job::find($id);
        $db->status = 0;
        $db->save();
        return redirect('/employer/managejobs');
    }

    //get target location count.......
    private function get_num_of_rows_by_location_job($allapplied, $id) {
        $count = 0;
        foreach($allapplied as $aj){
            $array = explode(",", $aj->personaldetails->target_location);
            if(in_array(strval($id), $array)){
                $count++;
            }
        }
        return $count;
    }

    //count jobs by divisionwise
    private function count_cands_by_location($allapplied) {
        $counts=[];

        foreach(CityArea::all() as $c) {
            $counts[$c->id]=$this->get_num_of_rows_by_location_job($allapplied, $c->id);
        }

        return $counts;
    }
    
    private function countCatJob($allapplied, $id) {
        $count = 0;
        foreach($allapplied as $aj){
            $array = explode(",", $aj->personaldetails->target_tags);
            if(in_array(strval($id), $array)){
                $count++;
            }
        }
        return $count;
    }

    private function countCategoryWiseJob($allapplied) {
        $categorys=Utils::categories();

        $array=array();

        foreach ($categorys as $cat) {
            $array[$cat->id]=$this->countCatJob($allapplied, $cat->id);
        }

        return $array;

    }
    

    private function particular_count_industrytype($allapplied) {
        $array=[];
    
        foreach(Utils::get_industrytype() as $i) {
          $array[$i->id]=$this->count_industrytypesjob($allapplied, $i->industrytypename);
        }
    
        return $array;
    
    }

    private function count_industrytypesjob($allapplied, $name) {
        $count = 0;
        foreach($allapplied as $aj){
            if($aj->personaldetails->target_industry==$name){
                $count++;
            }
        }
        return $count;
    }


    //all jobtype filterable candidates start----------------
    public function jobtypecount($allapplied) {
        $etypes = employmenttype::all();

        $e_jobs = [];
        foreach($etypes as $et){
            $e_jobs[$et->id]=$allapplied->where('personaldetails.target_employment_type', $et->name)->count();
        }
        return $e_jobs;

    }

    //all visatype filterable candidates start----------------
    public function visatypecount($allapplied) {
        $vtypes = visatype::all();

        $e_jobs = [];
        foreach($vtypes as $et){
            $e_jobs[$et->id]=$allapplied->where('personaldetails.VISA_status', $et->name)->count();
        }
        return $e_jobs;
    }


    //all nationality filterable candidates start----------------
    public function nationalitycount($allapplied) {
        $nationality = nationality::all();

        $e_jobs = [];
        foreach($nationality as $n){
            $e_jobs[$n->id]=$allapplied->where('personaldetails.jobseeker_nationality', $n->name)->count();
        }
        return $e_jobs;
    }

    public function getAllCandidates($status = 0)
    {
        //    echo $status;
        $id = Auth::guard('employer')->user()->id;
        $pageno = 2;
        $myprofile = empprofile::where('employer_id', $id)->get();
        $myprofile = $myprofile[0];
        if($status == 0){
            $applicants = Applied_job::join('personaldetails', 'personaldetails.jobseeker_id', '=', 'applied_jobs.jobseeker_id')
                ->join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')
                ->select('jobs.jobtitle', 'jobs.job_responsibilities', 'applied_jobs.id as aj', 'applied_jobs.*', 'personaldetails.*', 'personaldetails.id as pi')
                ->where('applied_jobs.employer_id', Auth::guard('employer')->user()->id)
                ->paginate(10);
        }
        else{
            $applicants = Applied_job::join('personaldetails', 'personaldetails.jobseeker_id', '=', 'applied_jobs.jobseeker_id')
                ->join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')
                ->select('jobs.jobtitle', 'jobs.job_responsibilities', 'applied_jobs.id as aj', 'applied_jobs.*', 'personaldetails.*', 'personaldetails.id as pi')
                ->where('applied_jobs.employer_id', Auth::guard('employer')->user()->id)
                ->where('applied_jobs.status', $status)
                ->paginate(10);
        }
        
        $clss = 1;

        $jobs = job::where('employer_id', Auth::guard('employer')->user()->id)->pluck('id');
        
        $notif = notification::whereIn('job_id', $jobs)->where('sender', 0)->orderBy('created_at', 'desc')->take(2)->get();

        $comp = '=';
        if($status == 0){
            $comp = '>=';
        }
        $allapplied=Applied_job::where('employer_id', $id)->where('status', $comp, $status)->get();

        $all = $this->count_by_status1($id, 0);
        $shortlisted = $this->count_by_status1($id, 1);
        $rejected = $this->count_by_status1($id, 2);
        $scheduled = $this->count_by_status1($id, 3);
        $spam = $this->count_by_status1($id, 4);

        $nowFormat = date('Y-m-d');
        $ida = Auth::guard('employer')->user()->id;

        // $alljobs = DB::table('jobs')->where('employer_id', $ida)->count();
        // $active = DB::table('jobs')->where('employer_id', $ida)->where('deadline', '>', $nowFormat)->where('delete_status', 0)->count();
        $alljobs = DB::table('jobs')->where([['employer_id', $ida], ['published',1]])->count();
        $active = job::where([['employer_id', $ida], ['published',1]])->where('status', 0)->where('delete_status', 0)->count();

        $category=Utils::get_category();
        $city_areas=Utils::get_cityareas();
        $count_by_div=$this->count_cands_by_location($allapplied);
        $countCategoryWiseJob=$this->countCategoryWiseJob($allapplied);

        $categorysForCountJob=DB::table('catagories')->get();

        $get_ind=$this->get_industrytype();
        $pic=$this->particular_count_industrytype($allapplied);

        $etypes = employmenttype::all();
        $jobtypecount=$this->jobtypecount($allapplied);
        
        $vtypes = visatype::all();
        $visatypecount=$this->visatypecount($allapplied);

        $nationalities = nationality::all();
        $nation_count=$this->nationalitycount($allapplied);

        $noccount['1'] = $allapplied->where('personaldetails.NOC', 1)->count();
        $noccount['0'] = $allapplied->where('personaldetails.NOC', 0)->count();

        $gendercount['male'] = $allapplied->where('personaldetails.jobseeker_gender', 'male')->count();
        $gendercount['female'] = $allapplied->where('personaldetails.jobseeker_gender', 'female')->count();

        return view('employer.getAllCandidates', compact('clss', 'active', 'alljobs', 'notif', 'id', 'myprofile', 'applicants', 'all', 'shortlisted', 'rejected', 'scheduled', 'spam', 'status', 'category', 'city_areas', 'count_by_div', 'countCategoryWiseJob', 'categorysForCountJob', 'get_ind', 'pic', 'etypes', 'visatypecount', 'jobtypecount', 'vtypes', 'noccount', 'gendercount', 'nationalities', 'nation_count', 'pageno'));

    }

    public function candidatesfilter($status, Request $r){
        $id = Auth::guard('employer')->user()->id;
        
        $myprofile = empprofile::where('employer_id', $id)->get();
        $myprofile = $myprofile[0];
        
        $clss = 1;
        $notif = enotification::leftJoin('personaldetails', 'personaldetails.jobseeker_id', '=', 'enotifications.jobseeker_id')
            ->join('jobs', 'jobs.id', '=', 'enotifications.job_id')
            ->select('jobs.*', 'enotifications.*', 'enotifications.created_at as ec', 'personaldetails.*')
            ->where('enotifications.user_id', Auth::guard('employer')->user()->id)->take(2)->get();

        $comp = '=';
        if($status == '0'){
            $comp = '>=';
        }
        
        $allapplied=Applied_job::where('employer_id', $id)->where('status', $comp, $status)->get();

        $all = $this->count_by_status1($id, 0);
        $shortlisted = $this->count_by_status1($id, 1);
        $rejected = $this->count_by_status1($id, 2);
        $scheduled = $this->count_by_status1($id, 3);
        $spam = $this->count_by_status1($id, 4);

        $nowFormat = date('Y-m-d');
        $ida = Auth::guard('employer')->user()->id;

        // $alljobs = DB::table('jobs')->where('employer_id', $ida)->count();
        // $active = DB::table('jobs')->where('employer_id', $ida)->where('deadline', '>', $nowFormat)->where('delete_status', 0)->count();
        $alljobs = DB::table('jobs')->where([['employer_id', $ida], ['published',1]])->count();
        $active = job::where([['employer_id', $ida], ['published',1]])->where('status', 0)->where('delete_status', 0)->count();

        $category=Utils::get_category();
        $city_areas=Utils::get_cityareas();
        $count_by_div=$this->count_cands_by_location($allapplied);
        $countCategoryWiseJob=$this->countCategoryWiseJob($allapplied);

        $categorysForCountJob=DB::table('catagories')->get();

        $get_ind=Utils::get_industrytype();
        $pic=$this->particular_count_industrytype($allapplied);

        $etypes = employmenttype::all();
        $jobtypecount=$this->jobtypecount($allapplied);
        
        $vtypes = visatype::all();
        $visatypecount=$this->visatypecount($allapplied);

        $nationalities = nationality::all();
        $nation_count=$this->nationalitycount($allapplied);

        $noccount['1'] = $allapplied->where('personaldetails.NOC', 1)->count();
        $noccount['0'] = $allapplied->where('personaldetails.NOC', 0)->count();

        $gendercount['male'] = $allapplied->where('personaldetails.jobseeker_gender', 'male')->count();
        $gendercount['female'] = $allapplied->where('personaldetails.jobseeker_gender', 'female')->count();
        

        $allapplied=Applied_job::leftjoin('personaldetails', 'personaldetails.jobseeker_id', '=', 'applied_jobs.jobseeker_id')
                    ->join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')
                    ->select('jobs.jobtitle', 'jobs.job_responsibilities', 'applied_jobs.id as aj', 'applied_jobs.*', 'personaldetails.*', 'personaldetails.id as pi')
                    ->where('applied_jobs.employer_id', $id);

        $location_select = [];

        if($r->location) {
            // print_r($r->location);
            // exit();
            $array = $r->location;
            $allapplied=$allapplied->where(function ($query) use ($array){
                $cnt=0;
                foreach($array as $l){
                    $query->orWhere('personaldetails.target_location', 'like', '%,'.$l.',%')
                        ->orWhere('personaldetails.target_location', 'like', '%'.$l.',%')
                        ->orWhere('personaldetails.target_location', 'like', '%,'.$l.'%')
                        ->orWhere('personaldetails.target_location', $l);
                    $cnt++;
                }
            });

            foreach($r->location as $i){
                $location_select[$i] = 1;
                $location_select[CityArea::find($i)->parent_id] = 1;
            }
        }

        $industry_select = [];
        if($r->industry) {
            $allapplied=$allapplied->whereIn('personaldetails.target_industry', $r->industry);
            foreach($r->industry as $i){
                $industry_select[$i] = 1;
            }
        }

        $category_select = [];
        if($r->category) {
            $array = $r->category;
            $allapplied=$allapplied->Where(function ($query) use ($array){
                foreach($array as $l){
                    $query->orWhere('personaldetails.target_tags', 'like', '%,'.$l.',%')
                            ->orWhere('personaldetails.target_tags', 'like', '%'.$l.',%')
                            ->orWhere('personaldetails.target_tags', 'like', '%,'.$l.'%')
                            ->orWhere('personaldetails.target_tags', $l);
                }
            });
            foreach($r->category as $i){
                $category_select[$i] = 1;
            }
        }

        $visatype_select = [];
        if($r->visatype) {
            $allapplied=$allapplied->whereIn('personaldetails.VISA_status', $r->visatype);
            foreach($r->visatype as $i){
                $visatype_select[$i] = 1;
            }
        }

        $noc_select = [];
        if($r->NOC) {
            $allapplied=$allapplied->whereIn('personaldetails.NOC', $r->NOC);
            foreach($r->NOC as $i){
                $noc_select[$i] = 1;
            }
        }

        $nation_select = [];
        if($r->nation) {
            $allapplied=$allapplied->whereIn('personaldetails.jobseeker_nationality', $r->nation);
            foreach($r->nation as $i){
                $nation_select[$i] = 1;
            }
        }

        $gender_select = [];
        if($r->gender) {
            $allapplied=$allapplied->whereIn('personaldetails.jobseeker_gender', $r->gender);
            foreach($r->gender as $i){
                $gender_select[$i] = 1;
            }
        }

        $jobtype_select = [];
        if($r->jobtype) {
            $allapplied=$allapplied->whereIn('personaldetails.target_employment_type', $r->jobtype);
            foreach($r->jobtype as $i){
                $jobtype_select[$i] = 1;
            }
        }

        $minsalary = -1;
        if($r->salary != '') {
            $allapplied=$allapplied->where('expected_salary', '>=', $r->salary);
            $minsalary = $r->salary;
        }

        $minexperience = -1;
        if($r->experience != '') {
            $allapplied=$allapplied->where('experience', '>=', $r->experience);
            $minexperience = $r->experience;
        }

        $keyword="";
        if($r->keyword) {
            $allapplied=$allapplied->where('personaldetails.target_title', 'like', "%".$r->keyword."%");
            $keyword = $r->keyword;
        }

        $applicants = $allapplied->select('jobs.jobtitle', 'jobs.job_responsibilities', 'applied_jobs.id as aj', 'applied_jobs.*', 'personaldetails.*', 'personaldetails.id as pi')
                ->where('applied_jobs.status', $comp, $status)
                ->groupBy('applied_jobs.id')
                ->paginate(10);

        return view('employer.getAllCandidates', compact('clss', 'active', 'alljobs', 'notif', 'id', 'myprofile', 'applicants', 'all', 'shortlisted', 'rejected', 'scheduled', 'spam', 'status', 'category', 'city_areas', 'count_by_div', 'countCategoryWiseJob', 'categorysForCountJob', 'get_ind', 'pic', 'etypes', 'visatypecount', 'jobtypecount', 'vtypes', 'noccount', 'gendercount', 'nationalities', 'nation_count', 'location_select', 'industry_select', 'category_select', 'visatype_select', 'noc_select', 'nation_select', 'gender_select', 'jobtype_select', 'minsalary', 'minexperience', 'keyword'));
    }

    public function changeCandidatestatus($id, $status, Request $request)
    {
        $db = Applied_job::find($id);
        $db->status = $status;

        $notif = new notification();
        $notif->job_id = $db->job_id;
        $notif->jobseeker_id = $db->jobseeker_id;
        $notif->sender = 1;

        if ($status == 1) {
            $notif->message = "You have been shortlisted.";
            $notif->save();
        }
        elseif ($status == 2) {
            $notif->message = "You have been rejected.";
        }
        elseif ($status == 3) {
            $db->scheduled_time = $request->time;
            $notif->message = "An Interview has been scheduled on ".Utils::cdateformat3($request->time);
            $notif->save();
        }
        elseif ($status == 4) {
            $notif->message = "You have been marked as a spam.";
        }

        $db->save();
//        return redirect('/employer/managejobs');
        return redirect('/employer/getAllCandidates');
    }
    public function invite($jobid, $jsid)
    {
        $js = new invite();
        $js->employer_id = Auth::guard('employer')->user()->id;
        $js->user_id = $jsid;
        $js->job_id = $jobid;
        $js->save();

        $notif = new enotification;
        $notif->user_id = Auth::guard('employer')->user()->id;
        $notif->jobseeker_id = $jsid;
        $notif->message = "Invited for job";
        $notif->job_id = $jobid;
        $notif->save();

        return redirect('/employer/invites/' . $jobid);
    }

    public function getInvites($id, Request $data)
    {
        $division = $this->get_division();
        $catagorys = $this->get_categorys();
        $jobseekerlist = $this->getJobseekerList();
        $jobinvites = DB::table('personaldetails');
        $get_ind = $this->get_industrytype();

        $divs = $data->division;
        $industries = $data->industry;
        $cats = $data->category;
        for ($i = 0; $i < count($divs); $i++) {
            //    echo $divs[$i]."<br />";
        }
        $invi = invite::where('job_id', $id)->get();
        if ($invi) {
            $arr = array();
            for ($i = 0; $i < count($invi); $i++) {
                array_push($arr, $invi[$i]->user_id);
            }
            $jobinvites = $jobinvites->whereNotIn('jobseeker_id', $arr);

        }
        if ($divs) {
            $jobinvites = $jobinvites->orwhereIn('target_location', $divs);
        }

        if ($industries) {
            $jobinvites = $jobinvites->orwhereIn('target_industry', $industries);
        }

        if ($cats) {
            $jobinvites = $jobinvites->orwhereIn('target_tags', $cats);
        }

        $inv = $jobinvites->paginate(10);

        //    print_r($inv);
        for ($i = 0; $i < count($industries); $i++) {
            //    echo $industries[$i]."<br />";
        }

        for ($i = 0; $i < count($cats); $i++) {
            //    echo $cats[$i]."<br />";
        }
        /*
        $jobinvites = invite::join('jobseekers', 'invites.user_id', '=', 'jobseekers.id')
        ->join('jobs', 'jobs.id', '=', 'invites.job_id')
        ->select('jobseekers.name as name','invites.*','jobs.jobtitle')
        ->where('invites.employer_id',Auth::guard('employer')->user()->id)->paginate(10);
         */
        return view('employer.invite', compact('id', 'inv', 'division', 'catagorys', 'jobseekerlist', 'get_ind'));

    }

    public function appliedJobMail($id, $jsid)
    {
        return redirect(url('/employer/jobdetails/'.$id.'/'.$jsid));
    }

    public function jobdetails($id, $jsid)
    {
        if($jsid == 0) {
            $firstcand = DB::table('applied_jobs')->where("job_id", $id)->get()[0];
            $jsid = $firstcand->jobseeker_id;
        }
        $myprofile = empprofile::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $myprofile = $myprofile[0];

        $applicants = Applied_job::join('personaldetails', 'personaldetails.jobseeker_id', '=', 'applied_jobs.jobseeker_id')
            ->select('applied_jobs.id as aj', 'applied_jobs.*', 'personaldetails.id as pi', 'personaldetails.*')
            ->where('applied_jobs.job_id', $id)->get();

        $curapp = Applied_job::where('job_id', $id)->where('jobseeker_id', $jsid)->get()[0];
        $ajid = $curapp->id;

        //    print_r($applicants);

        $job = job::find($id);
        $jobprofile = personaldetails::where('jobseeker_id', $jsid)->get()[0];
        $tagstr = [];
        foreach(explode(",", $jobprofile->target_location) as $ti){
            if($ti == "") continue;
            array_push($tagstr, CityArea::find($ti)->name);
        }
        $jobprofile->target_locations = implode(", ", $tagstr);
        // $jobprofile = personaldetails::find($jobprofile[0]->id);
        // $jobprofile->cv = json_decode($jobprofile->cv);

        // $edu = Education::find($jsid);
        // $edu->details = json_decode($edu->details);

        // $edu->degree = json_decode($edu->degree);

        // $exp = Workexperience::find($jsid);
        // $exp->experience = json_decode($exp->experience);

        $nowFormat = date('Y-m-d');
        $ida = Auth::guard('employer')->user()->id;

        // $alljobs = DB::table('jobs')->where('employer_id', $ida)->count();
        // $active = DB::table('jobs')->where('employer_id', $ida)->where('deadline', '>', $nowFormat)->where('delete_status', 0)->count();
        $alljobs = DB::table('jobs')->where([['employer_id', $ida], ['published',1]])->count();
        $active = job::where([['employer_id', $ida], ['published',1]])->where('status', 0)->where('delete_status', 0)->count();
        $enumDegrees = Constants::$enumDegrees;
        $countryt=DB::table('country')->get();
        $country = [];
        foreach( $countryt as $cnt ){
            $country[$cnt->code] = $cnt->name;
        }

        $pageno = 1;
        return view('employer.jobdetails', compact('alljobs', 'active', 'myprofile', 'job', 'id', 'applicants', 'jobprofile', 'enumDegrees', 'country', 'ajid', 'pageno'));

    }
    public function getNotifications()
    {
        $myprofile = empprofile::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $myprofile = $myprofile[0];
        $jobs = job::where('employer_id', Auth::guard('employer')->user()->id)->pluck('id');
        
        $notif = notification::whereIn('job_id', $jobs)->where('sender', 0)->orderBy('created_at', 'desc')->paginate(20);
        $dt = [];
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
        }

        $nowFormat = date('Y-m-d');
        $ida = Auth::guard('employer')->user()->id;

        // $alljobs = DB::table('jobs')->where('employer_id', $ida)->count();
        // $active = DB::table('jobs')->where('employer_id', $ida)->where('delete_status', 0)->count();
        $alljobs = DB::table('jobs')->where([['employer_id', $ida], ['published',1]])->count();
        $active = job::where([['employer_id', $ida], ['published',1]])->where('status', 0)->where('delete_status', 0)->count();

        $pageno=4;

        return view('employer.notification', compact('alljobs', 'active', 'myprofile', 'notif', 'dt', 'pageno'));
    }
    public function getCandidates($id, $status)
    {

        $myprofile = empprofile::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $myprofile = $myprofile[0];
        $applicants = Applied_job::join('personaldetails', 'personaldetails.jobseeker_id', '=', 'applied_jobs.jobseeker_id')
            ->select('applied_jobs.id as aj', 'applied_jobs.*', 'personaldetails.*')
            ->where('applied_jobs.job_id', $id)->where('status', $status)->paginate(10);
        $jobdata = job::find($id);
        $notif = enotification::leftJoin('personaldetails', 'personaldetails.jobseeker_id', '=', 'enotifications.jobseeker_id')
            ->join('jobs', 'jobs.id', '=', 'enotifications.job_id')
            ->select('jobs.*', 'enotifications.*', 'enotifications.created_at as ec', 'personaldetails.*')
            ->where('enotifications.user_id', Auth::guard('employer')->user()->id)->take(2)->get();

        $nowFormat = date('Y-m-d');
        $ida = Auth::guard('employer')->user()->id;

        // $alljobs = DB::table('jobs')->where('employer_id', $ida)->count();
        // $active = DB::table('jobs')->where('employer_id', $ida)->where('deadline', '>', $nowFormat)->where('delete_status', 0)->count();
        $alljobs = DB::table('jobs')->where([['employer_id', $ida], ['published',1]])->count();
        $active = job::where([['employer_id', $ida], ['published',1]])->where('status', 0)->where('delete_status', 0)->count();

        $all = $this->count_by_status($id, 0);
        $shortlisted = $this->count_by_status($id, 1);
        $rejected = $this->count_by_status($id, 2);
        $scheduled = $this->count_by_status($id, 3);
        $spam = $this->count_by_status($id, 4);
        return view('employer.getCandidates', compact('alljobs', 'active', 'notif', 'id', 'myprofile', 'applicants', 'jobdata', 'all', 'shortlisted', 'rejected', 'scheduled', 'spam'));
	}
	
    public function managejobs()
    {
        $myprofile = empprofile::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $myprofile = $myprofile[0];

        $pageno=1;

        $jobs = job::where('employer_id', Auth::guard('employer')->user()->id)->pluck('id');
        
        $notif = notification::whereIn('job_id', $jobs)->where('sender', 0)->orderBy('created_at', 'desc')->take(2)->get();

        $ida = Auth::guard('employer')->user()->id;

        $nowFormat = date('Y-m-d');

        //all active jobs
        $active = job::where([['employer_id', $ida], ['published',1]])->where('status', 0)->where('delete_status', 0)->count();
        $activejob = job::where([['employer_id', $ida], ['published',1]])->where('status', 0)->where('delete_status', 0)->paginate(10);
        //paused jobs
        $paused = job::where([['employer_id', $ida], ['published',1]])->where('status', 1)->count();
        $pausedjob = job::where([['employer_id', $ida], ['published',1]])->where('status', 1)->paginate(10);
        //closed
        $closedjob = job::where([['employer_id', $ida], ['published',1]])->where('status', 2)->paginate(10);
        $allclosedjob = job::where([['employer_id', $ida], ['published',1]])->where('status', 2)->get();
        $closed = $allclosedjob->count();
        foreach($allclosedjob as $j){
            $j->status = 2;
            $j->save();
        }

        $alljobs = DB::table('jobs')->where([['employer_id', $ida], ['published',1]])->count();
        $applied2 = array();

        foreach ($activejob as $j) {
            $applied2[$j->id] = $this->count_apply_particular_job($j->id);
        }
        foreach ($pausedjob as $j) {
            $applied2[$j->id] = $this->count_apply_particular_job($j->id);
        }
        foreach ($closedjob as $j) {
            $applied2[$j->id] = $this->count_apply_particular_job($j->id);
        }
        return view('employer.job', compact('alljobs', 'myprofile', 'notif', 'applied2', 'activejob', 'pausedjob', 'closedjob', 'active', 'paused', 'closed', 'pageno'));
    }

    public function edit_a_job($jobid)
    {
        $job = job::find($jobid);
        $myprofile = empprofile::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $myprofile = $myprofile[0];
        $category = DB::table('catagories')->select('catagoryname', 'id')->get();
        $industry = DB::table('industrytypes')->select('industrytypename', 'id')->get();
        $countries = DB::table('country')->select('name', 'id')->get();

        $job->deadline = date_format(DateTime::createFromFormat('Y-m-d', $job->deadline), "d/m/Y");

        $division = DB::table('divisions')->get();
        $cityareas=DB::table('city_areas')->get();

        $pageno = 1;
        $nowFormat = date('Y-m-d');
        $ida = Auth::guard('employer')->user()->id;

        $alljobs = DB::table('jobs')->where([['employer_id', $ida], ['published',1]])->count();
        $active = job::where([['employer_id', $ida], ['published',1]])->where('status', 0)->where('delete_status', 0)->count();
        $jtags = JobTag::all();

        return view('employer.edit_a_job', compact('alljobs', 'active', 'category', 'industry', 'division', 'myprofile', 'countries', 'cityareas', 'jtags', 'job', 'pageno'));
    }

    public function post_a_job()
    {
        $myprofile = empprofile::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $myprofile = $myprofile[0];
        $category = DB::table('catagories')->select('catagoryname', 'id')->get();
        $industry = DB::table('industrytypes')->select('industrytypename', 'id')->get();
        $countries = DB::table('country')->select('name', 'id')->get();

        $division = DB::table('divisions')->get();
        $cityareas=DB::table('city_areas')->get();

        $edulevels=EducationLevel::all();

        $nowFormat = date('Y-m-d');

        // $limit = $nowFormat->add(new DateInterval("P1M"));

        $limit = date("d/m/Y", strtotime("+1 month"));
        $ida = Auth::guard('employer')->user()->id;

        $alljobs = DB::table('jobs')->where([['employer_id', $ida], ['published',1]])->count();
        $active = job::where([['employer_id', $ida], ['published',1]])->where('status', 0)->where('delete_status', 0)->count();
        $jtags = JobTag::all();

        $jobs = job::where('employer_id', Auth::guard('employer')->user()->id)->pluck('id');
        
        $notif = notification::whereIn('job_id', $jobs)->where('sender', 0)->orderBy('created_at', 'desc')->take(2)->get();

        $pageno=0;

        return view('employer.postajob', compact('alljobs', 'notif', 'active', 'category', 'industry', 'division', 'myprofile', 'countries', 'cityareas', 'jtags', 'pageno', 'limit', 'edulevels'));
    }

    private function getJobseekerList()
    {
        $jobseekerList = DB::table('personaldetails')->orderBy('id', 'desc')->limit(20)
            ->get();
        if (count($jobseekerList) > 0) {
            return $jobseekerList;

        } else {
            return false;
        }
    }
    public function getjobsinfo()
    {

        $cat = catagory::pluck('catagoryname', 'id');
        $industry = industrytype::pluck('industrytypename', 'id');
        $ida = Auth::guard('employer')->user()->id;
        $job = DB::table('jobs')->where('employer_id', $ida)->paginate(2);

        // get countries
        $division = DB::table('divisions')->pluck('name', 'id');

        $applied2 = array();
        foreach ($job as $j) {
            $applied2[$j->id] = $this->count_apply_particular_job($j->id);
        }

        return view('employer.job', compact('applied2', 'cat', 'industry', 'job', 'division'));

    }
    // Count Total apply on particular job

    private function count_apply_particular_job($job_id)
    {
        $applied_on_job = DB::table('applied_jobs')->where('job_id', $job_id)->get();
        return count($applied_on_job);
    }

    private function count_by_status($job_id, $status)
    {
        $applied_on_job = DB::table('applied_jobs')->where('job_id', $job_id)->where('status', $status)->get();
        return count($applied_on_job);
    }

    private function count_by_status1($emp_id, $status)
    {
        $applied_on_job = DB::table('applied_jobs')->where('employer_id', $emp_id)->where('status', $status)->get();
        if($status == 0) {
            $applied_on_job = DB::table('applied_jobs')->where('employer_id', $emp_id)->get();
        }
        return count($applied_on_job);
    }

    private function count_by_status2($allapplied, $status)
    {
        $applied_on_job = $allapplied->where('applied_jobs.status', $status)->get();
        if($status == '0') {
            $applied_on_job = $allapplied->get();
        }
        return count($applied_on_job);
    }

    private function get_categorys()
    {
        $category = DB::table('catagories')->select('catagoryname', 'id')->get();
        if (count($category) > 0) {
            $individulalPart = ceil(count($category) / 3);
            $catfirst = DB::table('catagories')->select('catagoryname', 'id')->take($individulalPart)->get();

            $catfirstskip = count($catfirst);
            $catsecond = DB::table('catagories')->select('catagoryname', 'id')->skip($catfirstskip)->take($individulalPart)->get();

            $skipcatsecond = count($catsecond) + $catfirstskip;
            $catthird = DB::table('catagories')->select('catagoryname', 'id')->skip($skipcatsecond)->take($individulalPart)->get();
            return $allcat = [$catfirst, $catsecond, $catthird];
        } else {
            return false;
        }

    }

    private function get_division()
    {
        $country = DB::table('countries')->where('name', 'Qatar')->pluck('id');
        $division = DB::table('divisions')->where('country_id', $country)->get();
        return $division;
        if (count($division) > 0) {
            return $division;
        } else {
            return $division = ['message' => 'No Division Found'];
        }
    }

    public function edit_post_job(Request $data)
    {
        $jobid = $data->job_id;
        $ida = Auth::guard('employer')->user()->id;
        $job = job::find($jobid);
        $job->employer_id = $ida;
        $job->jobtitle = $data->jobtitle;
        $job->job_description = $data->job_description;
        // $job->catagory_id = $data->job_category;
        $job->industrytype_id = $data->job_industry;
        $job->city_id = $data->city;
        $job->area_id = $data->area;
        $job->employment_type = $data->employment_type;
        $job->career_level = $data->career_level;
        $job->vacancies = $data->vacancies;
        $job->salaryrange = $data->salaryrange;
        $job->skills = $data->skills;
        // $job->job_experiences_year1 = $data->job_experiences_year1;
        // $job->job_experiences_year2 = $data->job_experiences_year2;
        $job->deadline = date_format(DateTime::createFromFormat('d/m/Y', $data->deadline), "Y-m-d");
        
        $job->save();

        return redirect('employer/managejobs');

    }
    /*
    +++++++++++++++
    POST JOB
    +++++++++++++++
     */
    public function post_job(Request $data)
    {
        $ida = Auth::guard('employer')->user()->id;
        $job = new job;
        $job->employer_id = $ida;
        $job->jobtitle = $data->jobtitle;
        $job->job_description = $data->job_description;
        // $job->catagory_id = $data->job_category;
        $job->industrytype_id = $data->job_industry;
        $job->city_id = $data->city;
        $job->area_id = $data->area;
        $job->employment_type = $data->employment_type;
        $job->career_level = $data->career_level;
        $job->vacancies = $data->vacancies;
        $job->salaryrange = $data->salaryrange;
        $job->skills = $data->skills;
        // $job->job_experiences_year1 = $data->job_experiences_year1;
        // $job->job_experiences_year2 = $data->job_experiences_year2;
        $job->deadline = date_format(DateTime::createFromFormat('d/m/Y', $data->deadline), "Y-m-d");
        
        $job->save();

        $notif = new enotification();
        $notif->user_id = Auth::guard('employer')->user()->id;
        $notif->job_id = $job->id;
        $notif->message = "New Job Posted";
        $notif->save();
        return response()->json([
            'jobid' => $job->id
        ]);

        //job::create();
    }

    public function post_job_publish(Request $data){
        $jobid = $data->job_id;
        $job = job::find($jobid);
        $job->published = 1;
        $job->save();

        // $notif = new enotification();
        // $notif->user_id = Auth::guard('employer')->user()->id;
        // $notif->job_id = $job->id;
        // $notif->message = "New Job Posted";
        // $notif->save();

        $notif = new notification();
        $notif->job_id = $jobid;
        $notif->sender = 1;
        $notif->message = "New Job Posted";
        $notif->save();

        return redirect('employer/managejobs');
    }

    /*
    +++++++++++++++
    POST JOB QUESTION
    +++++++++++++++
     */
    public function post_job_question(Request $data)
    {
        //return $data;
        $jobid = $data->job_id;
        $job = job::find($jobid);

        if( $data->has("quest_location_req_yes")){
            $job->quest_location = $data->quest_location;
            $job->quest_location_req = 1;
        }
        else{
            $job->quest_location_req = 0;
        }

        if( $data->has("quest_experience_req_yes")){
            $job->quest_exp_min = $data->quest_exp1;
            $job->quest_exp_max = $data->quest_exp2;

            if($job->quest_exp_max < $job->quest_exp_min){
                $temp = $job->quest_exp_max;
                $job->quest_exp_max = $job->quest_exp_min;
                $job->quest_exp_min = $temp;
            }
            $job->quest_exp_req = 1;
        }
        else{
            $job->quest_exp_req = 0;
        }

        if( $data->has("quest_salary_req_yes")){
            $job->quest_salary_min = $data->quest_salary1;
            $job->quest_salary_max = $data->quest_salary2;

            if($job->quest_salary_max < $job->quest_salary_min){
                $temp = $job->quest_salary_max;
                $job->quest_salary_max = $job->quest_salary_min;
                $job->quest_salary_min = $temp;
            }
            $job->quest_salary_req = 1;
        }
        else{
            $job->quest_salary_req = 0;
        }

        if( $data->has("quest_language_req_yes")){
            $job->quest_language = $data->quest_language;
            $job->quest_language_req = 1;
        }
        else{
            $job->quest_language_req = 0;
        }

        if( $data->has("quest_education_req_yes")){
            $job->quest_min_edu = $data->quest_min_edu;
            $job->quest_min_edu_req = 1;
        }
        else{
            $job->quest_min_edu_req = 0;
        }

        if( $data->has("quest_license_req_yes")){
            $job->quest_license = $data->quest_license;
            $job->quest_license_req = 1;
        }
        else{
            $job->quest_license_req = 0;
        }

        if( $data->has("quest_notify_req_yes")){
            $job->quest_notify = 1;
        }
        else{
            $job->quest_notify = 0;
        }
        
        $job->published = 1;

        $job->save();

        // $notif = new enotification();
        // $notif->user_id = Auth::guard('employer')->user()->id;
        // $notif->job_id = $job->id;
        // $notif->message = "New Job Posted";
        // $notif->save();

        $notif = new notification();
        $notif->job_id = $jobid;
        $notif->sender = 1;
        $notif->message = "New Job Posted";
        $notif->save();
        return redirect('employer/managejobs');
    }

    /*
    ##########################
    Show Job on
    Employer
    DashBoard
    ##########################
     */
    public function show_job_on_emp_dashboard()
    {
        $ida = Auth::guard('employer')->user()->id;
        $jobs = DB::table('jobs')->where('employer_id', $ida)->paginate(2);
        $job = $jobs;

        if (count($job)) {
            return view('employer.job', compact('job'));
        } else {
            $job = ['message' => 'no data found'];
            return view('employer.job', compact('job'));
        }

    }

    private function get_industrytype()
    {
        $get_industrytype = DB::table('industrytypes')->get();
        return $get_industrytype;

    }

    /*
    ##########################
    Edit Job on
    Employer
    DashBoard
    ##########################
     */
    public function edit_job_employer_dashboard(Request $data)
    {
        //return $data;
        $jobid = $data->edit_post_id;
        $ida = Auth::guard('employer')->user()->id;
        $jobs = job::where('id', $jobid)->get();
        $job = $jobs[0];
        //return $job;
        $job->employer_id = $ida;
        $job->catagory_id = $data->catagory_id;
        $job->industrytype_id = $data->industrytype_id;
        $job->salaryrange = $data->salaryrange;
        $job->jobtitle = $data->jobtitle;
        $job->vacancies = $data->vacancies;
        $job->instruction = $data->instruction;
        $job->email = $data->email;
        $job->deadline = $data->deadline;
        $job->contactperson = $data->contactperson;
        $job->designation = $data->designation;

        $job->division_id = $data->division;
        $job->district_id = $data->districts;
        $job->agerange = $data->agerange;
        $job->jobtype = $data->jobtype;
        $job->joblevel = $data->joblevel;
        $job->educational_qualification = $data->educational_qualification;
        $job->job_responsibilities = $data->job_responsibilities;
        $job->job_experiences_year = $data->job_experiences_year;
        $job->job_experiences_field = $data->job_experiences_field;
        $job->save();
        session()->flash('status', 'successfully updated');

    }

    public function job_edit(Request $r)
    {
        $ida = Auth::guard('employer')->user()->id;
        $job_id = $r->jobid;
        $connection = new job;
        $job_data = $connection->find($job_id);
        return $job_data;

    }

    /*
    ##########################
    Delete Job on
    Employer
    DashBoard
    ##########################
     */
    public function delte_job_employer_dashboard(Request $data)
    {
        $data->job_id;
        job::destroy($data->job_id);
        return ('Successfully deleted');

    }

    public function update_status(Request $data)
    {
        print_r($data->id);
        $applied = new applied_job();
        $applied->id = $data->id;
        $applied->status = $data->status;
        $applied->save();

        return ('Successfully Updated');

    }

    //show jobdetails on employer dashboard by tariqul

    public function showJobDetails(Request $data)
    {

        $id = $data->job_id;

        $jobdata = DB::table('jobs')->join('empprofiles', 'jobs.employer_id', 'empprofiles.employer_id')
            ->join('catagories', 'jobs.catagory_id', 'catagories.id')
            ->join('industrytypes', 'jobs.industrytype_id', 'industrytypes.id')
            ->select('jobs.*', 'empprofiles.companyname', 'empprofiles.companyaddress', 'catagories.catagoryname', 'industrytypes.industrytypename')
            ->where('jobs.id', $id)
            ->get();

        return $jobdata;

    }

    ///return district on form on change

    public function return_district_by_division_id(Request $Request)
    {
        if (isset($Request->action) && $Request->action == 'ajax') {
            $division = $Request->division_id;
            $districts = DB::table('districts')->where('division_id', $division)->get();
            return response()->json($districts);
        } else {
            return $message = 'You dont have to right to access this page';
        }

    }

    public function changeAccountStatus()
    {
        $db = Employer::find(Auth::guard('employer')->user()->id);
        $db->delete();
        Auth::guard('employer')->logout();

        return redirect('/employer/login');
        //return redirect('/employer/managejobs/0');
    }

    public function deleteNotification($id)
    {
        $notif=notification::find($id);
        $notif->delete();
        return redirect('jobseeker/notifications');
    }
}
