<?php

namespace App\Http\Controllers\Inspector;

use App\Applied_job;
use App\catagory;
use App\CityArea;
use App\Constants\Constants;
use App\contactu;
use App\conversation;
use App\cv;
use App\Education;
use App\Employer;
use App\employmenttype;
use App\Inspector;
use App\job;
use App\Jobseeker;
use App\JobTag;
use App\nationality;
use App\notification;
use App\personaldetails;
use App\Privilege;
use App\SkillSet;
use App\Utils\Utils;
use App\visatype;
use App\Workexperience;
use App\empdate;
use App\jbsdate;
use DateTime;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\country;
use App\division;
use App\district;
use App\area;
use App\empprofile;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use \Validator;
use Carbon\Carbon;
use App\Certificate;
use App\Mail\verifyEmail;




class employerController  extends Controller
{
    public function __construct()
    {
        $this->middleware('inspector');
    }

    /* public function __construct()
     {
         $this->middleware('employer');
     } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country = (country::pluck('name', 'id'));
        $division = (division::pluck('name', 'id'));
        $district = (district::pluck('name', 'id'));
        $area = (area::pluck('name', 'id'));

        return view('employer.resume');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ida = Auth::guard('employer')->user()->id;

        // country::find(1)->division;
        // division::find(1)->district;
        // district::find(1)->area;

        $data = empprofile::where('employer_id', $ida)->get();
        //return dump($data[0]->country);
        if ($data[0]->division && $data[0]->country && $data[0]->district) {
            $empdeses = empprofile::join('countries', 'empprofiles.country', 'countries.id')->join('divisions', 'empprofiles.division', 'divisions.id')->join('areas', 'empprofiles.area', 'areas.id')->join('districts', 'empprofiles.district', 'districts.id')->select('empprofiles.*', 'countries.name As cname', 'divisions.name As dname', 'districts.name As disname', 'areas.name As aname')->where('empprofiles.employer_id', $ida)->get();
        } elseif ($data[0]->division && $data[0]->country) {
            $empdeses = empprofile::join('countries', 'empprofiles.country', 'countries.id')->join('divisions', 'empprofiles.division', 'divisions.id')->select('empprofiles.*', 'countries.name As cname', 'divisions.name As dname', 'districts.name As disname')->where('empprofiles.employer_id', $ida)->get();
        } elseif ($data[0]->country) {
            $empdeses = empprofile::join('countries', 'empprofiles.country', 'countries.id')->select('empprofiles.*', 'countries.name As cname')->where('empprofiles.employer_id', $ida)->get();
        } else {
            if (empprofile::where('employer_id', $ida)->get()) {
                $empdeses = empprofile::where('employer_id', $ida)->get();
            } else {
                return 'abc';
            };
        }


        //$data=empprofile::join('countries','empprofiles.country','countries.id')->join('divisions','empprofiles.division','divisions.id')->join('districts','empprofiles.district','districts.id')->join('areas','empprofiles.area','areas.id')->select('empprofiles.*','countries.name As cname','divisions.name As dname','districts.name As disname','areas.name As aname')->where('empprofiles.employer_id',$ida)->get();
        //return $empdes = $id;
        $empdes = $empdeses[0];
        isset($empdes->industrytype) ? $industrytype = explode(',', $empdes->industrytype) : NULL;
        $country = (country::pluck('name', 'id'));
        $division = (division::pluck('name', 'id'));
        $district = (district::pluck('name', 'id'));
        $area = (area::pluck('name', 'id'));
        //return $empdes;

        return view('employer.resume', compact('empdes', 'country', 'division', 'district', 'area', 'industrytype'));
        //return $empdes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {


        if ($request->ajax()) {
            $frff = empprofile::where('employer_id', $id)->get();
            $empprofile = $frff[0];
            //$empprofile = empprofile::find($id);
            //return $empprofile[0];


            switch ($request->action) {
                case 'companyinfo':
                    $empprofile->companyname = $request->companyname;
                    $empprofile->altcompanyname = $request->altcompanyname;
                    $empprofile->contactperson = $request->contactperson;
                    $empprofile->designation = $request->designation;
                    $empprofile->save();
                    break;

                case 'industrytype':
                    $empprofile->industrytype = implode(',', $request->industrytype);
                    //return $industrytype;
                    $empprofile->save();

                    break;

                case 'primaryaddress':
                    $empprofile->companyaddress = $request->Companyaddress;
                    $empprofile->country = $request->country;
                    $empprofile->division = $request->division;
                    $empprofile->district = $request->district;
                    $empprofile->area = $request->area;
                    $empprofile->billingaddress = $request->BillingAddress;
                    $empprofile->ContactPhone = $request->ContactPhone;
                    $empprofile->ContactEmail = $request->ContactEmail;
                    $empprofile->websiteaddress = $request->WebsiteAddress;
                    //$empprofile->companyaddress=$request->WebsiteAddress;
                    //return $request->action;
                    $empprofile->save();
                    break;

                default:
                    return "Woofs";
                    break;
            }

        }

        $empprofile->companyname = $request->companyname;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateorcreate(request $r, $id)
    {
        //empprofile::updateOrCreate(['id'=>2,'employer_id'=>$id,'companyname'=>'emon']);
        return "success";
    }


    //Bradlys changes
    public function employerDetails($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $myprofile = empprofile::where('employer_id', $id)->get();
        $myprofile = $myprofile[0];

        $cityareas = DB::table('city_areas')->get();
        $mainemp = Employer::find($id);
        $emp = empprofile::find($id);

        $city = DB::table('city_areas')->where('id', $myprofile->city)->get();
        $area = DB::table('areas')->where('id', $myprofile->city)->get();
        //$city =$city[0];
        //$city =$city->name;
        if ($emp->websiteaddress != "") {
            $strs = explode("//", $emp->websiteaddress);
            $emp->proto = $strs[0];
            $emp->websiteaddress = $strs[1];
        }
        if ($emp->fb != "") {
            $strs = explode("//", $emp->fb);
            $emp->protofb = $strs[0];
            $emp->fb = $strs[1];
        }
        if ($emp->twitter != "") {
            $strs = explode("//", $emp->twitter);
            $emp->prototwitter = $strs[0];
            $emp->twitter = $strs[1];
        }
        if ($emp->linkedin != "") {
            $strs = explode("//", $emp->linkedin);
            $emp->protolinkedin = $strs[0];
            $emp->linkedin = $strs[1];
        }
        $jobcount= job::where('employer_id', $id)->count();
        $activejobcount= job::where('employer_id', $id)->where('status',2)->count();
        //var_dump($emp);
        $ind = DB::table('industrytypes')->where('id','=' , $emp->industrytype)->get()->first()->industrytypename;
        $area1 = DB::table('city_areas')->where('id','=', $emp->area)->get();
        //var_dump($area1);
        if (!is_null($area1->first()))
        {
            $area1=$area1->first()->name;
        }else{
            $area1="";
        }
        //var_dump($area1);
        return view('dashboard.employer_details', compact('myprofile', 'emp', 'cityareas','mainemp' ,'ind', 'city', 'area','area1' ,'jobcount','activejobcount'));
    }

    public function changeEmpdetails($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $country = DB::table('country')->get();
        // $division=DB::table('divisions')->get();
        $cityareas = DB::table('city_areas')->get();
        $myprofile = empprofile::where('employer_id', $id)->get();
        $myprofile = $myprofile[0];
        //

        $clss = 3;
        $pageno = 5;

        $nowFormat = date('Y-m-d');
        $ida = $id;
        $alljobs = DB::table('jobs')->where('employer_id', $ida)->count();
        $active = DB::table('jobs')->where('employer_id', $ida)->where('deadline', '>', $nowFormat)->where('delete_status', 0)->count();

        $emp = empprofile::find($id);
        if ($emp->websiteaddress != "") {
            $strs = explode("//", $emp->websiteaddress);
            $emp->proto = $strs[0];
            $emp->websiteaddress = $strs[1];
        }
        if ($emp->fb != "") {
            $strs = explode("//", $emp->fb);
            $emp->protofb = $strs[0];
            $emp->fb = $strs[1];
        }
        if ($emp->twitter != "") {
            $strs = explode("//", $emp->twitter);
            $emp->prototwitter = $strs[0];
            $emp->twitter = $strs[1];
        }
        if ($emp->linkedin != "") {
            $strs = explode("//", $emp->linkedin);
            $emp->protolinkedin = $strs[0];
            $emp->linkedin = $strs[1];
        }
        $industries = DB::table('industrytypes')->get();

        return view('dashboard.edit_emp_profile', compact('clss', 'alljobs', 'active', 'myprofile', 'emp', 'country', 'cityareas', 'industries', 'pageno'));


    }
    public function saveDetails(Request $data)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $employerid = $data->id;
        $settings=empprofile::find($employerid);
        $settings->companyname=$data->companyname;
        $proto = "http:";
        if($data->websiteaddress){
            if($data->proto){
                $proto = $data->proto;
            }
            $settings->websiteaddress=$proto."//".$data->websiteaddress;
        }
        $settings->city=$data->location;
        $settings->area=$data->area;
        $settings->industrytype=$data->industry;
        $settings->employertype=$data->employertype;
        $settings->fname=$data->fname;
        $settings->lname=$data->lname;
        $settings->position=$data->position;
        $settings->ContactPhone=$data->ContactPhone1;
        $proto = "http:";
        if($data->fb){
            if($data->protofb){
                $proto = $data->protofb;
            }
            $settings->fb=$proto."//".$data->fb;
        }
        $proto = "http:";
        if($data->twitter){
            if($data->prototwitter){
                $proto = $data->prototwitter;
            }
            $settings->twitter=$proto."//".$data->twitter;
        }
        $proto = "http:";
        if($data->linkedin){
            if($data->protolinkedin){
                $proto = $data->protolinkedin;
            }
            $settings->linkedin=$proto."//".$data->linkedin;
        }

        $settings->save();
        return redirect('/inspector/employerdetail/'.$data->id);
    }

    public function changeEmail(Request $data)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }

       $id = $data->id;

        $validator = Validator::make($data->all(), [
            'email' => 'required|email|max:255|unique:employers',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator, 'email');
        }

        $employer = Employer::find($id);
        $employer->email = $data->email;
        $employer->verifyToken = uniqid();
        $employer->save();

        Mail::to($employer->email)->send(new verifyEmail($employer));
        return redirect(url('/inspector/editempsettings/'.$data->id));

    }
    public function deleteAccount($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        if (!empty($id))
        {
            $db = Employer::find($id);
            $db->delete();
            $db1 = empprofile::find($id);
            $db1->delete();
        }
    }
    private function count_apply_particular_job($job_id)
    {
        $applied_on_job = DB::table('applied_jobs')->where('job_id', $job_id)->get();
        return count($applied_on_job);
    }

    public function getJobposts($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $myprofile = empprofile::where('employer_id', $id)->get();
        $myprofile = $myprofile[0];
        $emp = $myprofile[0];

        $pageno=1;

        $jobs = job::where('employer_id', $id)->pluck('id');

        $notif = notification::whereIn('job_id', $jobs)->where('sender', 0)->orderBy('created_at', 'desc')->take(2)->get();

        $ida = $id;

        $nowFormat = date('Y-m-d');
        //all active jobs
        $active = job::where([['employer_id', $ida], ['published',1]])->where('deadline', '>=', $nowFormat)->where('status', 0)->count();
        $activejob = job::where([['employer_id', $ida], ['published',1]])->where('deadline', '>=', $nowFormat)->where('status', 0)->paginate(10);
        //paused jobs
        $paused = job::where([['employer_id', $ida], ['published',1]])->where('deadline', '>=', $nowFormat)->where('status', 1)->count();
        $pausedjob = job::where([['employer_id', $ida], ['published',1]])->where('deadline', '>=', $nowFormat)->where('status', 1)->paginate(10);
        //closed
        $closedjob = job::where([['employer_id', $ida], ['published',1]])->where('status', 2)->orWhere('deadline', '<', $nowFormat)->paginate(10);
        $allclosedjob = job::where([['employer_id', $ida], ['published',1]])->where('status', 2)->orWhere('deadline', '<', $nowFormat)->get();
        $closed = $allclosedjob->count();
        foreach($allclosedjob as $j){
            $j->status = 2;
            $j->save();
        }

        $alljobs = DB::table('jobs')->where('employer_id', $ida)->count();
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

        return view('dashboard.joblist', compact('alljobs', 'myprofile', 'notif', 'applied2', 'activejob', 'pausedjob', 'closedjob','emp', 'active', 'paused', 'closed', 'pageno'));
    }

    public function getjobdetail()
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        echo "get  job detail";

    }
    public function activestatus($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $db = job::find($id);
        $db->status = 0;
        $empid = $db->employer_id;
        $db->save();
        return redirect(url('/inspector/jobposts/' . $empid));
    }

    public function pausestatus($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $db = job::find($id);
        $db->status = 1;
        $empid = $db->employer_id;
        $db->save();
        return redirect(url('/inspector/jobposts/' . $empid));
    }
    public function editajob($jobid)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $job = job::find($jobid);
        //$myprofile = empprofile::where('employer_id', Auth::guard('employer')->user()->id)->get();
        //$myprofile = $myprofile[0];
        $category = DB::table('catagories')->select('catagoryname', 'id')->get();
        $industry = DB::table('industrytypes')->select('industrytypename', 'id')->get();
        $countries = DB::table('country')->select('name', 'id')->get();

        $job->deadline = date_format(DateTime::createFromFormat('Y-m-d', $job->deadline), "d/m/Y");

        $division = DB::table('divisions')->get();
        $cityareas=DB::table('city_areas')->get();

        $pageno = 1;
        $nowFormat = date('Y-m-d');
        $ida =$job->employer_id;
        $alljobs = DB::table('jobs')->where('employer_id', $ida)->count();
        $active = job::where('employer_id', $ida)->where('deadline', '>', $nowFormat)->where('status', 0)->count();
        $jtags = JobTag::all();

        return view('dashboard.edit_a_job', compact('alljobs', 'active', 'category', 'industry', 'division', 'myprofile', 'countries', 'cityareas', 'jtags', 'job', 'pageno'));
    }

    public function posteditajob(Request $data)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $jobid = $data->job_id;
        $job = job::find($jobid);
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

        return redirect('inspector/editajob/'.$data->job_id);
    }
    public function  closestatus($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $db = job::find($id);
        $empid =$db->employer_id;
        $db->status = 2;
        $db->save();
        return redirect(url('/inspector/jobposts/'.$empid));
    }
    public function jobdetails($empid,$id,$jsid)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        if($jsid == 0) {
            $firstcand = DB::table('applied_jobs')->where("job_id", $id)->get()[0];
            $jsid = $firstcand->jobseeker_id;
        }
        $myprofile = empprofile::where('employer_id', $empid)->get();
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
        $ida = $empid;
        $alljobs = DB::table('jobs')->where('employer_id', $ida)->count();
        $active = DB::table('jobs')->where('employer_id', $ida)->where('deadline', '>', $nowFormat)->where('delete_status', 0)->count();
        $enumDegrees = Constants::$enumDegrees;
        $countryt=DB::table('country')->get();
        $country = [];
        foreach( $countryt as $cnt ){
            $country[$cnt->code] = $cnt->name;
        }

        $pageno = 1;
        return view('dashboard.insjobdetails', compact('alljobs', 'active', 'myprofile', 'job', 'id', 'applicants', 'jobprofile', 'enumDegrees', 'country', 'ajid', 'pageno'));
    }

    private function count_by_status1($emp_id, $status)
    {
        $applied_on_job = DB::table('applied_jobs')->where('employer_id', $emp_id)->where('status', $status)->get();
        if($status == 0) {
            $applied_on_job = DB::table('applied_jobs')->where('employer_id', $emp_id)->get();
        }
        return count($applied_on_job);
    }
    private function countCategoryWiseJob($allapplied) {
        $categorys=Utils::categories();

        $array=array();

        foreach ($categorys as $cat) {
            $array[$cat->id]=$this->countCatJob($allapplied, $cat->id);
        }

        return $array;

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

    //count jobs by divisionwise
    private function count_cands_by_location($allapplied) {
        $counts=[];

        foreach(CityArea::all() as $c) {
            $counts[$c->id]=$this->get_num_of_rows_by_location_job($allapplied, $c->id);
        }

        return $counts;
    }

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
    private function get_industrytype()
    {
        $get_industrytype = DB::table('industrytypes')->get();
        return $get_industrytype;

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
    public function jobtypecount($allapplied) {
        $etypes = employmenttype::all();

        $e_jobs = [];
        foreach($etypes as $et){
            $e_jobs[$et->id]=$allapplied->where('personaldetails.target_employment_type', $et->name)->count();
        }
        return $e_jobs;

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
    public function nationalitycount($allapplied) {
        $nationality = nationality::all();

        $e_jobs = [];
        foreach($nationality as $n){
            $e_jobs[$n->id]=$allapplied->where('personaldetails.jobseeker_nationality', $n->name)->count();
        }
        return $e_jobs;
    }

    private function particular_count_industrytype($allapplied) {
        $array=[];

        foreach(Utils::get_industrytype() as $i) {
            $array[$i->id]=$this->count_industrytypesjob($allapplied, $i->industrytypename);
        }

        return $array;

    }

    public function getAllcandidate($id ,$status)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        //    echo $status;
        $pageno = 2;
        $myprofile = empprofile::where('employer_id', $id)->get();
        $myprofile = $myprofile[0];
        if($status == 0){
            $applicants = Applied_job::join('personaldetails', 'personaldetails.jobseeker_id', '=', 'applied_jobs.jobseeker_id')
                ->join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')
                ->select('jobs.jobtitle', 'jobs.job_responsibilities', 'applied_jobs.id as aj', 'applied_jobs.*', 'personaldetails.*', 'personaldetails.id as pi')
                ->where('applied_jobs.employer_id', $id)
                ->paginate(10);
        }
        else{
            $applicants = Applied_job::join('personaldetails', 'personaldetails.jobseeker_id', '=', 'applied_jobs.jobseeker_id')
                ->join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')
                ->select('jobs.jobtitle', 'jobs.job_responsibilities', 'applied_jobs.id as aj', 'applied_jobs.*', 'personaldetails.*', 'personaldetails.id as pi')
                ->where('applied_jobs.employer_id', $id)
                ->where('applied_jobs.status', $status)
                ->paginate(10);
        }

        $clss = 1;

        $jobs = job::where('employer_id', $id)->pluck('id');

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
        $ida = $id;
        $alljobs = DB::table('jobs')->where('employer_id', $ida)->count();
        $active = DB::table('jobs')->where('employer_id', $ida)->where('deadline', '>', $nowFormat)->where('delete_status', 0)->count();

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

        return view('dashboard.getAllCandidates', compact('clss', 'active', 'alljobs', 'notif', 'id', 'myprofile', 'applicants', 'all', 'shortlisted', 'rejected', 'scheduled', 'spam', 'status', 'category', 'city_areas', 'count_by_div', 'countCategoryWiseJob', 'categorysForCountJob', 'get_ind', 'pic', 'etypes', 'visatypecount', 'jobtypecount', 'vtypes', 'noccount', 'gendercount', 'nationalities', 'nation_count', 'pageno'));
    }

    public function changeCandidatestatus($id, $status, Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $db = Applied_job::find($id);
        $db->status = $status;

        $notif = new notification();
        $notif->job_id = $db->job_id;
        $notif->jobseeker_id = $db->jobseeker_id;
        $notif->sender = 1;

        if ($status == 1) {
            $notif->message = "You have been shortlisted.";
        }
        elseif ($status == 2) {
            $notif->message = "You have been rejected.";
        }
        elseif ($status == 3) {
            $db->scheduled_time = $request->time;
            $notif->message = "An Interview has been scheduled on ".Utils::cdateformat3($request->time);
        }
        elseif ($status == 4) {
            $db->scheduled_time = $request->time;
            $notif->message = "You have been marked as a spam.";
        }
        $notif->save();

        $db->save();
        return redirect('/inspector/employerlist');
    }

    public function getempMessage ($empid,$convid=0)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $myprofile=empprofile::where('employer_id', $empid)->get();
        $myprofile=$myprofile[0];
        $conv=conversation::where('employer', $empid)->paginate(10);
        $curconv=$conv[0];
        $pageno=3;
        if($convid>0){
            $curconv = conversation::find($convid);
        }
        if($curconv != null){
            foreach($curconv->messages as $msg){
                $msg->isread = 1;
                $msg->save();
            }
        }

        $unreadcnt = [];
        foreach($conv as $c){
            $cnt = 0;
            foreach($c->messages as $msg){
                if($msg->sender==0 && $msg->isread == 0){
                    $cnt++;
                }
            }
            if($cnt>0){
                $unreadcnt[$c->id] = $cnt;
            }
        }

        $clss=2;
        $nowFormat=date('Y-m-d');
        $ida=$empid;
        $alljobs=DB::table('jobs')->where('employer_id', $ida)->count();
        $active=DB::table('jobs')->where('employer_id', $ida)->where('deadline', '>', $nowFormat)->where('delete_status', 0)->count();

        return view('dashboard.messages', compact('clss', 'alljobs', 'active', 'conv', 'myprofile', 'curconv', 'unreadcnt', 'pageno','empid'));

    }

    public function postResetpassword(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $employer = Employer::find($request->id);

            $employer->password = Hash::make($request->password);//Encrypt the password
            $employer->save();
            $request->password = $jobseeker->password;
            return redirect('/inspector/editempsettings/'.$id);

    }

    public function getProfile($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $jobprofile=personaldetails::where('jobseeker_id',$id)->get()[0];

        $applied=DB::table('applied_jobs')->where('jobseeker_id',$id)->get();
        $applied=count($applied);

        $accepted = DB::table('applied_jobs')->where('jobseeker_id', $id)->where('status', 1)->get();
        $accepted = count($accepted);

        $myprofile=Jobseeker::find($id);
        $total=Applied_job::where("jobseeker_id","=",$id)->count();

        $pageno=2;

        return view('dashboard.jbs-settings',compact('total','applied','jobprofile','id','myprofile','pageno', 'accepted'));
    }

    public function getresume($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $jobprofile=personaldetails::where('jobseeker_id',$id)->get()[0];

        if($jobprofile == null || $jobprofile->completed != 1) {
            return view('jobseeker.requireprofile');
        }

        $countryt=DB::table('country')->get();
        $country = [];
        foreach( $countryt as $cnt ){
            $country[$cnt->code] = $cnt->name;
        }

        $applied=DB::table('applied_jobs')->where('jobseeker_id',$id)->get();
        $applied=count($applied);

        $accepted = DB::table('applied_jobs')->where('jobseeker_id', $id)->where('status', 1)->get();
        $accepted = count($accepted);

        $notifications = notification::where('jobseeker_id', $id)->where('sender', 1)->orderBy('created_at', 'desc')->take(2)->get();

        $jobprofile->jobseeker_dob = date_format(DateTime::createFromFormat('d/m/Y', $jobprofile->jobseeker_dob), "j F Y");

        $tagstr = [];
        foreach(explode(",", $jobprofile->target_tags) as $ti){
            if($ti == "") continue;
            array_push($tagstr, JobTag::find($ti)->job_tag);
        }
        $jobprofile->target_job_titles = implode(", ", $tagstr);

        $tagstr = [];
        foreach(explode(",", $jobprofile->target_location) as $ti){
            if($ti == "") continue;
            array_push($tagstr, CityArea::find($ti)->name);
        }
        $jobprofile->target_locations = implode(", ", $tagstr);

        // $jobprofile->cv=json_decode($jobprofile->cv);
        // $edu=Education1::find(Auth::guard('jobseeker')->user()->id);
        // $edu->details=json_decode($edu->details);

        // $edu->degree=json_decode($edu->degree);

        // $exp=Workexperience1::find(Auth::guard('jobseeker')->user()->id);
        // $exp->experience=json_decode($exp->experience);
        $total=Applied_job::where("jobseeker_id","=",$id)->count();

        $enumDegrees = Constants::$enumDegrees;
        $jbsmain = Jobseeker::find($id);

        $pageno = 2;
        return view('dashboard.resume',compact('total','id','applied','jobprofile','jbsmain','enumDegrees','country', 'pageno', 'accepted'));
    }
    public function removeimage($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $jobprofile=personaldetails::where('jobseeker_id',$id)->get();
        $jobprofile= $jobprofile[0];
        Storage::disk('public')->delete(str_replace("storage/", "", $jobprofile->profile_img));
        $jobprofile->profile_img = null;
        $jobprofile->save();
        return redirect(url('/inspector/jbs/getProfile/'.$id));

    }

    public function changjbseemail(Request $data)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
;

        $validator = Validator::make($data->all(), [
            'email' => 'required|email|max:255|unique:jobseekers',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator, 'email');
        }

        $jobseeker = Jobseeker::find($data->id);

        $jobseeker->verifyToken = uniqid();
        $jobseeker->save();

        Mail::to($jobseeker->email)->send(new verifyEmail($jobseeker));
        //return redirect('/jobseeker/sentverifymail');
        return redirect(url('/inspector/jbs/getProfile/'.$data->id));
    }
    public function changeimage(Request $data)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $jobprofile=personaldetails::where('jobseeker_id',$data->id)->get();
        $jobprofile=personaldetails::find($jobprofile[0]->id);

        Storage::disk('public')->delete(str_replace("storage/", "", $jobprofile->profile_img));

        if($data->hasFile('avatar')){
            $path = $data->file('avatar')->store('/public/profile');
            $path=str_replace("public","storage",$path);
            $jobprofile->profile_img=$path;
        }
        else{
            $jobprofile->profile_img = null;
        }

        $jobprofile->save();

        /*$seg = explode('/', url()->previous());
        $prev_url = end($seg);

        if($prev_url == 'editprofile'){
            return redirect('/jobseeker/editprofile');
        }else{
            return redirect('/jobseeker/getProfile');
        }*/

