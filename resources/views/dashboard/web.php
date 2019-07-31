<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contaigns the "web" middleware group. Now create something great!
|

*/

Route::get('/findjob','myController@index');
Route::post('/upl','myController@uploadimage');


Route::get('/createConversation/{js}','myController@createConversation');
//homepage search

Route::get('search', 'myController@homepage_search');
Route::get('search', 'myController@filter');

Route::get('addMessage', 'myController@addMessage');
Route::get('broadcastMessage', 'myController@broadcastMessage');
Route::get('getMessage/{id}', 'myController@getMessage');
Route::get('employerInbox', 'myController@employerInbox');

Route::get('jsInbox', 'myController@filter');
Route::get('createConversation', 'myController@filter');

// Auth::routes();
Route::get('category/{id}','myController@get_job_by_cat');
Route::get('showdetails/{id}','myController@jobsdescription');
Route::get('relatedJobs/','myController@relatedJobs');
Route::get('apply/{id}','jobseekerController@apply');

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'employer','middleware' => ['logEmployer','logGuest']], function () {
          Route::get('/deleteNotification/{id}','jobController@deleteNotification');

          Route::get('/login', 'EmployerAuth\LoginController@showLoginForm');
          Route::post('/login', 'EmployerAuth\LoginController@login');
          Route::post('/logout', 'EmployerAuth\LoginController@logout');
          Route::get('/message/{convid}', 'myController@empInbox');
          Route::get('/register', 'EmployerAuth\RegisterController@showRegistrationForm');
          Route::post('/register', 'EmployerAuth\RegisterController@register');
          Route::get('notifications/','jobController@getNotifications');

          Route::post('candidatessearch/{status}','jobController@candidatesfilter');

          Route::get('/pausestatus/{id}','jobController@pausestatus');
          Route::get('/closestatus/{id}','jobController@closestatus');
          Route::get('/activestatus/{id}','jobController@activestatus');
          Route::get('/changeCandidatestatus/{id}/{status}','jobController@changeCandidatestatus');
          Route::get('getAllCandidates/{id?}','jobController@getAllCandidates');
          Route::get('changeAccountStatus','jobController@changeAccountStatus');
          Route::get('/settings','employerController@settings')->name('employerController');
          Route::post('/savesettings', 'employerController@savesettings');
          Route::post('/setProfile', 'employerController@setProfile');
          Route::get('/jobdetails/{id}/{jsid}','jobController@jobdetails');
          Route::get('invites/{id}','JobController@getinvites');
          Route::get('/changestatus/{id}','jobController@changestatus');
          Route::post('/password/email', 'EmployerAuth\ForgotPasswordController@sendResetLinkEmail');
          Route::post('/password/reset', 'EmployerAuth\ResetPasswordController@reset');
          Route::get('/password/reset', 'EmployerAuth\ForgotPasswordController@showLinkRequestForm');
          Route::get('/password/reset/{token}', 'EmployerAuth\ResetPasswordController@showResetForm');
          //Route::get('/{slug}', 'employerController@show');
          Route::get('/profile/{id}', 'employerController@show');
          Route::get('managejobs','jobController@managejobs');
          Route::get('/getCandidateInfo/{id}', 'jobseekerController@getCandidateInfo');
          Route::get('edit_jobs','jobController@job_edit');
          Route::get('getCandidates/{id}/{status?}','jobController@getCandidates');
          Route::get('invite/{jobid}/{jsid}','jobController@invite');
          Route::get('save_edit_jobs','jobController@edit_job_employer_dashboard');
          Route::get('postajob','jobController@post_a_job');
          
          Route::get('editajob/{id}','jobController@edit_a_job');
          Route::post('edit_post_job','jobController@edit_post_job');

          Route::get('postjob','jobController@post_job');
          Route::get('postjobpublish','jobController@post_job_publish');
          Route::post('postjobquestion','jobController@post_job_question');

          Route::post('updateimage','employerController@updateimage');
          Route::get('showjob','jobController@show_job_on_emp_dashboard');
          Route::get('delete_job','jobController@delte_job_employer_dashboard');
          Route::get('update_status','jobController@update_status');
          Route::get('apllied_job','emp_applied_job_controller@applied_job');
          Route::get('/', 'jobController@managejobs');

          //tariqul 
          Route::get('details', 'jobController@showJobDetails');

          Route::get('/cv/{id}', 'emphomeController@applicantcv');
          Route::get('/cv/{id}/{jobid?}', 'emphomeController@applicantcv');
          Route::get('editprofile','employerController@editprofile');
 
          //message 
          Route::get('inbox','messageController@empInbox')->middleware('employer');
          Route::get('sent','messageController@empSent')->middleware('employer');
          Route::get('draft','messageController@empDraft')->middleware('employer');
          Route::get('Trash','messageController@empTrash')->middleware('employer');
          Route::get('newmessage','messageController@empCreateNewMessage')->middleware('employer');
          Route::get('sendmessage','messageController@sendMessage')->middleware('employer');
          Route::post('getAppliedJobseekerList','messageController@getAppliedJobseekerList')->middleware('employer');
          Route::post('messageoption','messageController@empmessageOption')->middleware('employer');
          Route::get('replay','messageController@EmpreplayMessage')->middleware('employer');
          Route::get('/applicantlist/{id?}', 'emphomeController@applicant_list');
          Route::post('shorted_list', 'emp_applied_job_controller@shorlisted_candidate');

          //assistant 
          Route::get('registerassis','AssistController@showRegistrationForm')->middleware('employer');
          Route::post('registerassis/create','AssistController@create')->middleware('employer');
          Route::get('/{id}/login','assistLoginController@showLoginForm');
          Route::post('/assist/login','assistLoginController@login');
          Route::post('/email/resetmanually', 'employerController@resetEmailManually');
          Route::post('/password/resetmanually', 'employerController@resetPasswordManually');

          Route::get('/sentverifymail', function(){
            return view('employer.auth.sentverifymail');
          });
});
Route::get('/contactus', 'myController@contactus');
Route::get('/about', 'myController@about');
Route::get('/', 'myController@indexpage');
Route::get('/jsimage/{id}', 'myController@jsimage');
Route::get('/empimage/{id}', 'myController@empimage');

