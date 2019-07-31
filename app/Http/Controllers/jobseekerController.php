<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\personaldetails;
use Auth;
use App\applicationinfo;
use App\catagory;
use App\empprofile;
use App\block;
use App\follower;
use App\academic;
use App\exam_title;
use App\extraactivities;
use DB;
use App\CityArea;
use App\Jobseeker;
use App\Workexperience;
use App\Workexperience1;
use App\notification;
use App\Education;
use App\Education1;
use App\Certificate;
use App\SkillSet;
use App\JobTag;
use App\cv;
use Response;
use App\job;
use Illuminate\Support\Facades\Hash;
use App\Applied_job;
use App\Http\Requests\PersonalEducationPost;
use App\Http\Requests\PersonalExperiencePost;

use App\Constants\Constants;
use Illuminate\Support\Facades\Storage;
use Validator;
use DateTime;
use App\Mail\verifyEmail;

use Illuminate\Support\MessageBag;
use Mail;
use PDF;


class jobseekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('jobseeker', ['except' => ['uploaddoc','getCandidateInfo']]);
    } 

// get index value


public function getCandidateInfo($jid){

    $catagories=catagory::all();
    

    $personaldetail = personaldetails::where('jobseeker_id',$jid)->get();

    $levelofeducation = $this->get_levelof_education($jid);

    $academicsdata = $this->getacademic($jid);

    if (count($academicsdata)>0){
        $levelNames =[];
        foreach($academicsdata as $acadata) {
            $levelNames[$acadata->lavelofeducation_id] = $this->getLevelName($acadata->lavelofeducation_id);
        }

    }


    if (count($academicsdata)>0 && isset($academicsdata[0]->exam_title_id)) {
        $examtitlename =[];
        foreach($academicsdata as $acadata) {
            $examtitlename[$acadata->exam_title_id] = $this->getexamName($acadata->exam_title_id);
        }

    }

    if (count($academicsdata)>0 && isset($academicsdata[0]->groupormajor_id)) {
        $majorename =[];
        foreach($academicsdata as $acadata) {
            $majorename[$acadata->groupormajor_id] = $this->getmajorname($acadata->groupormajor_id);
        }


   }
    

    if (count($personaldetail)>0) {
        $personaldetails=$personaldetail[0];
    }
    $item = applicationinfo::where('jobseeker_id',$jid)->get();

    if (count($item)>0) {
        $items=$item;
    }else{
    $items = [];
}

   if(count($this->getexamtitle())>0){
    $getexamtitle=$this->getexamtitle();
   }

   if(count($this->getgroup())>0){
    $getgroup=$this->getgroup();
   }

  $get_skill = $this->get_skill($jid);

  $get_training=$this->get_training_info($jid);

  $get_refference = $this->get_refference_info($jid);

  $extraActivities=$this->extraActivities($jid);
  
    return view('employer.getCandidateInfo',compact('levelofeducation','personaldetails','items','catagories','academicsdata','levelNames','examtitlename','majorename','getexamtitle','getgroup','get_skill','get_training','get_refference','extraActivities'));
}
    public function index(){

        $catagories=catagory::all();
        
        $jid=Auth::guard('jobseeker')->user()->id;

        $personaldetail = personaldetails::where('jobseeker_id',$jid)->get();

        $levelofeducation = $this->get_levelof_education($jid);

        $academicsdata = $this->getacademic($jid);

        if (count($academicsdata)>0){
            $levelNames =[];
            foreach($academicsdata as $acadata) {
                $levelNames[$acadata->lavelofeducation_id] = $this->getLevelName($acadata->lavelofeducation_id);
            }

        }


        if (count($academicsdata)>0 && isset($academicsdata[0]->exam_title_id)) {
            $examtitlename =[];
            foreach($academicsdata as $acadata) {
                $examtitlename[$acadata->exam_title_id] = $this->getexamName($acadata->exam_title_id);
            }
  
        }

        if (count($academicsdata)>0 && isset($academicsdata[0]->groupormajor_id)) {
            $majorename =[];
            foreach($academicsdata as $acadata) {
                $majorename[$acadata->groupormajor_id] = $this->getmajorname($acadata->groupormajor_id);
            }

  
       }
        
    
        if (count($personaldetail)>0) {
            $personaldetails=$personaldetail[0];
        }
        $item = applicationinfo::where('jobseeker_id',$jid)->get();

        if (count($item)>0) {
            $items=$item;
        }else{
		$items = [];
	}
	
       if(count($this->getexamtitle())>0){
        $getexamtitle=$this->getexamtitle();
       }

       if(count($this->getgroup())>0){
        $getgroup=$this->getgroup();
       }

      $get_skill = $this->get_skill($jid);

      $get_training=$this->get_training_info($jid);

      $get_refference = $this->get_refference_info($jid);

      $extraActivities=$this->extraActivities($jid);
      

    	return view('jobseeker.dashboard.dashboard',compact('levelofeducation','personaldetails','items','catagories','academicsdata','levelNames','examtitlename','majorename','getexamtitle','getgroup','get_skill','get_training','get_refference','extraActivities'));
    }


    private function get_levelof_education($jobseeker_id)
    {
        $levelofeducation =  DB::table('levelofeducations')->pluck('edulavelname','id');

        if (count($levelofeducation)>0) {
            return $levelofeducations=$levelofeducation;
        }else{
            return $levelofeducations = ['message'=>'No data found'];
        }
    }

    // jobseeker profile update


    public function apply($id)
    {
        $jobs = job::find($id);
        $jid  = Auth::guard('jobseeker')->user()->id;
        $personaldetail = personaldetails::where('jobseeker_id',$jid)->first();
        return view('jobseeker.apply',compact('jobs', 'personaldetail'));
    }

    public function infoupdate(Request $request){

    	$jid=Auth::guard('jobseeker')->user()->id;
        
        
         switch ($request->action) {




            case 'showexamtitle':
                $examtitle=DB::table('exam_titles')->select('name','id')->where('levelofeducation_id',$request->id)->get();
                return response()->json($examtitle);
                break;
            case 'showgroup_mejor':
                $group=DB::table('groupoormajors')->select('groupname','id')->where('exam_title_id',$request->exam_title_id)->get();
                //$group=DB::table('groupoormajors')->where('exam_title_id',$request->exam_title_id)->pluck('groupname','id');
                
                return $group;
                break;
           
            case 'pinfoupdate':
                $personaldetail = personaldetails::where('jobseeker_id',$jid)->get();
                $personaldetails=$personaldetail[0];
                $personaldetails->full_name=$request->full_name;
                $personaldetails->jobseeker_father_name=$request->jobseeker_father_name;
                //return "ok";
                $personaldetails->jobseeker_mother_name=$request->jobseeker_mother_name;
                $personaldetails->jobseeker_dob=$request->jobseeker_dob;
                $personaldetails->jobseeker_gender=$request->jobseeker_gender;
                $personaldetails->jobseeker_maritalstatus=$request->jobseeker_maritalstatus;
                $personaldetails->jobseeker_nationality=$request->jobseeker_nationality;
                $personaldetails->jobseeker_national_id_no=$request->jobseeker_national_id_no;
                $personaldetails->jobseeker_religion=$request->jobseeker_religion;
                $personaldetails->jobseeker_permanent_address=$request->jobseeker_permanent_address;
                $personaldetails->jobseeker_current_address=$request->jobseeker_current_address;
                $personaldetails->jobseeker_current_location=$request->jobseeker_current_location;
                $personaldetails->jobseeker_phone1=$request->jobseeker_phone1;
                $personaldetails->jobseeker_phone2=$request->jobseeker_phone2;
                $personaldetails->jobseeker_email=$request->jobseeker_email;
                $personaldetails->jobseeker_email2=$request->jobseeker_email2;
                //return $personaldetails;
                //return "ok";
                $personaldetails->save();
                //refresh purpose for particular area of dashboard tab-pane
                return "#personal-tab";

                 break;
                 case 'cinfoupdate':
                     $items = applicationinfo::where('jobseeker_id',$jid)->get();
                     $item=$items[0];
                     $item->career_summary=$request->career_summary;
                     $item->special_qualification=$request->special_qualification;
                     $item->preferred_job_category=$request->preferred_job_category;
                     $item->preferred_district=$request->preferred_district;
                     $item->preferred_division=$request->preferred_division;
                     $item->preferred_organization_type=$request->preferred_organization_type;
                     $item->career_objective=$request->objective;
                     $item->lookingfor=$request->looking_for;
                     $item->availablefor=$request->available_for;
                     $item->presentsalary=$request->present_salary;
                     $item->expectedsalary=$request->expected_salary;
                     $item->save();

                 return "#personal-tab";
                 break;
                 case 'education_infoupdate':
                    $academics = new academic;
                    $academics->jobseeker_id            =$jid;
                    $academics->lavelofeducation_id     = $request->lavelofeducation_id;
                    $academics->groupormajor_id         = $request->groupormajor_id;
                    $academics->exam_title_id           = $request->exam_title_id;
                    $academics->result                  = $request->result;
                    $academics->marks                   = $request->marks;
                    $academics->institute               = $request->institute;
                    $academics->passing_year            = $request->passing_year;
                    $academics->duration                = $request->duration;
                    $academics->achievment              = $request->achievment;
                    $academics->save();
                    return 'Successfully Inserted';

                 break;
                case 'update_academic':
                 return $edit_academicdetails=DB::table('academics')->where('id',$request->edit_academicid)->get();
                 break;

                case 'education_editandupdate':
                //return 'abcd';
                    $academics=academic::where("id",$request->edit_academicid)->get();
                    //return $academics[0];
                    if (isset($request->lavelofeducation_id) && $request->lavelofeducation_id !=Null) {
                       $academics[0]->lavelofeducation_id     = $request->lavelofeducation_id;
                    }
                     if (isset($request->groupormajor_id) && $request->groupormajor_id !=Null) {
                       $academics[0]->groupormajor_id         = $request->groupormajor_id;
                    }
                    if (isset($request->exam_title_id) && $request->exam_title_id !=Null) {
                       $academics[0]->exam_title_id           = $request->exam_title_id;
                    }

                    $academics[0]->jobseeker_id            =$jid;
                    $academics[0]->result                  = $request->result;
                    $academics[0]->marks                   = $request->marks;
                    $academics[0]->institute               = $request->institute;
                    $academics[0]->passing_year            = $request->passing_year;
                    $academics[0]->duration                = $request->duration;
                    $academics[0]->achievment              = $request->achievment;
                    $academics[0]->save();
                    return 'Successfully Updated';
                break; 
                case 'skill_insert':
                        if(DB::table('specializations')->insert([
                                                    'jobseeker_id'=>$request->jobseeker_id,
                                                    'specializationorskill'=>$request->specializationorskill,
                                                    'skilldescription'=>$request->skilldescription,
                                                    ])){
                            return 'Succesfully Inserted';
                        };


                       # code...
                       break;  

                case 'skill_delete':
                   if(DB::table('specializations')->delete($request->delid)){
                    return "data deleted successfully";
                   }
                   break;
                case 'training_insert':
                if(DB::table('trainings')->insert([
                                                    'jobseeker_id'=>$jid,
                                                    'training_title'=>$request->training_title,
                                                    'topic'=>$request->topic,
                                                    'institute'=>$request->institute,
                                                    'location'=>$request->location,
                                                    'country'=>$request->country,
                                                    'year'=>$request->year,
                                                     'duration'=>$request->duration,
                                                    ])){
                            return 'Succesfully Inserted';
                    }
                   break;
                case 'training_delete':
                if(DB::table('trainings')->delete($request->delid)){
                    return "data deleted successfully";
                   }
                break;

                case 'refference_insert':
                    if(DB::table('js_references')->insert([
                            'jobseeker_id'=>$jid,
                            'reference_name'=>$request->reference_name,
                            'disignation' =>$request->disignation,
                            'organization' =>$request->organization,
                            'address' =>$request->address,
                            'office_phone' =>$request->office_phone,
                            'home_phone' =>$request->home_phone,
                            'mobile' =>$request->mobile,
                            'email' =>$request->email,
                            'relation' =>$request->relation,
                        ])){

                        return "data inserted successfully";
                    }
                    break;

                case 'refference_delete':
                    if(DB::table('js_references')->delete($request->delid)){
                    return "data deleted successfully";
                   }
                    break;
                
             default:
                 return 'no';
                 break;
         }
    }

    private function addNotification($id)
    {
        $notif=new notification;
        $notif->user_id=Auth::guard('jobseeker')->user()->id;
        $notif->message="Applied for job";
        $notif->job_id=$id;
        $notif->save();
    }
    private function getexamtitle(){
        return $getexamtitle=exam_title::pluck('name','id');
    }

    public function uploaddoc(Request $request)
    {
        $photos = [];
        
        foreach ($request->photos as $photo) {
            $path = $photo->store('/public/cv');
            $path=str_replace("public","storage",$path);

            $arr['path']=$path;
            $arr['name']=$photo->getClientOriginalName();
            $photos[] = $arr;
        }

        return response()->json(array('files' => $photos), 200);

    }

    public function updateProfileExp(Request $data)
    {
        $person = personaldetails::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get()->first();

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
        return redirect('/jobseeker/editprofile#ex_link_form');
    }

    public function test(Request $request)
    {
        $cv = new cv;
        $cv->path = "fe";
        $cv->displayname = "ds";
        $cv->mimetype = "few";
        $cv->person_id = 5;
        $cv->save();

        
        return "dd";
    }

    public function removeEducation(Request $data){
        $edu_id = $data->edu_id;
        $edu = Education::find($edu_id);
        $edu->delete();
        return response()->json(["id" => $edu_id], 200);
    }

    public function removeExperience(Request $data){
        $exp_id = $data->exp_id;
        $exp = Workexperience::find($exp_id);
        $exp->delete();
        return response()->json(["id" => $exp_id], 200);        
    }

    public function removeSkillset(Request $data){
        $skill_id = $data->skill_id;
        $skill = SkillSet::find($skill_id);
        $skill->delete();
        return response()->json(["id" => $skill_id], 200);        
    }
    
    
    public function addEducation(Request $data) {

        $edu = new Education;
        $edu->id = 0;

        $country=DB::table('country')->get();

        return view('jobseeker.education', ['edu' => $edu, 'country' => $country]);
    }

    public function addExperience(Request $data) {

        $exp = new Workexperience;
        $exp->id = 0;

        $country=DB::table('country')->get();

        return view('jobseeker.experience', ['exp' => $exp, 'country' => $country]);
    }

    public function addSkillset(Request $data) {

        $sk = new SkillSet;
        $sk->id = 0;

        return view('jobseeker.skillset', ['skillset' => $sk]);
    }

    public function updateEducations(Request $data)
    {
        $person = personaldetails::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get()->first();

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
            $redirecturl = '/jobseeker/editprofile#EducationHeader';
        }
        else {
            $redirecturl = '/jobseeker/editprofile#education_form_'.$edu_id;
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

    public function updateWorkexperience(Request $data)
    {
        $person = personaldetails::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get()->first();

        $exp_id = (int)$data->exp_id;

        $validator = Validator::make($data->all(), [
            'job_description' => "filled"
        ],[
            'job_description.filled' => 'Description is required!'
        ]);


        if($exp_id==0){
            $redirecturl = '/jobseeker/editprofile#ExperienceHeader';
        }
        else {
            $redirecturl = '/jobseeker/editprofile#expdiv'.$exp_id;
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

    public function updateSkillset(Request $data)
    {
        $person = personaldetails::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get()->first();

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
            return redirect('/jobseeker/editprofile#SkillsetHeader');
        }

        return redirect('/jobseeker/editprofile#skdiv_'.$skill_id);
    }

    // public function addcv(Request $data)
    // {
    //     $jobprofile=personaldetails::where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->get();

    //     $jobprofile=personaldetails::find($jobprofile[0]->id);
    //     $jobprofile->cv=$data->cv;
    //     $jobprofile->save();
    //     return redirect('/jobseeker/editprofile');
    // }

    // all save
    public function updateProfile(Request $data)
    {
        $jobprofile=personaldetails::where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->get()[0];

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
            'target_title' => 'required',
            'target_locations' => 'required',
            'target_salary' => 'required',
            'target_industry' => 'required',
            'target_career_level' => 'required',
            'target_notice_period' => 'required'
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
            'target_title.required' => 'Job Title is required!',
            'target_locations.required' => 'Job Locations are required!',
            'target_salary.required' => 'Monthly Salary is required!',
            'target_industry.required' => 'Job Industry is required!',
            'target_career_level.required' => 'Career Level is required!',
            'target_notice_period.required' => 'Notice Period is required!'
        ]);

        if ($validator->fails()) {
            return redirect('/jobseeker/editprofile#allerrorbag')
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
        return redirect('/jobseeker/editprofile');
    }

    public function updateProfileBasic(Request $data)
    {
                
        $jobprofile=personaldetails::where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->get()[0];

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
        return redirect('/jobseeker/editprofile#personal_detail_form');
    }

    public function updateTargetJob(Request $data)
    {
        $jobprofile=personaldetails::where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->get()[0];

        $jobprofile->target_tags='';
        $jobprofile->target_title=$data->target_title;
        $jobprofile->target_location=$data->target_locations;
        $jobprofile->target_salary=$data->target_salary;
        $jobprofile->target_industry=$data->target_industry;
        $jobprofile->target_career_level=$data->target_career_level;
        $jobprofile->target_notice_period=$data->target_notice_period;
        $jobprofile->target_objective=$data->target_objective;
        $jobprofile->target_employment_type=$data->target_employment_type;

        $jobprofile->save();
        return redirect('/jobseeker/editprofile#personal_target_job');
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

    public function updateimage(Request $data)
    {
        $jobprofile=personaldetails::where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->get();

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
        
		return response()->json(['path' => $jobprofile->profile_img], 200);
        
    }

    // must be in util
    public static function get_cityareas(){
        $cities = \App\CityArea::where('parent_id', 0)->get();

        $city_areas = array();

        foreach($cities as $city){
            $areas = CityArea::where('parent_id', $city->id)->get();
            array_push($city_areas, ["id" => $city->id, "name" => $city->name, "areas" => $areas->toArray()]);
        }

        return $city_areas;
    }
	
    public function editprofile()
    {
        // print_r(Auth::user()->id);
        // exit();
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
        ->where('jobseekers.id',Auth::guard('jobseeker')->user()->id)->get();

        $edu=Education::where("person_id", $jobs[0]->id)->get();

        $exp=Workexperience::where("person_id", $jobs[0]->id)->get();

        $skills=SkillSet::where("person_id", $jobs[0]->id)->get();

        $jtags = JobTag::all();


        $nedu = new Education();
        $nedu->id = 0;

        $nexp = new Workexperience();
        $nexp->id = 0;

        $nskill = new SkillSet();
        $nskill->id = 0;

        $cvs = cv::where("person_id", $jobs[0]->id)->get();

        return view('jobseeker.myprofile',compact('nedu','nexp','nskill','country','nationality','jobs','get_ind','division','exp','edu','visas','skills','cvs','jtags','city_areas'));
    }

    public function getProfile()
    {
		$jobprofile=personaldetails::where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->get()[0];
	
        $applied=DB::table('applied_jobs')->where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->get();
        $applied=count($applied);

        $accepted = DB::table('applied_jobs')->where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->where('status', 1)->get();
        $accepted = count($accepted);
    
        $myprofile= Auth::guard('jobseeker')->user();
        $total=Applied_job::where("jobseeker_id","=",Auth::guard('jobseeker')->user()->id)->count();

        $pageno=2;

        return view('jobseeker.settings',compact('total','applied','jobprofile','myprofile','pageno', 'accepted'));
    }

    public function changeAccountStatus()
	{
		$db=Jobseeker::find(Auth::guard('jobseeker')->user()->id);
        $db->delete();
        Auth::guard('jobseeker')->logout();

        
        return redirect('/jobseeker/login');
		//return redirect('/employer/managejobs/0');
	}


    
    public function myresume()
    {
        $jobprofile=personaldetails::where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->get()[0];

        if($jobprofile == null || $jobprofile->completed != 1) {
            return view('jobseeker.requireprofile');
        }
        
        $countryt=DB::table('country')->get();
        $country = [];
        foreach( $countryt as $cnt ){
            $country[$cnt->code] = $cnt->name;
        }

        $applied=DB::table('applied_jobs')->where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->get();
        $applied=count($applied);

        $accepted = DB::table('applied_jobs')->where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->where('status', 1)->get();
        $accepted = count($accepted);

        $notifications = notification::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->where('sender', 1)->orderBy('created_at', 'desc')->take(2)->get();

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

            if(CityArea::find($ti)->parent_id == 0)
                array_push($tagstr, str_replace("( City)", "", CityArea::find($ti)->name));
        }
        $jobprofile->target_locations = implode(", ", $tagstr);

        // $jobprofile->cv=json_decode($jobprofile->cv);
        // $edu=Education1::find(Auth::guard('jobseeker')->user()->id);
        // $edu->details=json_decode($edu->details);
        
        // $edu->degree=json_decode($edu->degree);

        // $exp=Workexperience1::find(Auth::guard('jobseeker')->user()->id);
        // $exp->experience=json_decode($exp->experience);
        $total=Applied_job::where("jobseeker_id","=",Auth::guard('jobseeker')->user()->id)->count();

        $enumDegrees = Constants::$enumDegrees;

        $pageno = 2;

        return view('jobseeker.resume',compact('total','notifications','applied','jobprofile','enumDegrees','country', 'pageno', 'accepted'));
    }

    public function saveresumepdf() {
        $countryt=DB::table('country')->get();
        $country = [];
        foreach( $countryt as $cnt ){
            $country[$cnt->code] = $cnt->name;
        }

        $applied=DB::table('applied_jobs')->where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->get();
        $applied=count($applied);

        $jobprofile=personaldetails::where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->get()[0];

        $jobprofile->jobseeker_dob = date_format(DateTime::createFromFormat('d/m/Y', $jobprofile->jobseeker_dob), "j F Y");
        
        $tagstr = [];
        foreach(explode(",", $jobprofile->target_tags) as $ti){
            if($ti == "") continue;
            array_push($tagstr, JobTag::find($ti)->job_tag);
        }
        $jobprofile->target_job_titles = implode(",", $tagstr);

        $tagstr = [];
        foreach(explode(",", $jobprofile->target_location) as $ti){
            if($ti == "") continue;
            array_push($tagstr, CityArea::find($ti)->name);
        }
        $jobprofile->target_locations = implode(",", $tagstr);

        $total=Applied_job::where("jobseeker_id","=",Auth::guard('jobseeker')->user()->id)->count();

        $enumDegrees = Constants::$enumDegrees;

        $pdf = PDF::loadView('jobseeker.resumepdf', compact('total','applied','jobprofile','enumDegrees','country'));
        $pdf->setPaper(array(0,0,1200,1600));

        return $pdf->download('resume.pdf');
    }

    public function setProfile(Request $request){
        Auth::guard('jobseeker')->user()->fb=$request['fb'];
        Auth::guard('jobseeker')->user()->linkedin=$request['linkedin'];
        Auth::guard('jobseeker')->user()->twitter=$request['twitter'];
        Auth::guard('jobseeker')->user()->email=$request['username'];
        //echo $request['username'];
        if($request['old'])
        {
        $pwd=bcrypt($request['old']);
        //echo Auth::guard('jobseeker')->user()->email;

        if(Hash::check($request['old'], Auth::guard('jobseeker')->user()->password))
        {
           // echo $request['new'];
            Auth::guard('jobseeker')->user()->password=bcrypt($request['new']);
           // echo Auth::guard('jobseeker')->user()->password;
        }

       
        
        else
        {
            return response()->json(array('err' => 'Old password does not match'), 400);
        }
}
      
       Auth::guard('jobseeker')->user()->save();
       return "true";
       
    }

    private function getgroup(){
        return $getexamtitle=DB::table('groupoormajors')->pluck('groupname','id');

    }






public function employerlist(){
    $jobseekerid= Auth::guard('jobseeker')->user()->id;
    $catagories=catagory::all();
    $company=empprofile::all();
     $block_id=block::where('jobseeker_id',$jobseekerid)->pluck('employer_id');
     $array=[];
    foreach($block_id as $block){
       array_push($array, $block);
    }

  


  
    // $a=[1,2,3];
    // if(in_array(2,$a)){
    //     return "true";
    // }
    // else{
    //     return "false";
    // }
    return view('jobseeker.companyname',compact('company','array','catagories'));

}

public function blockemp($id){
   $jobseekerid= Auth::guard('jobseeker')->user()->id;
    $block=new block;
    $block->jobseeker_id=$jobseekerid;
    $block->employer_id=$id;
    $block->save();
   
    return redirect('/jobseeker/blockEmployer');
}
public function unblockemp($id){
    //return $id;
    $jobseekerid= Auth::guard('jobseeker')->user()->id;
    $unblockid= block::where('jobseeker_id',$jobseekerid)->where('employer_id',$id)->pluck('id');
   //$block=new block;
  if(block::destroy($unblockid)){
 
    return redirect('/jobseeker/blockEmployer');
  }
}


public function femployerlist(){
    $jobseekerid= Auth::guard('jobseeker')->user()->id;
     $block_id=block::where('jobseeker_id',$jobseekerid)->pluck('employer_id');
    
    $catagories=catagory::all();
    $company=empprofile::whereNotIn('employer_id',$block_id)->get();
     $follow_id=follower::where('jobseeker_id',$jobseekerid)->pluck('employer_id');
     $array=[];
    foreach($follow_id as $follow){
       array_push($array, $follow);
}
    return view('jobseeker.followercompanyname',compact('company','array','catagories'));




}
public function followemp($id){

    $jobseekerid= Auth::guard('jobseeker')->user()->id;
    $follow=new follower;
    $follow->jobseeker_id=$jobseekerid;
    $follow->employer_id=$id;
    $follow->save();
 return redirect('/jobseeker/followEmployer');
}


public function unfollowemp($id){

   $jobseekerid= Auth::guard('jobseeker')->user()->id;
    $unfollowid= follower::where('jobseeker_id',$jobseekerid)->where('employer_id',$id)->pluck('id');

  if(follower::destroy($unfollowid)){
 
    return redirect('/jobseeker/followEmployer');
  }
}



//Academic Data..........
private function getacademic($id){
    $academicData = DB::table('academics')->where('jobseeker_id',$id)->get();
    return $academicData;

}

private function getLevelName($levelId){
    return $levelname = DB::table('levelofeducations')->where('id',$levelId)->pluck('edulavelname');
}



private function getmajorname($majorid){
    $majorname = DB::table('groupoormajors')->where('id',$majorid)->pluck('groupname');
    if(count($majorname)>0){
        return $majorname;
    }else{
        return FALSE;
    }
}


private function getexamName($examId){
    return $examName = DB::table('exam_titles')->where('id',$examId)->pluck('name');
}

// Get skill info

private function get_skill($jobseeker_id)
{
    $get_skill = DB::table('specializations')->where('jobseeker_id',$jobseeker_id)->get();
    if (count($get_skill)>0) {
        return $get_skill;
    }else{
        return FALSE;
    }
}


private function get_training_info($jobseeker_id){
 $get_training = DB::table('trainings')->where('jobseeker_id',$jobseeker_id)->get();
    if (count($get_training )>0) {
        return $get_training;
    }else{
        return FALSE;
    }


}

private function get_refference_info($jobseeker_id){
 $get_refference = DB::table('js_references')->where('jobseeker_id',$jobseeker_id)->get();
    if (count($get_refference )>0) {
        return $get_refference;
    }else{
        return FALSE;
    }


}


    //upload profile image
    public function jobseeker_img_upload(Request $request)
    {
        $ida=Auth::guard('jobseeker')->user()->id;
        $jobsekker = personaldetails::where('jobseeker_id',$ida)->get();

        $request->file('profile_image');
        $extension=$request->profile_image->extension();
        //return $extension;
        $unique_image=$ida.".".$extension;
        //return $unique_image;
       //  if($jobsekker->profile_img)
       // {
       //     storage::delete('public/jobseeker_img/'.$jobsekker->profile_img);
       //       //return 'echo';
      
       //  }
        

        $request->profile_image->storeAs('/public/jobseeker_img',$unique_image);
        $jobsekker[0]->profile_img = $unique_image;
        $jobsekker[0]->save();
    }

    

    //upload certificates file
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

    //update certificates file
    public function edu_certfile_update(Request $request)
    {
        $certificate = Certificate::find($request->cert_id);

        Storage::disk('public')->delete(str_replace("storage/", "", $certificate->path));

        $path = $request->certfile->store('/public/certificate');
        $path = str_replace("public","storage",$path);

        $certificate->path = $path;
        $certificate->displayname = $request->certfile->getClientOriginalName();
        $certificate->mimetype = $request->certfile->getClientMimeType();
        $certificate->save();

        $html = view('jobseeker.certificate', ['cert' => $certificate])->render();

        return response()->json(['viewdata' => $html, 'cert_id'=> $certificate->id], 200);        
    }

    //remove certificates file
    public function edu_certfile_remove(Request $request)
    {
        $certificate = Certificate::find($request->cert_id);

        Storage::disk('public')->delete(str_replace("storage/", "", $certificate->path));

        $certificate->delete();

        return response()->json(["id" => $request->cert_id], 200);
    }

    //add cv file
    public function addcv(Request $request)
    {
        $person = personaldetails::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get()->first();

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

    //update cv file
    public function updatecv(Request $request)
    {
        $cv = cv::find($request->cv_id);

        Storage::disk('public')->delete(str_replace("storage/", "", $cv->path));

        $path = $request->cvfile->store('/public/cv');
        $path = str_replace("public","storage",$path);

        $cv->path = $path;
        $cv->displayname = $request->cvfile->getClientOriginalName();
        $cv->mimetype = $request->cvfile->getClientMimeType();
        $cv->save();

        $html = view('jobseeker.cv', ['cv' => $cv])->render();

        return response()->json(['viewdata' => $html, 'cv_id'=> $cv->id], 200);        
    }

    //remove cv file
    public function removecv(Request $request)
    {
        $cv = cv::find($request->cv_id);

        Storage::disk('public')->delete(str_replace("storage/", "", $cv->path));

        $cv->delete();

        return response()->json(["id" => $request->cv_id], 200);
    }

    // extra activities
    private function extraActivities($jobseekerId){
       // $jobseekerId = Auth::guard('jobseeker')->user()->id;
        $extraActivities = extraactivities::where('jobseeker_id', $jobseekerId)->get();
        if(count($extraActivities)>0){
        $array = explode(',', $extraActivities[0]->details);
        return $array;
    }
  }

    public function resetPasswordManually(Request $request)
    {
        $jobseeker = Auth::guard('jobseeker')->user();
        $email      =  $jobseeker->email;
        $request->email = $email;
        $oldpassword   = $request->oldpassword;

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator, 'password');
        }
        
        if (Hash::check($oldpassword, $jobseeker->password)) {
            // Success
            $jobseeker->password = Hash::make($request->password);//Encrypt the password
            $jobseeker->save();
            $request->password = $jobseeker->password;
            return redirect('/jobseeker/login');
        }
        else{
            $errors = new MessageBag();

            // add your error messages:
            $errors->add('password', 'Current password is invalid!');

            return back()->withErrors($errors, 'password');
        }
    }

    public function resetEmailManually(Request $request)
    {

        $validator = Validator::make($request->all(), [
             'email' => 'required|email|max:255|unique:jobseekers',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator, 'email');
        }

        $jobseeker = Auth::guard('jobseeker')->user();
        
        $jobseeker->email = $request->email;
        $jobseeker->verifyToken = uniqid();
        $jobseeker->save();

        Mail::to($jobseeker->email)->send(new verifyEmail($jobseeker));
        return redirect('/jobseeker/sentverifymail');
    }

    public function checkvacancy($id){
        if(!Auth::guard('jobseeker')->check()){
            return response('', 404);
        }

        $job = job::find($id);
        $hasFilter = $job->quest_location_req == 1 || $job->quest_exp_req == 1 || $job->quest_salary_req == 1 || $job->quest_language_req == 1
            || $job->quest_min_edu_req == 1 || $job->quest_license_req == 1;

        $jobprofile = personaldetails::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get()[0];
        if($jobprofile->completed==0){
            return response()->json(array('able' => 2), 200);
        }
        else{
            return response()->json(array('able' => 1, 'hasFilter' => $hasFilter), 200);
        }
    }

    public function deleteNotification($id)
    {
        $notif=notification::find($id);
        $notif->delete();
        return redirect('jobseeker/notifications');
    }
}
