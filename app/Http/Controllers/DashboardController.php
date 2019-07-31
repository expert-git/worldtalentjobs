<?php

namespace App\Http\Controllers\Inspector;

use Carbon\carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Session;
use App\catagory;
use App\industrytype;
use App\Applied_job;
use App\job;
use App\empprofile;
use App\personaldetails;
use App\Jobseeker;
use App\Education;
use App\Workexperience;
use App\conversation;
use App\Employer;
use Mail;

class DashboardController extends Controller
{
    public function __construct()
    {
        session_start();
        $this->middleware('inspector');
    } 
    

    public function joblist()
    {
        $data=job::join('empprofiles','jobs.employer_id', '=', 'empprofiles.employer_id')
        ->select('jobs.*','empprofiles.companyname','ContactPhone','ContactEmail')
        ->paginate(10);
       // print_r($data->all());
        return view('dashboard.joblist',compact('data'));
    }

    public function addMessage(Request $data)
{
    $msg=Message::create(['con_id'=>$data->con_id,'message'=>$data->message,'sender'=>$data->sender,'js'=>$data->js,'emp'=>$data->emp]);
}
public function getMessage($id)
{
    $msg=Message::where('con_id',$id)->get();
    return json_encode($msg->all());
}


public function viewapplied($id,$jid=0)
{
    $ap=Applied_job::where("applied_jobs.jobseeker_id",$id)
    ->join("personaldetails","personaldetails.jobseeker_id","=","applied_jobs.jobseeker_id")
    ->join("jobs","jobs.id","=","applied_jobs.job_id")
   // ->leftJoin("personaldetails","personaldetails.target_industry","=","industrytypes.id")
    ->select("jobs.id as jid","applied_jobs.id as applied_id","applied_jobs.*","personaldetails.*","jobs.*")
    ->paginate(10);
    if(count($ap)>0)
    {
        if($jid==0)
        {
            $jid=$ap[0]->jid;
        }
    }

    $job_description=job::where("jobs.id",$jid)
    ->join("empprofiles","empprofiles.id","=","jobs.employer_id")->get();
    $job_description=$job_description[0];
    //print_r($job_description->all());
    //  exit;
    return view("dashboard.viewapplied",compact('ap','id','jid','job_description'));
}

public function editprofile($id)
{
    session::put('tmp_user_id', ['tmp'=>$id]);

    $nationality=DB::table('nationality')->get();
    $country=DB::table('country')->get();
    $get_ind=$this->get_industrytype();
    $exp=Workexperience::find($id);
    $edu=Education::find($id);
    $edu->details=json_decode($edu->details);
    
    $js=Jobseeker::find($id);
    $email=$js->email;
    $exp->experience=json_decode($exp->experience);
    $division = $this->get_division();
    $jobs=Jobseeker::join('personaldetails','jobseekers.id','personaldetails.jobseeker_id')
    ->where('jobseekers.id',$id)->get();
	//echo"<pre>";
	//print_r($jobs); die;
    return view('dashboard.myprofile',compact('id','email','country','nationality','jobs','get_ind','division','exp','edu'));
}

public function edit_a_job($jobid)
{
	$jobs = job::where('id',$jobid)->get();
	$category = DB::table('catagories')->select('catagoryname','id')->get();
	$industry = DB::table('industrytypes')->select('industrytypename','id')->get();
	$countries = DB::table('country')->select('name','id')->get();

	$nowFormat = date('Y-m-d');
	
	$ida = $jobs[0]->employer_id;
	$myprofile = empprofile::where('employer_id', $ida)->get();
	$myprofile=$myprofile[0];
	$alljobs=DB::table('jobs')->where('employer_id', $ida)->count();
			$active = DB::table('jobs')->where('employer_id', $ida)->where('deadline','>',$nowFormat)->where('delete_status',0)->count();
	
	$division = DB::table('divisions')->get();
	return view('dashboard.edit_a_job',compact('alljobs','active','myprofile','jobs','category','industry','division','countries'));
}

public function edit_post_job(Request $data)
	{
		
		//echo "<pre>";
		//print_r($data->all()); die;
		
		$job = job::findOrFail($data->id);
		
		$job->catagory_id=$data->catagory_id;
		$job->industrytype_id=$data->industrytype_id;
		$job->salaryrange=$data->salaryrange;
		$job->jobtitle = $data->jobtitle;
		$job->vacancies=$data->vacancies;
		$job->instruction=$data->instruction;
		$job->email=$data->email;
		$job->deadline=$data->deadline;
		$job->contactperson=$data->contactperson;
		$job->designation=$data->designation;
		
		$job->division_id=$data->division;
		$job->district_id=$data->districts;
		$job->agerange=$data->agerange;
		$job->jobtype=$data->jobtype;
		$job->joblevel=$data->joblevel;
		$job->educational_qualification=$data->educational_qualification;
		$job->job_responsibilities=$data->job_responsibilities;
		$job->job_experiences_year=$data->job_experiences_year;
		$job->job_experiences_field=$data->job_experiences_field;
		

		$job->quest_location=$data->quest_location;
		$job->quest_location_req=$data->quest_location_req;
		$job->quest_exp=$data->quest_exp;
		$job->quest_exp_req=$data->quest_exp_req;

		$job->quest_salary=$data->quest_salary;
		$job->quest_salary_req=$data->quest_salary_req;
		$job->quest_license=$data->quest_license;
		$job->license_req=$data->license_req;
		$job->quest_language=$data->quest_language;
		$job->language_req=$data->language_req;
		$job->quest_min_edu=$data->quest_min_edu;
		$job->min_edu_req=$data->min_edu_req;
		$job->quest_notify=$data->quest_notify;
		//print_r($job);
		$job->save();

		return redirect('inspector/');

	}

public function updateProfileBasic(Request $data)
{
  //  print_r( session('tmp_user_id')['tmp']);
  //  exit;
  
    $jobprofile=personaldetails::where('jobseeker_id',$data->id)->get();
    $jobprofile=personaldetails::find($jobprofile[0]->id);
    if($data->hasFile('avatar')){
		$path = $data->file('avatar')->store('/public/profile');
		$path=str_replace("public","storage",$path);
		$jobprofile->profile_img=$path;
    }
   // exit;

    $jobprofile->full_name=$data->full_name;
    $jobprofile->jobseeker_gender=$data->jobseeker_gender;
    $jobprofile->jobseeker_maritalstatus=$data->jobseeker_maritalstatus;
    $jobprofile->jobseeker_nationality=$data->jobseeker_nationality;
    $jobprofile->jobseeker_current_location=$data->jobseeker_current_location;
    $jobprofile->jobseeker_dob=$data->jobseeker_dob;
    $jobprofile->VISA_status=$data->VISA_status;
    $jobprofile->Driving_Licence=$data->Driving_Licence;
    $jobprofile->Languages=$data->Languages;
    $jobprofile->NOC=$data->NOC;
    $jobprofile->jobseeker_email=$data->jobseeker_email;
    $jobprofile->jobseeker_phone1=$data->jobseeker_phone1;
    $jobprofile->target_tags=$data->target_tags;

    $jobprofile->target_title=$data->target_title;
    $jobprofile->target_location=$data->target_location;
    $jobprofile->target_salary=$data->target_salary;
    $jobprofile->target_industry=$data->target_industry;
    $jobprofile->target_career_level=$data->target_career_level;
    $jobprofile->target_notice_period=$data->target_notice_period;
    $jobprofile->target_objective=$data->target_objective;
    $jobprofile->target_employment_type=$data->target_employment_type;


    
    $jobprofile->save();
    return redirect('/inspector/editprofile/'.session('tmp_user_id')['tmp']);
}

	

private function get_industrytype(){
    $get_industrytype=DB::table('industrytypes')->get();
        return $get_industrytype;
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



    public function updateEducations(Request $data)
    {
        $exp=Education::find($data->id);
        $arr=array();
        for($i=0;$i<count($data->stream);$i++)
        {
            $a=array();
            if($data->stream[$i])
            {     
                $a['companyname']=$data->companyname[$i];
                $a['website']=$data->website[$i];
            $a['stream']=$data->stream[$i];
            $a['sdate']=$data->sdate[$i];
            $a['edate']=$data->edate[$i];
            $a['country']=$data->country[$i];
            $a['city']=$data->city[$i];
            $a['grading']=$data->grading[$i];
            $a['score']=$data->score[$i];
            $a['description']=$data->description[$i];
            $a['high']=isset($data->high[$i])?$data->high[$i]:0;
            $a['diploma']=isset($data->diploma[$i])?$data->diploma[$i]:0;
            $a['bach']=isset($data->bach[$i])?$data->bach[$i]:0;
            $a['higher']=isset($data->higher[$i])?$data->higher[$i]:0;
            $a['master']=isset($data->master[$i])?$data->master[$i]:0;
            $a['doctorate']=isset($data->bach[$i])?$data->bach[$i]:0;
 
            array_push($arr,$a);
            }
        }
        $data->degree=($data->degree);
        $exp->degree=($data->degree);

        $exp->details=json_encode($arr);


        $exp->save();
      //  print_r($data->all());
        return redirect('/inspector/editprofile/'.$data->id);
       // $exp=Education::find(Auth::guard('jobseeker')->user()->id);

    }

    public function updateProfileExp(Request $data)
    {
        $exp=Workexperience::find($data->id);
        $arr=array();
        for($i=0;$i<count($data->location);$i++)
        {
            $a=array();
            if($data->location[$i])
            {
                echo "loc is".$data->description[$i];
            $a['location']=$data->location[$i];
            $a['companyname']=$data->companyname[$i];
            $a['website']=$data->website[$i];
            $a['sdate']=$data->sdate[$i];
            $a['edate']=$data->edate[$i];
            $a['description']=$data->description[$i];
            array_push($arr,$a);
            }

        }
        $exp->experience=json_encode($arr);
        $exp->skills=($data->skills);
        $exp->bio=$data->bio;

        $exp->link1=$data->link1;
        $exp->link2=$data->link2;
        $exp->save();
        return redirect('/inspector/editprofile/'.$data->id);
    }

    public function addcv(Request $data)
    {
        $jobprofile=personaldetails::where('jobseeker_id',$data->id)->get(); 

        $jobprofile=personaldetails::find($jobprofile[0]->id);
        $jobprofile->cv=$data->cv;
        $jobprofile->save();
        return redirect('/inspector/editprofile/'.$data->id);
    }


    public function getAllCandidates($id,$status=0)
	{
        
	//	echo $status;	
		$myprofile = empprofile::where('employer_id',$id)->get();
		$myprofile=$myprofile[0];
        $applicants = Applied_job::join('personaldetails','personaldetails.jobseeker_id','=','applied_jobs.jobseeker_id')
        ->join('jobs','jobs.id','=','applied_jobs.job_id')
		->select('jobs.jobtitle','jobs.job_responsibilities','applied_jobs.id as aj','applied_jobs.*','personaldetails.*')
		->where('applied_jobs.employer_id',$id)
		->where('status',$status)
        ->paginate(10);
        
       // $jobdata = job::find($id);
		$clss=1;
		$all=$this->count_all_by_status($id,0);
		$shortlisted=$this->count_all_by_status($id,1);
		$rejected=$this->count_all_by_status($id,2);
		$scheduled=$this->count_all_by_status($id,3);
		$spam=$this->count_all_by_status($id,4);
		$nowFormat = date('Y-m-d');
		$ida = $id;
        $alljobs=DB::table('jobs')->where('employer_id',$ida)->count();
        $active = DB::table('jobs')->where('employer_id',$ida)->where('deadline','>',$nowFormat)->where('delete_status',0)->count();
		return view('dashboard.getAllCandidates',compact('jobdata','clss','active','alljobs','notif','id','myprofile','applicants','jobdata','all','shortlisted','rejected','scheduled','spam'));
	}
public function postdetails($id,$jsid)
	{

       // exit;
		$applicants = Applied_job::join('personaldetails','personaldetails.jobseeker_id','=','applied_jobs.jobseeker_id')
		->select('applied_jobs.id as aj','applied_jobs.*','personaldetails.*')
		->where('applied_jobs.job_id',$id)->get();

	//	print_r($applicants);
		$job=job::where("jobs.id",$id)->join("empprofiles","empprofiles.id","=","jobs.employer_id")->get();
		$jobprofile=personaldetails::where('jobseeker_id',$jsid)->get();
		$jobprofile=personaldetails::find($jobprofile[0]->id);
		$jobprofile->cv=json_decode($jobprofile->cv);
		
        $edu=Education::find($jsid);
		$edu->details=json_decode($edu->details);
		
        $edu->degree=json_decode($edu->degree);

       

        $exp=Workexperience::find($jsid);
        $exp->experience=json_decode($exp->experience);
       
		return view('dashboard.jobdetails',compact('job','applicants','jobprofile','exp','edu','id'));
		

	}

public function empInbox($id)
{
    $myprofile = empprofile::where('employer_id',$id)->get();
    $myprofile=$myprofile[0];
    $conv=conversation::where('employer',$id)
    ->get();
    return view('dashboard.messages',compact('conv','myprofile'));

}

public function postdetail($id)
{

}
public function jsInbox($id)
{

    $jobseekerdetails=personaldetails::where('jobseeker_id',$id)->get();
	
    $applied=DB::table('applied_jobs')->where('jobseeker_id',$id)->get();
    $applied=count($applied);
    $conv=conversation::where('jobseeker',$id)->get();
    return view('dashboard.jsmessages',compact('applied','jobseekerdetails','conv'));
}




    public function jobdescription($emp,$job)
    {
        $data=job::join('empprofiles','jobs.employer_id', '=', 'empprofiles.employer_id')
        ->leftJoin('divisions','jobs.division_id', '=', 'divisions.id')
        ->leftJoin('industrytypes','industrytypes.id', '=', 'jobs.industrytype_id')

        ->select('jobs.*','empprofiles.companyname','ContactPhone','ContactEmail','divisions.name','industrytypes.industrytypename','empprofiles.industrytype')
        ->where('jobs.employer_id',$emp)
        ->where('jobs.id',$job)->get();
       // print_r($data->all());
        return view('dashboard.jobdescription',compact('data'));
    }

    public function jobdetail($emp,$id=0){
 
		$myprofile = empprofile::where('employer_id',$emp)->get();
		$myprofile=$myprofile[0];

		
		$cat=catagory::pluck('catagoryname','id');
		$industry=industrytype::pluck('industrytypename','id');
		$ida = $emp;
	//all active jobs
		if($id==0)
		{
			$nowFormat = date('Y-m-d');
			//echo $nowFormat;		
			$job = DB::table('jobs')->where('employer_id',$ida)->where('deadline','>',$nowFormat)->where('delete_status',0)->paginate(10);
		}
		//passed jobs
		if($id==1)
		{
			$nowFormat = date('Y-m-d');
			$job = DB::table('jobs')->where('employer_id',$ida)->where('deadline','<',$nowFormat)->paginate(10);
		}
		//closed
		if($id==2)
		{	
			$nowFormat = date('Y-m-d');
	
			$job = DB::table('jobs')->where('employer_id',$ida)->where('delete_status',1)->paginate(10);
		}
	
	//	echo $nowFormat;		
		$active = DB::table('jobs')->where('employer_id',$ida)->where('deadline','>',$nowFormat)->where('delete_status',0)->count();
		$passed = DB::table('jobs')->where('employer_id',$ida)->where('deadline','<',$nowFormat)->count();
		$closed = DB::table('jobs')->where('employer_id',$ida)->where('delete_status',1)->count();
	// echo $active.$passed.$closed;
	 // get countries
	 $division = DB::table('divisions')->pluck('name','id');
	 $company=empprofile::where('id',$emp)->get();
	 //print_r($company[0]->companyname);
	 $applied2 = array();

	

	 foreach ($job as $j) {
	 $applied2[$j->id]= $this->count_apply_particular_job($j->id);
	// echo $applied2[$j->id];
     }
     //print_r($job);
     //exit;

	return view('dashboard.job',compact('ida','myprofile','applied2','cat','industry','job','division','company','active','passed','closed'));
}

public function createConversation($emp,$js)
{
    $conv=conversation::where('employer',$emp)->where('jobseeker',$js)->get();
    if(count($conv)==1)
    {
       // return $conv[0]->id;
    }
    else
    {
        $e=Employer::find($emp);
        $j=Jobseeker::find($js);
        $co=conversation::create(['employer'=>$emp,'jobseeker'=>$js,'employer_name'=>$e->name,'jobseeker_name'=>$j->name]);
      //  return $co->id;
    }
    return redirect("/inspector/message/".$emp);

}

public function getCandidates($emp,$id,$status)
{
    $jobdata = job::find($id);
    $myprofile = empprofile::where('employer_id',$emp)->get();
    $myprofile=$myprofile[0];
    $applicants = Applied_job::join('personaldetails','personaldetails.jobseeker_id','=','applied_jobs.jobseeker_id')
    ->select('applied_jobs.id as aj','applied_jobs.*','personaldetails.*')
    ->where('applied_jobs.job_id',$id)->where('status',$status)->paginate(10);
   /* $jobdata = job::join('empprofiles', 'jobs.employer_id', '=', 'empprofiles.employer_id')
    ->join('catagories', 'jobs.catagory_id', '=', 'catagories.id')
    ->join('industrytypes', 'jobs.industrytype_id', '=', 'industrytypes.id')
    ->join('districts', 'jobs.district_id', '=', 'districts.id')
    ->join('divisions', 'jobs.division_id', '=', 'divisions.id')
    ->select('jobs.*','empprofiles.companyname','empprofiles.companylogo','empprofiles.companyaddress', 'catagories.catagoryname', 'industrytypes.industrytypename','districts.name as distname','divisions.name as divname')
    ->where('jobs.id',$id)
    ->get();*/
    


    $all=$this->count_by_status($id,0);
    $shortlisted=$this->count_by_status($id,1);
    $rejected=$this->count_by_status($id,2);
    $scheduled=$this->count_by_status($id,3);
    $spam=$this->count_by_status($id,4);
    
    return view('dashboard.getCandidates',compact('jobdata','emp','id','myprofile','applicants','jobdata','all','shortlisted','rejected','scheduled','spam'));
}

private function count_by_status($job_id,$status)
	{
		$applied_on_job = DB::table('applied_jobs')->where('job_id',$job_id)->where('status',$status)->get();
		return count($applied_on_job);
    }
    
    private function count_all_by_status($job_id,$status)
	{
		$applied_on_job = DB::table('applied_jobs')->where('employer_id',$job_id)->where('status',$status)->get();
		return count($applied_on_job);
	}

private function count_apply_particular_job($job_id)
{
    $applied_on_job = DB::table('applied_jobs')->where('job_id',$job_id)->get();
    return count($applied_on_job);
}
    public function employerlist()
    {
        //$data=empprofile::paginate(20);
        $data=empprofile::leftJoin("employers","employers.id","=","empprofiles.id")->select("empprofiles.*","employers.email as em")->get();
        foreach($data as $d)
        {
            $d->cnt=Job::where("employer_id",$d->employer_id)->count();
        }
       // print_r($data->all());
        return view('dashboard.employerlist',compact('data'));
    }

    public function spam($id,$status,Request $request)
    {
        print_r($request->all());
		$db=Applied_job::find($id);
		$db->status=$status;
		if($status==3)
		{
		$db->scheduled_time=$request->time;
		}

		$db->save();
		//return redirect('/employer/managejobs/0');
        return redirect("/inspector/dashboard");

    }
    public function changestatus(Request $data)
    {
        //print_r($data->all());
        $emp=Employer::find($data['id']);
        $emp->status=$data['status'];
        $emp->isnew=0;
        $emp->save();


        if($data['status']==1)
        {
         
            $email=$emp->email;
            $m=Mail::send('public.employer_welcome', ['name'=>$emp->name], function($message) use ($email)
            {

                $message->to($email)->from("worldtalentjobs@gmail.com")->subject('Welcome To World Talent Jobs');
            });
         //   echo "a";
          //  return $m;
        }
    }
    public function employerdetail($id)
    {
        $cnt=Job::where("employer_id",$id)->count();
        $data=empprofile::where('empprofiles.id',$id)
        ->join("employers","employers.id","=","empprofiles.id")
        ->leftJoin('country','country.id','=','empprofiles.country')
        ->leftJoin('divisions','divisions.id','=','empprofiles.division')
        ->select("empprofiles.*","employers.*","country.name as country","divisions.name as division")
        ->get();
       $data=$data[0];
      // print_r($data);
        return view('dashboard.empdetail',compact('data','cnt'));
    }
    public function employerjoblist($id)
    {

    }
    public function employerjobdetail($id)
    {

    }
    public function candidatelist()
    {
        /*$data=personaldetails::
        leftJoin('industrytypes','industrytypes.id', '=', 'personaldetails.target_industry')
        ->paginate(20);*/
		$data=personaldetails::
        leftJoin('industrytypes','industrytypes.id', '=', 'personaldetails.target_industry')
        ->get();
        // print_r($data->all());
        return view('dashboard.candidatelist',compact('data'));
    }
    public function candidateapplied($id)
    {

    }
    public function savejobseekersettings(Request $request)
    {
        $js=Jobseeker::find($request->id);
    $js->fb=$request['fb'];
    $js->linkedin=$request['linkedin'];
    $js->twitter=$request['twitter'];
    $js->username=$request['username'];
    echo $request['username'];
    if($request['old'])
    {
    $pwd=bcrypt($request['old']);
    echo Auth::guard('jobseeker')->user()->email;

    if (Auth::guard('jobseeker')->check(['email' => Auth::guard('jobseeker')->user()->email, 'password' => $request['old']])) {
        // Authentication passed...
        
        Auth::guard('jobseeker')->user()->password=bcrypt($request['password']);
    }
    
    else
    {
        return response()->json(array('err' => 'Old password does not match'), 400);
    }
}
  
   $js->save();
   return "true";
}

public function employersettings($ida)
    {
        $country=DB::table('country')->get();
        $division=DB::table('divisions')->get();
        $myprofile = empprofile::where('employer_id', $ida)->get();
		$myprofile=$myprofile[0];
        //
        $clss=3;

        $nowFormat = date('Y-m-d');
		
		$alljobs=DB::table('jobs')->where('employer_id',$ida)->count();
			$active = DB::table('jobs')->where('employer_id',$ida)->where('deadline','>',$nowFormat)->where('delete_status',0)->count();
		
        $emp=empprofile::where("empprofiles.id",$ida)->leftJoin("employers","employers.id","=","empprofiles.id")->select("empprofiles.*","employers.email as em")->get();
        $emp=$emp[0];
        return view('dashboard.employer_settings',compact('clss','alljobs','active','myprofile','emp','country','division'));
    }
	
	 public function saveemployersettings(Request $data)
    {
       //echo"<pre>";
       //print_r($data->all());
       $emp=Employer::find($data->id);
       $emp->email=$data->username;
        $settings=empprofile::find($data->id);
		//print_r($settings->password); die;
        $settings->companyname=$data->companyname;
        $settings->websiteaddress=$data->websiteaddress;
        $settings->country=$data->country;
        $settings->area=$data->area;
        $settings->ContactEmail=$data->ContactEmail;
        $settings->fb=$data->fb;
        $settings->twitter=$data->twitter;
        $settings->linkedin=$data->linkedin;
        $settings->username=$data->username;
        
        $settings->ContactEmail=$data->ContactEmail;
        $emp->save();
        //Auth::guard('employer')->user($data->id)->email=$data['ContactEmail'];
		if($data->old != ''){
			if($data->old){
				$pwd=bcrypt($data->old);
				if(Hash::check($data['old'],$settings->password)){
					$settings->password = bcrypt($data['new']);
					$settings->save();
					return "true";
				}else{
					return response()->json(array('err' => 'Old password does not match'), 400);
				}
			}
		}

        $settings->save();
        return redirect()->back();

    }


    public function updateempimage(Request $data)
    {
        echo $data->id;
        $jobprofile=empprofile::find($data->id);  
        
        if($data->hasFile('avatar')){
			$path = $data->file('avatar')->store('/public/profile');
			$path=str_replace("public","storage",$path);
			$jobprofile->companylogo=$path;
        }else{
			$jobprofile->companylogo = null;
		}
        $jobprofile->save();
       
		return redirect()->back();
        //return redirect('/dashboard/getProfile');
    }

    public function updateimage(Request $data)
    {
        $jobprofile=personaldetails::where('jobseeker_id', $data->id)->get();
        $jobprofile=personaldetails::find($jobprofile[0]->id);
        
        if($data->hasFile('avatar')){
			$path = $data->file('avatar')->store('/public/profile');
			$path=str_replace("public","storage",$path);
			$jobprofile->profile_img=$path;
        }else{
			$jobprofile->profile_img = null;
		}
        $jobprofile->save();
		return redirect()->back();
        //return redirect('/dashboard/getProfile');
    }

    public function myresume($id)
    {
        $jobprofile=personaldetails::where('jobseeker_id',$id)
        ->leftJoin('divisions','personaldetails.target_location', '=', 'divisions.id')
        ->leftJoin('industrytypes','industrytypes.id', '=', 'personaldetails.target_industry')
        ->get();
      
        $jobprofile=$jobprofile[0];
        
        //$jobprofile=personaldetails::find($jobprofile[0]->id);
        $jobprofile->cv=json_decode($jobprofile->cv);
        $edu=Education::find($id);
        $edu->details=json_decode($edu->details);
        $edu->degree=json_decode($edu->degree);

        $exp=Workexperience::find($id);
        $exp->experience=json_decode($exp->experience);
        return view('dashboard.resume',compact('id','jobprofile','exp','edu'));
    }


    public function candidatesettings($id)
    {
        $jobseekerdetails=personaldetails::where('jobseeker_id',$id)->get();
        $myprofile= Jobseeker::find($id);
        return view('dashboard.settings',compact('id','applied','jobseekerdetails','myprofile'));
    }
    public function candidatecv($id)
    {

    }
    public function index(){
        $show_details=$this->ShowDetails();
        $show_newjobseeker=$this->newjobseeker();
        $show_ShowEmployer=$this->ShowEmployer();
        $show_ShowTotaljob=$this->ShowTotaljob();
        $Show_pendingJob=$this->ShowpendingJob();
        $Show_PublishedJob=$this->ShowPublishedJob();
        return view('dashboard.dashboard', compact('show_details','show_newjobseeker','show_ShowEmployer','show_ShowTotaljob','Show_pendingJob','Show_PublishedJob'));

    }


    private function ShowDetails(){
     $get_details = DB::table('jobseekers')->get();
     return $countjobseeker = count($get_details);

    }

    private function newjobseeker(){
     $get_newjobseeker = DB::table('jobseekers')->whereBetween('created_at',array(carbon::today()->subDays(2),carbon::tomorrow()))->get();
     return $countnewjobseeker = count($get_newjobseeker);

    }

    private function ShowEmployer(){
     $get_ShowEmployer = DB::table('employers')->get();
     return $countEmployer = count($get_ShowEmployer);

    }

    private function ShowTotaljob(){
     $get_ShowTotaljob = DB::table('jobs')->get();
     return $countShowTotaljob = count($get_ShowTotaljob);

    }

    private function ShowpendingJob(){
     $get_pendingJob = DB::table('jobs')->where('published',0)->get();
     return $countpendingJob = count($get_pendingJob);

    }

    private function ShowPublishedJob(){
     $get_PublishedJob = DB::table('jobs')->where('published',1)->get();
     return $countPublishedJob = count($get_PublishedJob);

    }



    public function notifications()
    {

        $employers=Employer::where("status",0)->paginate(10);
        return view("dashboard.notifications",compact("employers"));
    }


    public function dashboard()
    {
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
     $job = DB::table('jobs')->join("employers","employers.id","=","jobs.employer_id")->where('delete_status',0)->orderby("jobs.id","desc")->limit(4)->get();
     //print_r($job->all());
	 foreach ($job as $j) {
     $applied2[$j->id]= $this->count_apply_particular_job($j->id);
     }
        //exit;
        return view("dashboard.dashboard",compact('employers','jobs','js','emp','jscount','jobcount','empcount','job','applied2'));
        
    }

}