Route::post('/contact', 'myController@contact');

Route::group(['prefix' => 'jobseeker'], function () {
          Route::get('/deleteNotification/{id}','jobseekerController@deleteNotification');

  
          Route::get('/login', 'JobseekerAuth\LoginController@showLoginForm');
          Route::post('/login', 'JobseekerAuth\LoginController@login');
          Route::post('/logout', 'JobseekerAuth\LoginController@logout');

          Route::get('/register', 'JobseekerAuth\RegisterController@showRegistrationForm');
          Route::post('/register', 'JobseekerAuth\RegisterController@register');

          Route::get('/sentverifymail', function(){
            return view('jobseeker.auth.sentverifymail');
          });

          Route::get('changeAccountStatus','jobseekerController@changeAccountStatus');

          Route::post('/password/email', 'JobseekerAuth\ForgotPasswordController@sendResetLinkEmail');
          Route::post('/password/reset', 'JobseekerAuth\ResetPasswordController@reset');
          Route::get('/password/reset', 'JobseekerAuth\ForgotPasswordController@showLinkRequestForm');
          Route::get('/password/reset/{token}', 'JobseekerAuth\ResetPasswordController@showResetForm');

          Route::post('/password/resetmanually', 'jobseekerController@resetPasswordManually');
          Route::post('/email/resetmanually', 'jobseekerController@resetEmailManually');
          
          Route::get('/editprofile', 'jobseekerController@editprofile');

          
          // all profile data save
          Route::get('/updateProfile', 'jobseekerController@updateProfile');


          Route::post('/updateProfileBasic', 'jobseekerController@updateProfileBasic');
          Route::post('/updateTargetJob', 'jobseekerController@updateTargetJob');  

          Route::post('/updateEducation', 'jobseekerController@updateEducations');
          Route::get('/removeEducation', 'jobseekerController@removeEducation');
          Route::get('/addEducation', 'jobseekerController@addEducation');


          Route::post('/updateExperience', 'jobseekerController@updateWorkexperience');
          Route::get('/addExperience', 'jobseekerController@addExperience');
          Route::get('/removeExperience', 'jobseekerController@removeExperience');

          Route::get('/removeSkillset', 'jobseekerController@removeSkillset');
          Route::get('/addSkillset', 'jobseekerController@addSkillset');
          Route::post('/updateSkillset', 'jobseekerController@updateSkillset');


          Route::get('/deletemyaccount', 'jobseekerController@deletemyaccount');


          Route::get('/test', 'jobseekerController@test');



          Route::post('/uploaddoc', 'jobseekerController@uploaddoc');
          Route::post('/addcv', 'jobseekerController@addcv');
          Route::post('/updatecv', 'jobseekerController@updatecv');
          Route::get('/removecv', 'jobseekerController@removecv');
          Route::get('/message/{convid}', 'myController@jsInbox');
          Route::post('/updateProfileExp', 'jobseekerController@updateProfileExp');
          Route::get('personal', function() {
              return view('jobseeker.personal');
          });
          Route::get('personal_details', function() {
              return view('jobseeker.home');
          });

          Route::get('/','jobseekerController@editprofile')->name('jshome');

        // Route::get('/','alljobsController@index')->name('jshome');
          Route::get('/getProfile','jobseekerController@getProfile')->name('getProfile');
          Route::post('/setProfile','jobseekerController@setProfile')->name('setProfile');


          Route::get('/addNotification','jobseekerController@addNotification')->name('addNotification');

          
          Route::get('/showjobs/{id}','alljobsController@show');
          Route::get('/managejobs/{id?}','alljobsController@getmyjobs');
          Route::get('/myresume', 'jobseekerController@myresume');
          Route::get('/resumepdf', 'jobseekerController@saveresumepdf');

          Route::get('/resume/edit', 'jobseekerController@index');
          Route::put('infoupdate','jobseekerController@infoupdate');

          Route::get('/alljobsshow/{id}','alljobsController@jobsdescription');
          Route::get('/apply','alljobsController@applyjob');
          Route::post('/apply','alljobsController@applywithquestions');

          Route::get('/notifications','alljobsController@notifications');

          Route::get('/blockEmployer','jobseekerController@employerlist');
          Route::get('/block/{id}','jobseekerController@blockemp');
          Route::get('/unblock/{id}','jobseekerController@unblockemp');

          Route::get('/followEmployer','jobseekerController@femployerlist');
          Route::get('/follow/{id}','jobseekerController@followemp');
          Route::get('/unfollow/{id}','jobseekerController@unfollowemp');

          Route::get('cv','cvController@cv');
          Route::post('imageupload','jobseekerController@jobseeker_img_upload');

          Route::get('uloadingcv','uploadingCvController@uploadingPage');
          Route::post('cvUpload','uploadingCvController@cvUpload');
          Route::get('showuploadedcv','uploadingCvController@showuploadedcv');
          Route::get('createcvdoc','uploadingCvController@createDoc');

          Route::post('updateimage','jobseekerController@updateimage');

          Route::post('updatecertfile','jobseekerController@edu_certfile_update');
          Route::post('addcertfile','jobseekerController@edu_certfile_add');
          Route::get('removecertfile','jobseekerController@edu_certfile_remove');

          Route::get('inbox','messageController@jsInbox')->middleware('jobseeker');
          Route::get('sent','messageController@empSent')->middleware('jobseeker');
          Route::get('draft','messageController@empDraft')->middleware('jobseeker');
          Route::get('Trash','messageController@empTrash')->middleware('jobseeker');
          Route::get('newmessage','messageController@empCreateNewMessage')->middleware('jobseeker');
          Route::get('sendmessage','messageController@sendMessage')->middleware('jobseeker');

          Route::post('messageoption','messageController@jsmessageOption')->middleware('jobseeker');
          Route::get('replay','messageController@jsmessageReplay')->middleware('jobseeker');
          Route::get('portofolio/{id}','portfolioController@index');
          Route::post('porto/contact','portfolioController@contact_me');
          Route::get('checkvacancy/{id}', 'jobseekerController@checkvacancy');
});


