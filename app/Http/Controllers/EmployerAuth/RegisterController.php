<?php

namespace App\Http\Controllers\EmployerAuth;

use App\Inspector;
use DB;
use App\Employer;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Mail;
use App\Mail\welcomeEmail;
use App\empprofile;
use App\division;
use App\Mail\verifyEEmail;
use App\Mail\approveEEmail;
use App\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/employer/sentverifymail';
    // protected $redirectTo = '/employer/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('employer.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       /* unset($data['companyname']);
        unset($data['ContactPhone']);
        unset($data['location']);

        unset($data['area']);

        unset($data['username']);

        unset($data['position']);

        print_r($data);
*/
        return Validator::make($data, [
            // 'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:employers',
            'password' => 'required|min:6|confirmed',
            // 'companyname'=>'required|max:100',
            // 'ContactPhone'=>'required|max:100',
            // 'location'=>'required|max:100',
            // 'area'=>'required|max:100',
            // 'position'=>'required|max:100'
        ]);
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

//        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Employer
     */
    protected function create(array $data)
    {
        $employer =  Employer::create([
            // 'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verifyToken'=>Str::random(40),
            'status' => 2,
        ]);

        $user = User::create();
        $employer->user()->save($user);

        $thisUser = Employer::findOrFail($employer->id);
        $empprofile=empprofile::find($employer->id);
        if($empprofile==null){
            $empprofile = new empprofile;
            $empprofile->employer_id = $employer->id;
            $empprofile->save();
        }
        $empprofile->employer_id=$employer->id;

        $empprofile->companyname=$data['companyname'];
        $empprofile->companylogo=$data['company_logo'];
        $empprofile->fname=$data['fname'];
        $empprofile->lname=$data['lname'];
        $empprofile->position=$data['position'];
        $empprofile->ContactPhone=$data['ContactPhone'];
        $empprofile->ContactEmail=$data['email'];
        $empprofile->industrytype=$data['industry'];
        $empprofile->city=$data['location'];
        $empprofile->area=$data['area'];
        $empprofile->update();
        
        Mail::send('Email.requestRegister', ['employer' => $thisUser], function ($m) use ($thisUser) {
            $m->from($thisUser->email, $thisUser->name);
      
            $m->to("worldtalentjobs@gmail.com", "WorldTalentJobs")->subject('Someone registered!');
        });

        $this->SendMail($thisUser);

        return $employer;
    }

    protected function SendMail($thiUser)
    {
        // Mail::to($thiUser['email'])->send(new welcomeEmail($thiUser));
        Mail::to($thiUser['email'])->send(new verifyEEmail($thiUser));
       // exit;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $cityareas=\App\CityArea::all();
        $industries=DB::table('industrytypes')->get();

        return view('employer.auth.register',compact('cityareas', 'industries'));
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('employer');
    }

    public function sendEVerifymail($email,$verifyToken)
    {
        $check = Employer::where('email',$email)->where('verifyToken',$verifyToken)->first();
        if ($check) {
            Employer::where('email',$email)->where('verifyToken',$verifyToken)->update(['status'=>3,'verifyToken'=>'']);

            $ins_list = Inspector::all();
            foreach ($ins_list as $ins) {
                Mail::to($ins['email'])->send(new approveEEmail($check));
            }

            return redirect(url('/employer/waitforapproval'));
        }
    }

    public function sendEMailDone($email,$verifyToken)
    {
        $check = Employer::where('email',$email)->where('verifyToken',$verifyToken)->first();
        if ($check) {
            Employer::where('email',$email)->where('verifyToken',$verifyToken)->update(['status'=>1,'verifyToken'=>'']);
            return redirect(url('/employer/login'));
        }
    }
}