        return redirect(url('/inspector/jbs/getProfile/'.$data->id));
    }

    public function deletejbsaccount($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        if (!empty($id))
        {
            var_dump($id);
            $jobprofile=personaldetails::where('jobseeker_id',$id)->get();
            $jobprofile1=Jobseeker::where('id',$id)->get();
            $db= $jobprofile[0];
            $db1= $jobprofile1[0];
            $db->delete();
            $db1->delete();
            return redirect(url('/inspector/'));

        }
    }

    public function postjbsresetpassword(Request $data)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $password = $data->password;
        $password_conf = $data->password_confirmation;
        $id = $data->id;
        $jobseeker =Jobseeker::find($id);

        $validator = Validator::make($data->all(), [
            'password' => 'required|confirmed|min:6',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator, 'password');
        }

            // Success
            $jobseeker->password = Hash::make($data->password);//Encrypt the password
            $jobseeker->save();
            $data->password = $jobseeker->password;
            return redirect(url('/inspector/jbs/getProfile/'.$id));

    }
    private function get_division()
    {
        $country = DB::table('countries')->where('name','Qatar')->pluck('id');
        $division = DB::table('divisions')->where('country_id',$country)->get();
        return $division;
        if(count($division)>0){
            return $division;
        }else
        {
            return $division = ['message'=>'No Division Found'];
        }
    }

    public static function get_cityareas(){
        $cities = \App\CityArea::where('parent_id', 0)->get();

        $city_areas = array();

        foreach($cities as $city){
            $areas = CityArea::where('parent_id', $city->id)->get();
            array_push($city_areas, ["id" => $city->id, "name" => $city->name, "areas" => $areas->toArray()]);
        }

        return $city_areas;
    }

    public function editresume($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $nationality=DB::table('nationality')->get();
        $country=DB::table('country')->get();

        // $country = Constants::$GEOIPCOUNTRY;
        $visas = Constants::$VISAS;
        $get_ind=$this->get_industrytype();
        // $edu->details=json_decode($edu->details);
        //echo"<pre>";
        // $exp->experience=json_decode($exp->experience);
        $division = $this->get_division();

        $city_areas = $this->get_cityareas();

        $jobs=Jobseeker::join('personaldetails','jobseekers.id','personaldetails.jobseeker_id')
            ->where('jobseekers.id',$id)->get();

        $edu=Education::where("person_id", $id)->get();

        $exp=Workexperience::where("person_id", $id)->get();

        $skills=SkillSet::where("person_id", $id)->get();

        $jtags = JobTag::all();


        $nedu = new Education();
        $nedu->id = 0;

        $nexp = new Workexperience();
        $nexp->id = 0;

        $nskill = new SkillSet();
        $nskill->id = 0;

        $cvs = cv::where("person_id", $id)->get();

        $jbsmain = Jobseeker::find($id);
        $jbid= $id;
        return view('dashboard.myresume',compact('nedu','nexp','jbsmain','jbid','id', 'nskill','country','nationality','jobs','get_ind','division','exp','edu','visas','skills','cvs','jtags','city_areas'));
    }


    public function updateprofilebasic(Request $data)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
       // var_dump($data->id);
        //var_dump(personaldetails::where('jobseeker_id',$data->id)->get());
        $jobprofile=personaldetails::where('jobseeker_id',$data->id)->get()[0];

        // $jobprofile=personaldetails::find($jobprofile[0]->id);

        $jobprofile->first_name=$data->first_name;
        $jobprofile->last_name=$data->last_name;

        if( $data->has('jobseeker_gender_male')) {
            $jobprofile->jobseeker_gender = "male";
        }
        else{
            $jobprofile->jobseeker_gender = "female";
        }

        if( $data->has('jobseeker_maritalstatus_single')) {
            $jobprofile->jobseeker_maritalstatus = "single";
        }
        else{
            $jobprofile->jobseeker_maritalstatus = "married";
        }

        if( $data->has('NOC_avaiable')) {
            $jobprofile->NOC = 1;
        }
        else{
            $jobprofile->NOC = 0;
        }

        Validator::make($data->all(), [
            'Driving_Licence' => "required_if:driving,==,on",
            'jobseeker_gender_male' => "required_if:jobseeker_gender_female,==,off",
            'jobseeker_maritalstatus_single' => "required_if:jobseeker_maritalstatus_married,==,off",
            'NOC_avaiable' => "required_if:NOC_navaiable,==,off"
        ])->validate();

        $jobprofile->jobseeker_nationality=$data->jobseeker_nationality;
        $jobprofile->jobseeker_current_location=$data->jobseeker_current_location;
        $jobprofile->jobseeker_dob=$data->jobseeker_dob;
        $jobprofile->VISA_status=$data->VISA_status;
        $jobprofile->Driving_Licence=$data->Driving_Licence;
        $jobprofile->Languages=$data->Languages;
        $jobprofile->jobseeker_email=$data->jobseeker_email;
        $jobprofile->jobseeker_phone1=$data->jobseeker_phone;
        // $jobprofile->jobseeker_phone1=$data->jobseeker_phone1;

        $jobprofile->save();
        return redirect(url('/inspector/jbs/editresume/'.$data->id));
    }


    public function updateTargetJob(Request $data)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $jobprofile=personaldetails::where('jobseeker_id',$data->id)->get()[0];

        $jobprofile->target_tags=$data->target_jobs;
        $jobprofile->target_title=$data->target_title;
        $jobprofile->target_location=$data->target_locations;
        $jobprofile->target_salary=$data->target_salary;
        $jobprofile->target_industry=$data->target_industry;
        $jobprofile->target_career_level=$data->target_career_level;
        $jobprofile->target_notice_period=$data->target_notice_period;
        $jobprofile->target_objective=$data->target_objective;
        $jobprofile->target_employment_type=$data->target_employment_type;

        $jobprofile->save();
        return redirect(url('/inspector/jbs/editresume/'.$data->id.'#personal_target_job'));
    }

    public function getjbsjobs($jbsid ,$id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }

        $comp = '=';
        if (!$id) {
            $id = 0;
        }
        if($id==0){
            $comp='>=';
        }
        $jobprofile = personaldetails::where('jobseeker_id',$jbsid )->get();

        $applied = DB::table('applied_jobs')->where('jobseeker_id',$jbsid )->get();
        $applied = count($applied);

        $accepted = DB::table('applied_jobs')->where('jobseeker_id', $jbsid)->where('status', 1)->get();
        $accepted = count($accepted);

        $scheduled = DB::table('applied_jobs')->where('jobseeker_id', $jbsid)->where('status', 3)->get();
        $scheduled = count($scheduled);

        $notifications = notification::where('jobseeker_id', $jbsid)->where('sender', 1)->orderBy('created_at', 'desc')->take(2)->get();

        $catagories = catagory::all();
        $jobseeker_id = $jbsid;
        $job = Applied_job::join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')
            ->join('empprofiles', 'empprofiles.employer_id', '=', 'applied_jobs.employer_id')
            ->select('applied_jobs.*', 'jobs.jobtitle', 'jobs.job_responsibilities', 'jobs.job_experiences_field', 'empprofiles.companyname', 'empprofiles.companylogo')
            ->where('applied_jobs.jobseeker_id', $jobseeker_id)->where('applied_jobs.status', $comp, $id)->paginate(10);
        $total = Applied_job::where("jobseeker_id", "=", $jbsid)->count();
        $pageno = 1;
        //print_r($job);
        if (count($job)) {
            //  echo $jobseeker_id."<br>";


            return view('dashboard.jbs_job', compact('total', 'job','jbsid', 'notifications', 'applied', 'jobprofile', 'catagories', 'pageno', 'id', 'accepted', 'scheduled'));
        } else {
            $message = 'no data found';
            return view('dashboard.jbs_job', compact('total', 'message','jbsid', 'notifications', 'applied', 'jobprofile', 'catagories', 'pageno', 'id', 'accepted', 'scheduled'));
        }

    }

    public function getjbsMessage($id,$convid=0)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $jobprofile=personaldetails::where('jobseeker_id', $id)->get();
        if (count($jobprofile)>0)
        {
            $jobprofile = $jobprofile[0];
        }

        $applied=DB::table('applied_jobs')->where('jobseeker_id', $id)->get();
        $applied=count($applied);

        $accepted = DB::table('applied_jobs')->where('jobseeker_id', $id)->where('status', 1)->get();
        $accepted = count($accepted);

        $conv=conversation::where('jobseeker', $id)->paginate(10);
        $curconv=$conv[0];
        if($convid>0){
            $curconv = conversation::find($convid);
        }

        if($curconv != null){
            foreach($curconv->messages as $msg){
                $msg->isread = 1;
                $msg->save();
            }
        }

        $unreadcnt = [];
        foreach($conv as $c){
            $cnt = 0;
            foreach($c->messages as $msg){
                if($msg->sender==1 && $msg->isread == 0){
                    $cnt++;
                }
            }
            if($cnt>0){
                $unreadcnt[$c->id] = $cnt;
            }
        }

        $total=Applied_job::where("jobseeker_id", "=", $id)->count();

        $pageno=3;
        return view('dashboard.jbsmessage', compact('total','id', 'applied', 'jobprofile', 'conv', 'pageno', 'accepted', 'curconv', 'unreadcnt'));
    }

    public function jobseekerlist()
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $data=personaldetails::leftJoin("jobseekers","jobseekers.id","=","personaldetails.id")->paginate(20);

        foreach ($data as $e)
        {
            $e->created_at = Jobseeker::find($e->jobseeker_id)->created_at;
            //$datetime = DateTime::createFromFormat('d-m-Y', $e->jobseeker_dob);
            $datetime = str_replace('/', '-', $e->jobseeker_dob);
            //var_dump($datetime);
            $e->age=Carbon::parse($datetime)->age;
        }

        return view('dashboard.jobseekerlist',compact('data'));
    }

    public function getNotifications()
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==1)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $employers=empprofile::leftJoin("employers","employers.id","=","empprofiles.id")->where("status",3)->paginate(5);
        $jobseeker=personaldetails::leftJoin("jobseekers","jobseekers.id","=","personaldetails.jobseeker_id")->where("status",0)->paginate(5);
        return view("dashboard.notifications",compact("employers","jobseeker"));
    }


    public function getEmpnotification($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==1)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $emp=empprofile::find($id);
        return view("dashboard.empnotification",compact("emp"));

    }

    public function getapproveemp($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==1)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $emp = Employer::find($id);
        $emp->status = 1;
        $emp->verifyToken = Str::random(40);
        $emp->save();
        $email=$emp->email;
        $m=Mail::send('public.welcomeemployerfinal', ['name'=>$emp->name, 'email'=>$emp->email, 'verifyToken'=>$emp->verifyToken], function($message) use ($email)
        {
            $message->to($email)->from("worldtalentjobs@gmail.com")->subject('Welcome To World Talent Jobs');
        });
        return redirect(url('/inspector/notifications'));
    }
    public function getrejectemp($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==1)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $emp=Employer::find($id);
        $emp->delete();
        $empp = empprofile::find($id);
        $empp->delete();
        return redirect(url('/inspector/notifications'));
    }
    public  function getcontactform()
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==2)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $contacts = contactu::paginate(5);
        return view('dashboard.contactform',compact('contacts'));

    }

    public function getdeletecontactform($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==2)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $contactform =contactu::find($id);
        $contactform->delete();
        return redirect(url('/inspector/contactform'));
    }

    public function getsettings()
    {
        $user = Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $inspectors = Inspector::paginate(5);
        return view('dashboard.adminsettings',compact('inspectors'));
    }
    public function getaddadmin()
    {
        $user = Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        return view('dashboard.addadmin',compact('inspectors'));
    }

    public function postaddadmin(Request $data)
    {
        $user = Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }

        $validator = Validator::make($data->all(), [
            'email' => 'required|email|max:255|unique:inspectors',
            'password' => 'required|min:6',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator, 'pass');
        }

        $ins = new Inspector();
        $ins->name = $data->name;
        $ins->email = $data->email;
        $ins->password = Hash::make($data->password);
        if (!empty($data->userrole)){
            $ins->user_role=$data->userrole;
        }
        $ins->save();
        if ($data->approve=="on")
        {
            $ins->Privilege()->attach(1);
        }
        if ($data->contactform=="on")
        {
            $ins->Privilege()->attach(2);
        }
        if ($data->billing=="on")
        {
            $ins->Privilege()->attach(3);
        }
        if ($data->readonly=="on")
        {
            $ins->Privilege()->attach(4);
        }
        if ($data->all=="on")
        {
            $ins->Privilege()->attach(5);
        }

        return redirect(url('/inspector/settings'));

    }

    public function geteditadmin($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $ins = Inspector::find($id);

        return view('dashboard.editadmin',compact('ins'));
    }
    public function posteditadmin(Request $data)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $ins = Inspector::find($data->id);
        for ($i = 0; $i <= 10; $i++) {
            {

                $ec = $ins->Privilege()->find($i);
                if (is_null($ec)) {

                } else {
                    $ins->Privilege()->detach($i);
                }
            }
            //$pri =$pri[0];
        }

        if ($data->approve=="on")
        {
            $ins->Privilege()->attach(1);
        }
        if ($data->contactform=="on")
        {
            $ins->Privilege()->attach(2);
        }
        if ($data->billing=="on")
        {
            $ins->Privilege()->attach(3);
        }
        if ($data->readonly=="on")
        {
            $ins->Privilege()->attach(4);
        }
        if ($data->all=="on")
        {
            $ins->Privilege()->attach(5);
        }
        $ins->name =$data->name;
        $ins->name = $data->name;
        $ins->email = $data->email;
        $ins->user_role =$data->rolename;
        var_dump($data->password);
        if (!is_null($data->password))
        {
            $ins->password = Hash::make($data->password);
        }
        $ins->save();
        return redirect(url('/inspector/settings'));
    }

    public function joblist()
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }

        $data=job::join('empprofiles','jobs.employer_id', '=', 'empprofiles.employer_id')
            ->select('jobs.*','empprofiles.companyname','ContactPhone','ContactEmail')
            ->paginate(10);
         //print_r($data);
        return view('dashboard.alljoblist',compact('data'));
    }
    public function employerlist()
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $data=empprofile::leftJoin("employers","employers.id","=","empprofiles.id")->paginate(10);
        foreach($data as $d)
        {
            $d->cnt=Job::where("employer_id",$d->employer_id)->count();
            if (!empty(Employer::find($d->employer_id)))
            {
                $d->em=Employer::find($d->employer_id)->email;
            }else{
                $d->em="empty";
            }
            $ind = DB::table('industrytypes')->where('id','=' , $d->industrytype)->get();
            if (!is_null($ind))
            {
                $x=0;
                foreach ($ind as $i) {
                    if ($x==0)
                    {
                       // var_dump($ind[0]->industrytypename);
                        $d->ind=$ind[0]->industrytypename;
                        $i++;
                    }
                }
                $ind = $ind->first();

            }else {
                $d->ind="Empty";
            }
        }
        // print_r($data->all());
        return view('dashboard.employerlist',compact('data'));
    }

    public function postdetail($id)
    {
        $data=job::join('empprofiles','jobs.employer_id', '=', 'empprofiles.employer_id')
            ->select('jobs.*','empprofiles.companyname','ContactPhone','ContactEmail')
            ->paginate(10);
        // print_r($data->all());
        $job = job::find($id);
        $emp = empprofile::find($job->employer_id);
        //var_dump($job);
        $area = DB::table('city_areas')->where('id', $job->area_id)->get();
        $ind = DB::table('industrytypes')->where('id', $job->industrytype_id)->get();
        if (!is_null($ind))
        {
            $ind =$ind[0];
        }else {

        }
        if (!is_null($area))
        {
            $area =$area[0];
        }else {

        }
        return view('dashboard.job_info',compact('job','emp','area','ind'));
    }

    public function dashboard()
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $jobs=DB::table("jobs")->count();
        $js=DB::table("jobseekers")->count();
        $emp=DB::table("employers")->count();

        $jobcount=   DB::select("select count(*) as cnt from jobs group by MONTHNAME(created_at)");



        $jscount=   DB::select("select count(*) as cnt from jobseekers group by MONTHNAME(created_at)");


        $employers=Employer::where("status",0)->get();
        //print_r($employers->all());
        //exit;
        $empcount=   DB::select("select count(*) as cnt from employers group by MONTHNAME(created_at)");
        $applied2 = array();
        $job = DB::table('jobs')->join("employers","employers.id","=","jobs.employer_id")->where('delete_status',0)->orderby("jobs.id","desc")->limit(2)->get();
        //print_r($job->all());
        foreach ($job as $j) {
            $applied2[$j->id]= $this->count_apply_particular_job($j->id);
        }
        //exit;
        return view("dashboard.dashboard",compact('employers','jobs','js','emp','jscount','jobcount','empcount','job','applied2'));

    }

    public function revenue()
    {
        return view('dashboard.noaccess');
    }
    public function getjbsnotification($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==1)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $jbs = personaldetails::where('jobseeker_id',$id)->get();
        if (!is_null($jbs))
        {
            $jbs=$jbs[0];
        }
        $jbs->em =Jobseeker::find($id)->email;

        return view("dashboard.jbsnotification",compact("jbs"));
    }

    public function approvejbs($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==1)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $jbs = Jobseeker::find($id);
        $jbs1 = personaldetails::where('jobseeker_id',$id)->get();
        if (!is_null($jbs1))
        {
            $jbs1=$jbs1[0];
            echo "ok";
        }
        $jbs->status = 1;
        $jbs->save();
        $email=$jbs->email;
        $m=Mail::send('public.welcomeemployerfinal', ['name'=>$jbs1->first_name], function($message) use ($email)
        {

            $message->to($email)->from("worldtalentjobs@gmail.com")->subject('Welcome To World Talent Jobs');
        });
        return redirect(url('/inspector/notifications'));
    }
    public function rejectjbs($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==1)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $emp=Jobseeker::find($id);
        $emp->delete();
        $empp = personaldetails::where('jobseeker_id',$id)->get();
        if (!is_null($empp))
        {
            $empp=$empp[0];
            $empp->delete();
        }
        return redirect(url('/inspector/notifications'));
    }


    public function getdeleteadmins($id)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $ins= Inspector::find($id);
        for ($i = 0; $i <= 7; $i++) {
            {

                $ec = $ins->Privilege()->find($i);
                if (is_null($ec)) {

                } else {
                    $ins->Privilege()->detach($i);
                }
            }
            //$pri =$pri[0];
        }
        $ins->delete();
        return redirect(url('/inspector/settings'));
    }

    public function postjoblist($start,$end)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        if ($start==0)
        {
            $start ="2000-01-01";
        }
        if ($end==0){
            $end=Carbon::now()->format('Y-m-d');
        }

        $data=job::join('empprofiles','jobs.employer_id', '=', 'empprofiles.employer_id')
            ->select('jobs.*','empprofiles.companyname','ContactPhone','ContactEmail')->whereDate('jobs.created_at', '>=', $start.' 00:00:00')
            ->whereDate('jobs.created_at', '<=', $end.' 00:00:00')
            ->paginate(10);
        // print_r($data->all());

        return view('dashboard.alljoblist',compact('data'));


    }
    public function dateemployerlist($start,$end)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        if ($start==0)
        {
            $start ="2000-01-01";
        }
        if ($end==0){
            $end=Carbon::now()->format('Y-m-d');
        }
        $data=empprofile::leftJoin("employers","employers.id","=","empprofiles.id")->whereDate('empprofiles.created_at', '>=', $start.' 00:00:00')
            ->whereDate('empprofiles.created_at', '<=', $end.' 00:00:00')->paginate(10);
        foreach($data as $d)
        {
            $d->cnt=Job::where("employer_id",$d->employer_id)->count();
            if (!empty(Employer::find($d->employer_id)))
            {
                $d->em=Employer::find($d->employer_id)->email;
            }else{
                $d->em="empty";
            }
            $ind = DB::table('industrytypes')->where('id','=' , $d->industrytype)->get();
            if (!is_null($ind))
            {
                $x=0;
                foreach ($ind as $i) {
                    if ($x==0)
                    {
                        $d->ind=$ind[0]->industrytypename;
                        $i++;
                    }
                }
                $ind = $ind->first();

            }else {
                $d->ind="Empty";
            }
        }


        // print_r($data->all());
        return view('dashboard.employerlist',compact('data'));
    }

    public function datejobseekerlist($start,$end)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5 ||$p->id==4)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        if ($start==0)
        {
            $start ="2000-01-01";
        }
        if ($end==0){
            $end=Carbon::now()->format('Y-m-d');
        }
        $data=personaldetails::leftJoin("jobseekers","jobseekers.id","=","personaldetails.id")->whereDate('jobseekers.created_at', '>=', $start.' 00:00:00')
            ->whereDate('jobseekers.created_at', '<=', $end.' 00:00:00')->paginate(10);

        foreach ($data as $e)
        {
            $e->created_at = Jobseeker::find($e->jobseeker_id)->created_at;
            //$datetime = DateTime::createFromFormat('d-m-Y', $e->jobseeker_dob);
            $datetime = str_replace('/', '-', $e->jobseeker_dob);
            //var_dump($datetime);
            $e->age=Carbon::parse($datetime)->age;

        }

        return view('dashboard.jobseekerlist',compact('data'));
    }

    public function updateEducations(Request $data)
    {
        $user = \Illuminate\Support\Facades\Auth::guard('inspector')->user();
        $pri = $user->Privilege()->get();
        $access = 0;
        foreach ($pri as $p)
        {

            if ($p->id==5)
            {
                $access=1;
            }

        }
        if ($access==0)
        {

            return view('dashboard.noaccess');
        }
        $person = personaldetails::where('jobseeker_id', $data->id)->get()->first();

        $edu_id = (int)$data->edu_id;


        $validator = Validator::make($data->all(), [
            'edu_degree' => "required",
            'edu_end_date' => "date_format:d/m/Y",
            'edu_start_date' => "date_format:d/m/Y|before:edu_end_date"
        ],[
            'edu_degree.required' => 'Degree must be checked!',
            'edu_start_date.before' => 'Start Date must be before than End Date!'
        ]);

        if($edu_id==0){
            $redirecturl = '/inspector/jbs/editresume/'.$data->id.'#EducationHeader';
        }
        else {
            $redirecturl = '/inspector/jbs/editresume/'.$data->id.'#education_form_'.$edu_id;
        }

        if ($validator->fails()) {

            return redirect($redirecturl)
                ->withErrors($validator, "education".$edu_id)
                ->withInput();
        }


        $maxno = DB::select('select distinct max(edu_no) as max from education where person_id = ?', [$person->id])[0];
        $maxno = $maxno->max;

        if(is_null($maxno) || $maxno == "") {
            $maxno = 0;
        }

        $edu = Education::find($edu_id);

        if(is_null($edu)) {
            $edu = new Education;
            $edu->person_id = $person->id;
            $edu->edu_no = $maxno + 1;
        }

        $edu->degree = $data->edu_degree;
        $edu->major_stream = $data->major_stream;
        $edu->start_date = $data->edu_start_date;
        $edu->end_date = $data->edu_end_date;

        if( $data->has('current')) {
            $edu->current_study = 1;
        }
        else{
            $edu->current_study = 0;
        }

        $edu->country = $data->edu_country;
        $edu->city = $data->edu_city;
        $edu->university = $data->edu_university;
        $edu->grading_system = $data->grading_system;
        $edu->grade = $data->grade;
        $edu->description = $data->description;

        $edu->save();

        if($edu_id==0){
            $neduid = $edu->id;
            $cids = explode(",", $data->cert_ids);

            foreach($cids as $cid) {
                $cert = Certificate::find($cid);

                if(is_null($cert)) continue;

                $cert->education_id = $neduid;
                $cert->save();
            }
        }

        return redirect($redirecturl);
    }
    public function removeEducation(Request $data)
    {
        $edu_id = $data->edu_id;
        $edu = Education::find($edu_id);
        $edu->delete();
        return response()->json(["id" => $edu_id], 200);
    }
    public function updateWorkexperience(Request $data)
    {
        $person = personaldetails::where('jobseeker_id', $data->id)->get()->first();

        $exp_id = (int)$data->exp_id;

        $validator = Validator::make($data->all(), [
            'job_description' => "filled"
        ],[
            'job_description.filled' => 'Description is required!'
        ]);


        if($exp_id==0){
            $redirecturl = '/inspector/jbs/editresume/'.$data->id.'#ExperienceHeader';
        }
        else {
            $redirecturl = '/inspector/jbs/editresume/'.$data->id.'#expdiv'.$exp_id;
        }

        // if ($validator->fails()) {
        //     $validator->errors()->add('expid', $exp_id);
        //     return redirect($redirecturl)
        //                 ->withErrors($validator, "experience")
        //                 ->withInput();
        // }

        $maxno = DB::select('select distinct max(exp_no) as max from workexperience where person_id = ?', [$person->id])[0];
        $maxno = $maxno->max;

        if(is_null($maxno) || $maxno == "") {
            $maxno = 0;
        }

        $exp = Workexperience::find($exp_id);
        if(is_null($exp)) {
            $exp = new Workexperience;
            $exp->person_id = $person->id;
            $exp->exp_no = $maxno + 1;
        }

        $exp->job_description = $data->job_description;
        $exp->company_name = $data->companyname;
        $exp->website_protocal = $data->website_protocal;
        if($exp->website_protocal=="") {
            $exp->website_protocal = "http://";
        }
        $exp->website = $data->website;
        $exp->location = $data->location;
        $exp->country = $data->exp_country;
        $exp->start_date = $data->exp_start_date;
        $exp->end_date = $data->exp_end_date;

        if( $data->has('current')) {
            $exp->current_work = 1;
        }
        else{
            $exp->current_work = 0;
        }

        $exp->job_title = $data->job_title;

        $exp->save();


        return redirect($redirecturl);
    }
    public function removeExperience(Request $data){
        $exp_id = $data->exp_id;
        $exp = Workexperience::find($exp_id);
        $exp->delete();
        return response()->json(["id" => $exp_id], 200);
    }
    public function updateSkillset(Request $data)
    {
        $person = personaldetails::where('jobseeker_id', $data->id)->get()->first();

        $skill_id = (int)$data->skillset_id;

        $skill = SkillSet::find($skill_id);
        if($skill == null) {
            $skill = new SkillSet;
            $skill->person_id = $person->id;
        }

        $skill->title = $data->title;
        $skill->skill = $data->skill;

        $skill->save();

        if($skill_id == 0) {
            return redirect('/inspector/jbs/editresume'.$data->id.'#SkillsetHeader');
        }

        return redirect('/inspector/jbs/editresume'.$data->id.'#skdiv_'.$skill_id);
    }

    public function removeSkillset(Request $data){
        $skill_id = $data->skill_id;
        $skill = SkillSet::find($skill_id);
        $skill->delete();
        return response()->json(["id" => $skill_id], 200);
    }

    public function updateProfileExp(Request $data)
    {
        $person = personaldetails::where('jobseeker_id', $data->id)->get()->first();

        $person->ex_link1_protocal = $data->ex_link1_protocal;
        if($person->ex_link1_protocal==""){
            $person->ex_link1_protocal="http://";
        }
        $person->ex_link1 = $data->ex_link1;

        $person->ex_link2_protocal = $data->ex_link2_protocal;
        if($person->ex_link2_protocal==""){
            $person->ex_link2_protocal="http://";
        }
        $person->ex_link2 = $data->ex_link2;
        $person->save();
        return redirect('/inspector/jbs/editresume/'.$data->id.'#ex_link_form');
    }
    public function addcv(Request $request)
    {
        //var_dump($request);
        $person = personaldetails::where('jobseeker_id', $request->id)->get()->first();

        $path = $request->cvfile->store('/public/cv');
        $path = str_replace("public","storage",$path);

        $cv = new cv;
        $cv->path = $path;
        $cv->displayname = $request->cvfile->getClientOriginalName();
        $cv->mimetype = $request->cvfile->getClientMimeType();
        $cv->person_id = $person->id;

        $cv->save();

        $html = view('jobseeker.cv', ['cv' => $cv])->render();

        return response()->json(['viewdata' => $html, 'cv_id'=> $cv->id], 200);
    }
    public function updateProfile(Request $data)
    {
        $jobprofile=personaldetails::where('jobseeker_id',$data->id)->get()[0];

        $jobprofile->first_name=$data->first_name;
        $jobprofile->last_name=$data->last_name;

        if( $data->has('jobseeker_gender_male')) {
            $jobprofile->jobseeker_gender = "male";
        }
        else{
            $jobprofile->jobseeker_gender = "female";
        }

        if( $data->has('jobseeker_maritalstatus_single')) {
            $jobprofile->jobseeker_maritalstatus = "single";
        }
        else{
            $jobprofile->jobseeker_maritalstatus = "married";
        }

        if( $data->has('NOC_avaiable')) {
            $jobprofile->NOC = 1;
        }
        else{
            $jobprofile->NOC = 0;
        }

        $validator = Validator::make($data->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'Driving_Licence' => "required_if:driving,==,on",
            'jobseeker_gender_male' => "required_if:jobseeker_gender_female,==,off",
            'jobseeker_maritalstatus_single' => "required_if:jobseeker_maritalstatus_married,==,off",
            'NOC_avaiable' => "required_if:NOC_navaiable,==,off",
            'jobseeker_nationality' => 'required',
            'jobseeker_current_location' => 'required',
            'jobseeker_dob' => 'required',
            'VISA_status' => 'required',
            'Languages' => 'required',
            'jobseeker_phone' => 'required',
            'target_jobs' => 'required',
            'target_title' => 'required',
            'target_locations' => 'required',
            'target_salary' => 'required',
            'target_industry' => 'required',
            'target_career_level' => 'required',
            'target_notice_period' => 'required',
            'target_objective' => 'required',
        ], [
            'first_name.required' => 'First Name is required!',
            'last_name.required' => 'Last Name is required!',
            'Driving_Licence.required_if' => "Driving License is required if I have driving license checked!",
            'jobseeker_gender_male.required_if' => "Gender is required!",
            'jobseeker_maritalstatus_single.required_if' => "Marital Status is required!",
            'NOC_avaiable.required_if' => "NOC is required!",
            'jobseeker_nationality.required' => 'Your Nationality is required!',
            'jobseeker_current_locationrequired' => 'Your Residence Location is required!',
            'jobseeker_dob.required' => 'Date of Birth is required!',
            'VISA_status.required' => 'Visa Status is required!',
            'Languages.required' => 'Languages are required!',
            'jobseeker_phone.required' => 'Mobile is required!',
            'target_jobs.required' => 'Job Target Tags are required!',
            'target_title.required' => 'Job Title is required!',
            'target_locations.required' => 'Job Locations are required!',
            'target_salary.required' => 'Monthly Salary is required!',
            'target_industry.required' => 'Job Industry is required!',
            'target_career_level.required' => 'Career Level is required!',
            'target_notice_period.required' => 'Notice Period is required!',
            'target_objective.required' => 'Career Objective is required!'
        ]);

        if ($validator->fails()) {
            return redirect('/inspector/jbs/editresume/'.$data->id.'#allerrorbag')
                ->withErrors($validator, "alldataerr")
                ->withInput();
        }

        $jobprofile->jobseeker_nationality=$data->jobseeker_nationality;
        $jobprofile->jobseeker_current_location=$data->jobseeker_current_location;
        $jobprofile->jobseeker_dob=$data->jobseeker_dob;
        $jobprofile->VISA_status=$data->VISA_status;
        $jobprofile->Driving_Licence=$data->Driving_Licence;
        $jobprofile->Languages=$data->Languages;
        $jobprofile->jobseeker_email=$data->jobseeker_email;
        $jobprofile->jobseeker_phone1=$data->jobseeker_phone;
        $jobprofile->target_tags=$data->target_jobs;
        $jobprofile->target_title=$data->target_title;
        $jobprofile->target_location=$data->target_locations;
        $jobprofile->target_salary=$data->target_salary;
        $jobprofile->target_industry=$data->target_industry;
        $jobprofile->target_career_level=$data->target_career_level;
        $jobprofile->target_notice_period=$data->target_notice_period;
        $jobprofile->target_objective=$data->target_objective;
        $jobprofile->target_employment_type=$data->target_employment_type;

        $jobprofile->ex_link1_protocal = $data->ex_link1_protocal;
        if($jobprofile->ex_link1_protocal==""){
            $jobprofile->ex_link1_protocal="http://";
        }
        $jobprofile->ex_link1 = $data->ex_link1;

        $jobprofile->ex_link2_protocal = $data->ex_link2_protocal;
        if($jobprofile->ex_link2_protocal==""){
            $jobprofile->ex_link2_protocal="http://";
        }
        $jobprofile->ex_link2 = $data->ex_link2;
        $jobprofile->completed = 1;

        $jobprofile->save();
        return redirect('/inspector/jbs/editresume/'.$data->id);
    }

    public function removecv(Request $request)
    {
        $cv = cv::find($request->cv_id);

        Storage::disk('public')->delete(str_replace("storage/", "", $cv->path));

        $cv->delete();

        return response()->json(["id" => $request->cv_id], 200);
    }

    public function edu_certfile_add(Request $request)
    {
        $edu_id = $request->edu_id;

        $path = $request->certfile->store('/public/certificate');
        $path = str_replace("public","storage",$path);

        $certificate = new Certificate;
        $certificate->path = $path;
        $certificate->displayname = $request->certfile->getClientOriginalName();
        $certificate->mimetype = $request->certfile->getClientMimeType();

        $certificate->education_id = $edu_id;
        if($certificate->education_id==0) {
            $certificate->education_id = -1;
        }

        $certificate->save();

        $html = view('jobseeker.certificate', ['cert' => $certificate])->render();

        return response()->json(['viewdata' => $html, 'cert_id'=> $certificate->id], 200);
    }
    public function edu_certfile_remove(Request $request)
    {
        $certificate = Certificate::find($request->cert_id);

        Storage::disk('public')->delete(str_replace("storage/", "", $certificate->path));

        $certificate->delete();

        return response()->json(["id" => $request->cert_id], 200);
    }

    public function testmodule()
    {
        $jbsn = Job::where('featured','=','0')->whereNotNull('data_featured')->get();
        foreach ($jbsn as $jb)
        {
            $jb->data_featured=NULL;
            $jb->save();
        }

    }

    public function employerApproveEmail($emp)
    {
//        dd($emp);
        return redirect(url('/inspector/employerdetails/' . $emp));
    }




    //end Bradlys changes
}




