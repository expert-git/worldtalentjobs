<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\country;
use App\division;
use App\district;
use App\area;
use App\empprofile;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Mail\verifyEEmailForChange;

class employerController  extends Controller
{
    public function __construct()
    {
        $this->middleware('employer');
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $country=(country::pluck('name','id'));
       $division=(division::pluck('name','id'));
       $district=(district::pluck('name','id'));
       $area=(area::pluck('name','id'));

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function editProfile()
    {
		$ida = Auth::guard('employer')->user()->id;
		//district::find(1)->area;
        $myprofile = empprofile::where('employer_id',$ida)->get();
        $myprofile=$myprofile[0];
        print_r($myprofile);
        return view('employer.editprofile',compact('myprofile'));
    }


    public function savesettings(Request $data)
    {
        $employerid = Auth::guard('employer')->user()->id;
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
        $settings->ContactPhone=$data->ContactPhone;
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
        return redirect('/employer/settings');

    }

    public function resetEmailManually(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'email' => 'required|email|max:255|unique:employers',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator, 'email');
        }

        $employer = Auth::guard('employer')->user();
        $employer->verifyToken = uniqid();
        $employer->save();

        Mail::to($request->email)->send(new verifyEEmailForChange($employer, $request->email));

        return redirect('/employer/sentverifymail');
    }

    public function resetPasswordManually(Request $request)
    {
        $employer = Auth::guard('employer')->user();
        $email      =  $employer->email;
        $request->email = $email;
        $oldpassword   = $request->old;

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator, 'password');
        }
        
        if (Hash::check($oldpassword, $employer->password)) {
            // Success
            $employer->password = Hash::make($request->password);//Encrypt the password
            $employer->save();
            $request->password = $employer->password;
            return back();
        }
        else{
            $errors = new MessageBag();

            // add your error messages:
            $errors->add('password', 'Current password is invalid!');

            return back()->withErrors($errors, 'password');
        }
    }

    public function setProfile(Request $request)
    {
        $settings=empprofile::find($request->id);
         if($request['old'])
        {
        $pwd=bcrypt($request['old']);
       // echo Auth::guard('jobseeker')->user()->email;

        if(Hash::check($request['old'], Auth::guard('employer')->user()->password))
        {
           // echo $request['new'];
            Auth::guard('employer')->user()->password=bcrypt($request['new']);
           // echo Auth::guard('employer')->user()->password;
        }

       
        
        else
        {
            return response()->json(array('err' => 'Old password does not match'), 400);
        }
}
$settings->save();
        return "true";
    }


    public function settings()
    {
        $country=DB::table('country')->get();
        // $division=DB::table('divisions')->get();
        $cityareas=DB::table('city_areas')->get();
        $myprofile = empprofile::where('employer_id',Auth::guard('employer')->user()->id)->get();
		$myprofile=$myprofile[0];
        //

        $clss=3;
        $pageno=5;

        $nowFormat = date('Y-m-d');
		$ida = Auth::guard('employer')->user()->id;
		// $alljobs=DB::table('jobs')->where('employer_id',$ida)->count();
        // $active = DB::table('jobs')->where('employer_id',$ida)->where('deadline','>',$nowFormat)->where('delete_status',0)->count();
        $alljobs = DB::table('jobs')->where([['employer_id', $ida], ['published',1]])->count();
        $active = DB::table('jobs')->where([['employer_id', $ida], ['published',1]])->where('deadline', '>=', $nowFormat)->where('status', 0)->count();
		
        $emp=empprofile::find(Auth::guard('employer')->user()->id);
        if($emp->websiteaddress != "") {
            $strs = explode("//", $emp->websiteaddress);
            $emp->proto = $strs[0];
            $emp->websiteaddress = $strs[1];
        }
        if($emp->fb != "") {
            $strs = explode("//", $emp->fb);
            $emp->protofb = $strs[0];
            $emp->fb = $strs[1];
        }
        if($emp->twitter != "") {
            $strs = explode("//", $emp->twitter);
            $emp->prototwitter = $strs[0];
            $emp->twitter = $strs[1];
        }
        if($emp->linkedin != "") {
            $strs = explode("//", $emp->linkedin);
            $emp->protolinkedin = $strs[0];
            $emp->linkedin = $strs[1];
        }
        $industries=DB::table('industrytypes')->get();

        return view('employer.settings',compact('clss','alljobs','active','myprofile','emp','country','cityareas','industries','pageno'));
    }


    public function updateimage(Request $data)
    {
        

        $jobprofile=empprofile::find(Auth::guard('employer')->user()->id);
        // Storage::disk('public')->delete(str_replace("storage/", "", $jobprofile->companylogo));
        // Storage::disk('public')->delete($jobprofile->companylogo);
        if($data->hasFile('avatar'))
        {
            $path = $data->file('avatar')->store('/public/profile');
            $path=str_replace("public","storage",$path);
            $jobprofile->companylogo=$path;
        }
        $jobprofile->save();
		return response()->json(['path' => $jobprofile->companylogo], 200);
        // return redirect('/employer/settings');
    }

    public function removeimage(Request $data)
    {
        $jobprofile=empprofile::find(Auth::guard('employer')->user()->id);
        $jobprofile->companylogo="";
        $jobprofile->save();
        return response()->json(['path' => ''], 200);
    }

    public function show($id)
    {
        $ida = Auth::guard('employer')->user()->id;

            //country::find(1)->division;
            //division::find(1)->district;
            //district::find(1)->area;
            $data = empprofile::where('employer_id',$ida)->get();
            //return dump($data[0]->country);
            if ($data[0]->division && $data[0]->country && $data[0]->district) {
                $empdeses=empprofile::join('countries','empprofiles.country','countries.id')->join('divisions','empprofiles.division','divisions.id')->join('areas','empprofiles.area','areas.id')->join('districts','empprofiles.district','districts.id')->select('empprofiles.*','countries.name As cname','divisions.name As dname','districts.name As disname','areas.name As aname')->where('empprofiles.employer_id',$ida)->get();
            }
            elseif ($data[0]->division && $data[0]->country) {
                 $empdeses=empprofile::join('countries','empprofiles.country','countries.id')->join('divisions','empprofiles.division','divisions.id')->select('empprofiles.*','countries.name As cname','divisions.name As dname','districts.name As disname')->where('empprofiles.employer_id',$ida)->get();
            }
            elseif($data[0]->country) {
                $empdeses=empprofile::join('countries','empprofiles.country','countries.id')->select('empprofiles.*','countries.name As cname')->where('empprofiles.employer_id',$ida)->get();
            }else
            {
                if(empprofile::where('employer_id',$ida)->get()){
                    $empdeses = empprofile::where('employer_id',$ida)->get();
                }else{
                    return 'abc';
                };
            }
            

      $empdes = $empdeses[0];
       isset($empdes->industrytype)?$industrytype = explode(',', $empdes->industrytype):NULL;
       $country=(country::pluck('name','id'));
       $division=(division::pluck('name','id'));
       $district=(district::pluck('name','id'));
       $area=(area::pluck('name','id'));
       //return $empdes;

      return view('employer.resume',compact('empdes','country','division','district','area','industrytype'));
       //return $empdes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {  
      

        if($request->ajax())
        {
            $frff = empprofile::where('employer_id',$id)->get();
            $empprofile=$frff[0];
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
                $empprofile->industrytype=implode(',',$request->industrytype);
                //return $industrytype;
                $empprofile->save();
                    
                    break;
                
                case 'primaryaddress':
                    $empprofile->companyaddress=$request->Companyaddress;
                    $empprofile->country=$request->country;
                    $empprofile->division=$request->division;
                    $empprofile->district=$request->district;
                    $empprofile->area=$request->area;
                    $empprofile->billingaddress=$request->BillingAddress;
                    $empprofile->ContactPhone=$request->ContactPhone;
                    $empprofile->ContactEmail=$request->ContactEmail;
                    $empprofile->websiteaddress=$request->WebsiteAddress;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function updateorcreate(request $r,$id){
         //empprofile::updateOrCreate(['id'=>2,'employer_id'=>$id,'companyname'=>'emon']);
       return "success";
    }
}