Route::get('resume', function () {
    return view('employer.resume');
});

Route::resource('editemployer','employerController');


Route::get('/showdata','show_proofile_controller@showdata');

Route::post('/uploadimage','show_proofile_controller@getimage');


Route::get('jobseeker/home', function() {
      return redirect(url('jobseeker/login'));
  })->name('joslogin');


  
  Route::get('relation',function(){
    return view('employer.employer');
  });



  // Ajax request route
  Route::get('ajax/district', 'jobController@return_district_by_division_id');


//admin panel

Route::group(['prefix' => 'inspector'], function () {
		     Route::get('/employerdetail/{emp}','Inspector\employerController@employerDetails');
            Route::get('/editempsettings/{emp}','Inspector\employerController@changeEmpdetails');
            Route::post('/savedetails','Inspector\employerController@saveDetails');
            Route::post('/changeemail','Inspector\employerController@changeEmail');
            Route::get('/deleteaccount/{emp}','Inspector\employerController@DeleteAccount');
            Route::get('/jobposts/{emp}','Inspector\employerController@getJobposts');
           // Route::get('/jobposts/{emp}','Inspector\EmployerController@getJobposts');
            Route::get('/pausestatus/{emp}','Inspector\employerController@pausestatus');
            Route::get('/activestatus/{emp}','Inspector\employerController@activestatus');
            Route::get('/editajob/{emp}','Inspector\employerController@editajob');
            Route::get('/closestatus/{emp}','Inspector\employerController@closestatus');
            Route::get('/jobdetails/{emp}/{id}/{jsid}','Inspector\employerController@jobdetails');
            Route::post('edit_post_job','Inspector\EmployerController@posteditajob');
            Route::get('/getAllCandidates/{emp}',function ($id){
                return redirect(url('inspector/getAllCandidates/'.$id.'/0'));
            });
            Route::get('/getAllCandidates/{emp}/{status}','Inspector\employerController@getallcandidate');
            Route::get('/emp/message/{emp}/{convid}','Inspector\employerController@getempMessage');
            Route::get('/emp/password/resetmanually' ,'Inspector\employerController@postResetpassword');
            Route::get('/changestatus/{emp}',function ($id){
                $empchange = Employer::find($id);
                if ($empchange->status==1)
                {
                    $empchange->status =0;
                    $empchange->save();
                }else {
                    $empchange->status=1;
                    $empchange->save();
                }
                return redirect(url('/inspector/employerdetail/'.$id));
            });
            Route::get('/changeCandidatestatus/','Inspector\employerController@changeCandidatestatus');
            Route::get('/jbs/getProfile/{jbs}','Inspector\employerController@getProfile');
            Route::get('/jbs/getresume/{jbs}','Inspector\employerController@getResume');
            Route::post('/jbs/updateimage/','Inspector\employerController@changeimage');
            Route::get('/jbs/removeimage/{jbs}','Inspector\employerController@removeimage');
            Route::post('/jbs/changeemail/','Inspector\employerController@changjbseemail');
            Route::get('/jbs/deleteaccount/{emp}','Inspector\employerController@deletejbsaccount');
            Route::post('/jbs/resetpassword','Inspector\employerController@postjbsresetpassword');
            Route::get('/jbs/editresume/{emp}','Inspector\employerController@editresume');
            Route::post('/jbs/editresume/postbasicedit','Inspector\employerController@updateprofilebasic');
            Route::post('/jbs/editresume/postupdatetargetkob','Inspector\employerController@updateTargetJob');
            Route::get('/jbs/jobs/{jbs}/{id}','Inspector\employerController@getjbsjobs');
            Route::get('/jbs/message/{emp}/{id}','Inspector\employerController@getjbsMessage');
            Route::get('/jobseekerlist','Inspector\employerController@jobseekerlist');//dashboard category list page
            Route::get('/notifications','Inspector\employerController@getNotifications1');
            Route::get('/notifications/detail','Inspector\employerController@getNotificationDetail');
            Route::get('/approvejbs/{emp}','Inspector\employerController@approvejbs');
            Route::get('/rejectjbs/{emp}','Inspector\employerController@rejectjbs');
            Route::get('/employerdetails/{emp}','Inspector\employerController@getEmpnotification');
            Route::get('/jobseekerdetails/{emp}','Inspector\employerController@getjbsnotification');
            Route::get('/approveemp/{emp}','Inspector\employerController@getapproveemp');
            Route::get('/rejectemp/{emp}','Inspector\employerController@getrejectemp');
            Route::get('/contactform','Inspector\employerController@getcontactform');
            Route::get('/deletecontactform/{emp}','Inspector\employerController@getdeletecontactform');
            Route::get('/settings','Inspector\employerController@getsettings');
            Route::get('/addadmin','Inspector\employerController@getaddadmin');
            Route::post('/addadmin','Inspector\employerController@postaddadmin');
            Route::get('/editadmin/{emp}','Inspector\employerController@geteditadmin');
            Route::post('/editadmin','Inspector\employerController@posteditadmin');
            Route::get('/','Inspector\employerController@joblist');
            Route::get('joblist','Inspector\employerController@joblist');//dashboard category list page
            Route::get('employerlist','Inspector\employerController@employerlist');//dashboard category list page
            Route::get('/postdetails/{id}', 'Inspector\employerController@postdetail');
            Route::get('dashboard', 'Inspector\employerController@dashboard');
            Route::get('revenue','Inspector\employerController@revenue');








    Route::get('/empty',function (){
                $user = Auth::guard('inspector')->user();
                $pri = $user->Privilege()->all();
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
                 return view('dashboard/empty');
            });






    //end Bradly's change
		  
          Route::get('/login', 'InspectorAuth\LoginController@showLoginForm');
          Route::post('/login', 'InspectorAuth\LoginController@login');
          Route::post('/logout', 'InspectorAuth\LoginController@logout');

          Route::get('/register', 'InspectorAuth\RegisterController@showRegistrationForm');
          Route::post('/register', 'InspectorAuth\RegisterController@register');

          Route::post('/password/email', 'InspectorAuth\ForgotPasswordController@sendResetLinkEmail');
          Route::post('/password/reset', 'InspectorAuth\ResetPasswordController@reset');
          Route::get('/password/reset', 'InspectorAuth\ForgotPasswordController@showLinkRequestForm');
          Route::get('/password/reset/{token}', 'InspectorAuth\ResetPasswordController@showResetForm');
            
            Route::get('publicoption','Inspector\PublicOption@publicoption');//educatin lavel  search

            Route::get('getAllCandidates/{emp}/{id?}','Inspector\DashboardController@getAllCandidates');

         // Route::get('/','Inspector\DashboardController@joblist');
          Route::get('editprofile/{id}','Inspector\DashboardController@editprofile');
          Route::post('/updateimage','Inspector\DashboardController@updateimage');
            /* Edit the job by employer*/
          Route::get('editajob/{id}','Inspector\DashboardController@edit_a_job');
          Route::post('edit_post_job','Inspector\DashboardController@edit_post_job');
          
          Route::post('/updateProfileBasic', 'Inspector\DashboardController@updateProfileBasic');
          Route::post('/updateEducation', 'Inspector\DashboardController@updateEducations');
          Route::post('/updateProfileExp', 'Inspector\DashboardController@updateProfileExp');

          Route::post('/addcv', 'Inspector\DashboardController@addcv');
          Route::get('/createConversation/{emp}/{js}','Inspector\DashboardController@createConversation');

          Route::post('addMessage', 'Inspector\DashboardController@addMessage');
        Route::get('getMessage/{id}', 'Inspector\DashboardController@getMessage');
        Route::get('message/{id}', 'Inspector\DashboardController@empInbox');
        Route::get('jsmessage/{id}', 'Inspector\DashboardController@jsInbox');
        Route::get('postdetails/{id}/{cd}', 'Inspector\DashboardController@postdetails');
        //Route::get('notifications', 'Inspector\DashboardController@notifications');

        Route::get('viewapplied/{id}/{jid?}', 'Inspector\DashboardController@viewapplied');
        Route::get('dashboard', 'Inspector\DashboardController@dashboard');
          Route::get('/myresume/{id}', 'Inspector\DashboardController@myresume');
          Route::get('getCandidates/{emp}/{id}/{status?}','Inspector\DashboardController@getCandidates');
          Route::get('/markspam/{id}/{status}', 'Inspector\DashboardController@spam');


          //category manage start....
          Route::get('category','Inspector\CategoryController@index');//dashboard category list page
          Route::post('managecategory','Inspector\CategoryController@managecategory');//dashboard category crud page
          Route::get('catsearch','Inspector\CategoryController@catsearch');//dashboard category search page
          //category manage end....

          //industrytype manage start....
          Route::get('industrytype','Inspector\IndustryTypeController@index');//dashboard industrytype list page
          Route::post('manageindustrytype','Inspector\IndustryTypeController@manageindustrytype');//dasboard industrytype crud page
          Route::get('industrysearch','Inspector\IndustryTypeController@industrysearch');//dashboard industrytype search page
          //industrytype manage end....

          //manage jobseeker using admin dashboard start........
          Route::get('jobseeker','Inspector\JobseekerController@index');//dashboard jobseeker list
          Route::post('managejobseeker','inspector\JobseekerController@managejobseeker');//dashboard jobseeker manage crud,status,view......
          Route::get('jobseekersearch','inspector\JobseekerController@jobseekersearch');//dashboard jobseeker search......


          //Route::get('joblist','Inspector\DashboardController@joblist');//dashboard category list page
         // Route::get('employerlist','Inspector\DashboardController@employerlist');//dashboard category list page
          //Route::get('/employerdetail/{id}', 'Inspector\DashboardController@employerdetail');
          
          Route::get('/changestatus', 'Inspector\DashboardController@changestatus');

          Route::get('/jobdetail/{emp}/{id}', 'Inspector\DashboardController@jobdetail');
          Route::get('/jobdescription/{emp}/{id}', 'Inspector\DashboardController@jobdescription');

          Route::get('candidatelist','Inspector\DashboardController@candidatelist');//dashboard category list page
          Route::get('candidatesettings/{id}','Inspector\DashboardController@candidatesettings');//dashboard category list page
          Route::post('/savejobseekersettings', 'Inspector\DashboardController@savejobseekersettings');
          
          Route::get('/employersettings/{id}','Inspector\DashboardController@employersettings')->name('employerController');
          Route::post('/saveemployersettings', 'Inspector\DashboardController@saveemployersettings');

          Route::get('/getProfile/{id}','Inspector\DashboardController@candidatesettings')->name('candidatesettings');
          Route::post('/updateempimage', 'Inspector\DashboardController@updateempimage');
          

          //manage jobseeker using admin dashboard end........

          //manage employer using admin dashboard start........
        Route::get('employer','Inspector\EmployerCon@index');//dashboard employer list
        Route::post('manageemployer','Inspector\EmployerCon@manageemployer');//dashboard employer manage crud,status,view......
        Route::get('employersearch','Inspector\EmployerCon@employersearch');//dashboard employer search......
        //manage employer using admin dashboard end.....

        //country division district and area management start
        Route::get('location','Inspector\LocationManagement@index');//present country list
        Route::post('managecountry','Inspector\LocationManagement@managecountry');//country crud 
        Route::get('countrysearch','Inspector\LocationManagement@countrysearch');//dashboard country search page


        Route::get('divisionlist','Inspector\LocationManagement@divisionlist');//present division list

        Route::post('managedivision','Inspector\LocationManagement@managedivision');//division crud
        Route::get('divisionsearch','Inspector\LocationManagement@divisionsearch');//dashboard division search page

        Route::get('districtlist','Inspector\LocationManagement@districtlist');//present disrtrict list
        Route::get('districtsearch','Inspector\LocationManagement@districtsearch');//dashboard division search page
        Route::post('managedistrict','Inspector\LocationManagement@managedistrict');//district crud


        Route::get('arealist','Inspector\LocationManagement@arealist');//present area list
        Route::post('managearea','Inspector\LocationManagement@managearea');// area crud
        Route::get('areasearch','Inspector\LocationManagement@areasearch');// area search

        Route::get('showcountry','Inspector\onchangeController@showcountry');//on change using for cdda it can used by other routes...

        Route::get('showlevelofeducation','Inspector\onchangeController@showlevelofeducation');//on change using for cdda it can used by other

        // routes...
        //country division district and area management end

        Route::get('levelofeducation','Inspector\Manageeducationcontroller@index');//present education lavel list
        Route::post('managelevelofeducation','Inspector\Manageeducationcontroller@managelevelofeducation');//educatin lavel  crud 
        Route::get('manedusearch','Inspector\Manageeducationcontroller@manedusearch');//educatin lavel  search

        Route::get('examtitle','Inspector\Manageeducationcontroller@examtitlelist');//present education lavel list
        Route::post('manageexam','Inspector\Manageeducationcontroller@manageexam');//educatin lavel  crud 
        Route::get('examtitlesearch','Inspector\Manageeducationcontroller@examtitlesearch');//educatin lavel  search

        Route::get('groupormajors','Inspector\Manageeducationcontroller@groupormajorlist');//present education lavel list
        Route::post('managegroupormajor','Inspector\Manageeducationcontroller@managegroupormajor');//educatin lavel  crud 
        Route::get('groupormajorsearch','Inspector\Manageeducationcontroller@groupormajorsearch');//educatin lavel  search

        Route::get('publicoption','Inspector\PublicOption@publicoption');//educatin lavel  search

        //::::::::::::::job publicity  section start ::::::::::::::::::::::
        Route::get('job','Inspector\JobManagement@job_index');
        Route::get('job_published','Inspector\JobManagement@jobpublshed');
        Route::get('publishedjob','Inspector\JobManagement@job_all_published');
        Route::get('trashjob','Inspector\JobManagement@trashjob');
        Route::get('view_posted_job/{id}','Inspector\JobManagement@posted_job_index');
        Route::get('view_published_job/{id}','Inspector\JobManagement@published_job_index');//educatin lavel  search
        Route::get('view_trashed_job/{id}','Inspector\JobManagement@trashed_job_index');


        //theme option start
        Route::get('managetheme','Inspector\themeoptionController@index');
        Route::post('managethemeall','Inspector\themeoptionController@managetheme');
        //theme option end
});


//email verification
Route::get('sendVerifymail/{email}/{token}','JobseekerAuth\RegisterController@SendMailDone')->name('SendMailDone');
Route::get('sendEVerifymail/{email}/{token}','EmployerAuth\RegisterController@SendMailDone')->name('SendEMailDone');
Route::group(['prefix' => 'assist'], function () {
          Route::get('/login', 'AssistAuth\LoginController@showLoginForm');
          Route::post('/login', 'AssistAuth\LoginController@login');
          Route::post('/logout', 'AssistAuth\LoginController@logout');

          Route::get('employer/assistregister', 'AssistAuth\RegisterController@showRegistrationForm');
          Route::post('/register', 'AssistAuth\RegisterController@register');

          Route::post('/password/email', 'AssistAuth\ForgotPasswordController@sendResetLinkEmail');
          Route::post('/password/reset', 'AssistAuth\ResetPasswordController@reset');
          Route::get('/password/reset', 'AssistAuth\ForgotPasswordController@showLinkRequestForm');
          Route::get('/password/reset/{token}', 'AssistAuth\ResetPasswordController@showResetForm');
});

//online check

Route::get('setonline','IsOnlineController@IsOnline');
Route::get('getAllonlineUser','IsOnlineController@checkAllonlineUser');

//public home statastics
Route::get('public/statastics','myController@public_stastics');
// Contact Page
Route::get('contact','support@index');
Route::get('contact_message','support@sendSupportMessage');