<?php namespace App\Http\Controllers;
use App\Events\MessageArrivedFromEmployer;
use App\CityArea;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use DB;
use App\catagory;
use App\job;
use App\Applied_job;
use Auth;
use App\Employer;
use App\Jobseeker;
use App\contactu;
use App\conversation;
use App\message;
use Mail;
use App\empprofile;
use App\personaldetails;
use App\division;
use App\Http\Controllers\jobseekerController;
use App\Utils\Utils;
use App\employmenttype;
use Pusher\Pusher;
use Validator;


class myController extends Controller {

  public $pusher;

  public function __construct(){
    $options = array(
      'cluster' => 'ap3',
      'useTLS' => true
    );
    $this->pusher = new Pusher(
      '7fb56899b7aed2daa104',
      'e1de327858d58a49ccd5',
      '754406',
      $options
    );
  }
  
  public function jsimage($id) {
    $notice=personaldetails::where('jobseeker_id', $id)->get();
    $notice=$notice[0]->profile_img;
    return redirect("/".$notice);
  }

  public function empimage($id) {
    $notice=empprofile::find($id);
    //        return  Image::make("/".$notice->companylogo)->response();

    return redirect("/".$notice->companylogo);

  }

  public function index() {
    // $jobs=$this->getJobs();

    // $portal_option=$this->public_option();

    // $category=$this->get_category();

    // $division=$this->get_division();

    $city_areas=jobseekerController::get_cityareas();

    // $jobseekerlist=$this->getJobseekerList();
    // $divisions=$this->get_divisions();

    // $employerList=$this->empprofilesList();

    // $homenotice=$this->homepage_notice();

    // $catagorys=$this->get_categorys();
    //return $this->countCategoryWiseJob();

    $get_ind=$this->get_industrytype();
    $pic=$this->particular_count_industrytype();

    $catagorysWiseJobcount=$this->countCategoryWiseJob();
    $get_cats=$this->categorysForCountJob();

    // $hotjobs=$this->hotJobs();
    // $recemtJobs=$this->recemtJobs();

    $theme='public';
    // print_r($catagorys);

    // $populjobs=$this->popularjobs();

    // return view('public.'.$theme, compact('portal_option', 'divisions', 'jobs', 'category', 'division', 'jobseekerlist', 'employerList', 'catagorys', 'catagorysWiseJobcount', 'get_cats', 'hotjobs', 'recemtJobs', 'populjobs', 'homenotice', 'city_areas'));
    return view('public.'.$theme, compact('catagorysWiseJobcount', 'get_cats', 'city_areas', 'get_ind', 'pic'));
  }


  //     return view('public.'.$theme,compact('portal_option','jobs','category','division','jobseekerlist','employerList','catagorys','catagorysWiseJobcount','get_cats','hotjobs','recemtJobs'));
  // }

  // retrive homepage notice
  private function homepage_notice() {
    $notice=DB::table('notice')->where('status', '1')->get();

    if (count($notice)>0) {
      return $notice;
    }

    else {
      return $notice=['not found'];
    }
  }

  private function popularjobs() {
    $jobs=DB::table('applied_jobs')->join('jobs', 'applied_jobs.job_id', 'jobs.id')->join('empprofiles', 'empprofiles.employer_id', 'applied_jobs.employer_id')->join('catagories', 'catagories.id', 'jobs.catagory_id')->join('divisions', 'divisions.id', 'jobs.division_id')->select('applied_jobs.job_id', 'jobs.*', 'empprofiles.companyname', 'empprofiles.companylogo', 'empprofiles.companyaddress', 'catagories.catagoryname', 'divisions.name as div_name', DB::raw('COUNT(*) AS jobcount'))->where('jobs.published', '1')->where('jobs.delete_status', '0')->GROUPBY('applied_jobs.job_id')->orderBy('jobcount', 'desc')->get();
    $popularjobs=count($jobs)>0?$jobs: false;

    return $popularjobs;
  }

  private function getJobs() {
    $jobs=DB::table('jobs')->join('divisions', 'divisions.id', 'jobs.division_id')->join('districts', 'districts.id', 'jobs.district_id')->select('jobs.*', 'divisions.name as div_name', 'districts.name')->where('published', '1')->orderBy('id', 'desc')->get();
    // $jobs=DB::table('jobs')->join('divisions', 'divisions.id', 'jobs.division_id')->join('districts', 'districts.id', 'jobs.district_id')->select('jobs.*', 'divisions.name as div_name', 'districts.name')->where('published', '1')->orderBy('id', 'desc')->get();
    return $jobs;
  }

  //hotjobs................
  private function hotJobs() {
    $jobs=DB::table('jobs')->join('empprofiles', 'jobs.employer_id', 'empprofiles.employer_id')->join('divisions', 'divisions.id', 'jobs.division_id')->join('catagories', 'jobs.catagory_id', '=', 'catagories.id')->select('jobs.*', 'empprofiles.companyname', 'empprofiles.companylogo', 'divisions.name as div_name', 'catagoryname as catname')->where('published', 1)->orderBy('jobs.vacancies', 'desc')->take('5')->get();
    return $jobs;
  }

  //recentjob................
  private function recemtJobs() {
    $jobs=DB::table('jobs')->join('empprofiles', 'empprofiles.employer_id', 'jobs.employer_id')->join('divisions', 'divisions.id', 'jobs.division_id')->join('catagories', 'jobs.catagory_id', '=', 'catagories.id')->select('jobs.*', 'empprofiles.companyname', 'empprofiles.companylogo', 'divisions.name as div_name', 'catagoryname as catname')->where('published', 1)->orderBy('jobs.id', 'desc')->take('5')->get();
    return $jobs;
  }




  private function public_option() {
    // get all option
    $portal_option=DB::table('public_options') ->where('status', '1') ->pluck('option_value', 'option_name') ->all();

    if (count($portal_option)>0) {
      return $portal_option;
    }

    else {
      return $portal_option=['message'=>'No Public Option Found'];
    }
  }

  private function get_category() {
    $category=DB::table('catagories')->pluck('catagoryname', 'id');

    if(count($category)>0) {
      return $category;
    }

    else {
      return $category=['message'=>'No Category Found'];
    }
  }

  private function get_categorys() {
    $category=DB::table('catagories')->select('catagoryname', 'id')->get();

    if(count($category)>0) {
      $individulalPart=ceil(count($category)/3);
      $catfirst=DB::table('catagories')->select('catagoryname', 'id')->take($individulalPart)->get();

      $catfirstskip=count($catfirst);
      $catsecond=DB::table('catagories')->select('catagoryname', 'id')->skip($catfirstskip)->take($individulalPart)->get();

      $skipcatsecond=count($catsecond)+$catfirstskip;
      $catthird=DB::table('catagories')->select('catagoryname', 'id')->skip($skipcatsecond)->take($individulalPart)->get();
      return $allcat=[$catfirst,
      $catsecond,
      $catthird];
    }

    else {
      return false;
    }

  }

  private function get_division() {
    $country=DB::table('countries')->where('name', 'Qatar')->pluck('id');
    $division=DB::table('divisions')->where('country_id', $country)->pluck('name', 'id');
    return $division;

    if(count($division)>0) {
      return $division;
    }

    else {
      return $division=['message'=>'No Division Found'];
    }
  }

  //search result 
  public function homepage_search(Request $search_item) {
    $keyword=$search_item->keyword;
    $search_division=$search_item->search_division;
    $search_category=$search_item->search_category;

    if($search_division==""&& $search_category=="") {
      $searchableQuery=DB::table('jobs')->join('empprofiles', 'empprofiles.employer_id', 'jobs.employer_id')->join('divisions', 'divisions.id', 'jobs.division_id')->select('jobs.*', 'empprofiles.companyname', 'divisions.name as div_name')->where('jobtitle', 'like', $keyword.'%')->where('published', 1)->orderby('jobs.featured','DESC')->orderby('jobs.data_featured','DESC')->orderBy('jobs.id', 'desc')->paginate(10);

      $searchableQuerycount=DB::table('jobs')->join('empprofiles', 'empprofiles.employer_id', 'jobs.employer_id')->join('divisions', 'divisions.id', 'jobs.division_id')->select('jobs.*', 'empprofiles.companyname', 'divisions.name as div_name')->where('jobtitle', 'like', $keyword.'%')->where('published', 1)->orderby('jobs.featured','DESC')->orderby('jobs.data_featured','DESC')->orderBy('jobs.id', 'desc')->get();


      $countPrimarySearch=count($searchableQuerycount);
    }

    elseif($search_category=="") {
      $searchableQuery=DB::table('jobs')->join('empprofiles', 'empprofiles.employer_id', 'jobs.employer_id')->join('divisions', 'divisions.id', 'jobs.division_id')->select('jobs.*', 'empprofiles.companyname', 'divisions.name as div_name')->where('jobtitle', 'like', $keyword.'%')->where('division_id', $search_division)->where('published', 1)->orderby('jobs.featured','DESC')->orderby('jobs.data_featured','DESC')->orderBy('jobs.id', 'desc')->paginate(10);

      $searchableQuerycount=DB::table('jobs')->join('empprofiles', 'empprofiles.employer_id', 'jobs.employer_id')->join('divisions', 'divisions.id', 'jobs.division_id')->select('jobs.*', 'empprofiles.companyname', 'divisions.name as div_name')->where('jobtitle', 'like', $keyword.'%')->where('division_id', $search_division)->where('published', 1)->orderby('jobs.featured','DESC')->orderby('jobs.data_featured','DESC')->orderBy('jobs.id', 'desc')->get();




      $searchableQuerycount=count($searchableQuerycount);



    }

    elseif($search_division=="") {
      $searchableQuery=DB::table('jobs')->join('empprofiles', 'empprofiles.employer_id', 'jobs.employer_id')->join('divisions', 'divisions.id', 'jobs.division_id')->select('jobs.*', 'empprofiles.companyname', 'divisions.name as div_name')->where('jobtitle', 'like', $keyword.'%')->where('catagory_id', $search_category)->where('published', 1)->orderby('jobs.featured','DESC')->orderby('jobs.data_featured','DESC')->orderBy('jobs.id', 'desc')->paginate(10);

      $searchableQuerycount=DB::table('jobs')->join('empprofiles', 'empprofiles.employer_id', 'jobs.employer_id')->join('divisions', 'divisions.id', 'jobs.division_id')->select('jobs.*', 'empprofiles.companyname', 'divisions.name as div_name')->where('jobtitle', 'like', $keyword.'%')->where('catagory_id', $search_category)->where('published', 1)->orderby('jobs.featured','DESC')->orderby('jobs.data_featured','DESC')->orderBy('jobs.id', 'desc')->get();




      $countPrimarySearch=count($searchableQuerycount);


    }

    else {
      $searchableQuery=DB::table('jobs')->join('empprofiles', 'empprofiles.employer_id', 'jobs.employer_id')->join('divisions', 'divisions.id', 'jobs.division_id')->select('jobs.*', 'empprofiles.companyname', 'divisions.name as div_name')->where('jobtitle', 'like', $keyword.'%')->where('division_id', $search_division)->where('catagory_id', $search_category)->where('published', 1)->orderby('jobs.featured','DESC')->orderby('jobs.data_featured','DESC')->orderBy('jobs.id', 'desc')->paginate(10);

      $searchableQuerycount=DB::table('jobs')->join('empprofiles', 'empprofiles.employer_id', 'jobs.employer_id')->join('divisions', 'divisions.id', 'jobs.division_id')->select('jobs.*', 'empprofiles.companyname', 'divisions.name as div_name')->where('jobtitle', 'like', $keyword.'%')->where('division_id', $search_division)->where('catagory_id', $search_category)->where('published', 1)->orderby('jobs.featured','DESC')->orderby('jobs.data_featured','DESC')->orderBy('jobs.id', 'desc')->get();


      $countPrimarySearch=count($searchableQuerycount);

    }




    $category=$this->get_category();

    $division=$this->get_division();
    $divisions=$this->get_divisions();
    $count_by_div=$this->count_jobs_by_divisionwise();
    $countCategoryWiseJob=$this->countCategoryWiseJob();

    $categorysForCountJob=$this->categorysForCountJob();

    $get_ind=$this->get_industrytype();
    $pic=$this->particular_count_industrytype();

    $todays_job=$this->todays_job();

    $two_days_agos_job=$this->two_days_agos_job();
    $seven_days_agos_job=$this->seven_days_agos_job();
    $last_months_job=$this->last_months_job();
    $companyName=$this->companyiesForCountJob();
    $countCompanyWiseJob=$this->countCompanyWiseJob();
    $jobtypecount=$this->jobtypecount();
    $catMachingName=$this->catMachingName();
    $locMachingName=$this->locMachingName();

    //return  dump($jobs);
    $theme=$this->selecttheme();

    if($theme=='newblue') {
      return view('public.search3', compact("searchableQuery", 'category', 'division', 'count_by_div', 'divisions', 'pic', 'get_ind', 'countCategoryWiseJob', 'categorysForCountJob', 'todays_job', 'two_days_agos_job', 'seven_days_agos_job', 'last_months_job', 'companyName', 'countCompanyWiseJob', 'jobtypecount', 'countPrimarySearch', 'catMachingName', 'locMachingName'));
    }

    else {

      //return  dump($jobs);
      return view('public.search2', compact("searchableQuery", 'category', 'division', 'count_by_div', 'divisions', 'pic', 'get_ind', 'countCategoryWiseJob', 'categorysForCountJob', 'todays_job', 'two_days_agos_job', 'seven_days_agos_job', 'last_months_job', 'companyName', 'countCompanyWiseJob', 'jobtypecount', 'countPrimarySearch', 'catMachingName', 'locMachingName'));
    }


  }

  // get all divisions
  private function get_divisions() {
    // $alldiv=DB::table('divisions')->orderBy('parent', 'id')->get();
    $alldiv=DB::table('city_areas')->orderBy('parent_id', 'id')->get();
    return $alldiv;
  }

  //count jobs by divisionwise
  private function count_jobs_by_divisionwise() {
    // $count=DB::table('jobs')->select('division_id',DB::raw('COUNT(*) as num_jobs, GROUP_CONCAT(id) AS jobnum'))->groupBy('division_id')->get();

    // $users = DB::table('users')
    //                      ->select(DB::raw('count(*) as user_count, status'))
    //                      ->where('status', '<>', 1)
    //                      ->groupBy('status')
    //                      ->get();

    // $count=

    $counts=[];

    $city_areas=Utils::get_cityareas();

    foreach(Utils::get_cityareas() as $c) {
      $counts[$c['id']]=$this->get_num_of_rows_by_citywise_job($c['id']);
      foreach($c['areas'] as $a) {
        $counts[$a['id']]=$this->get_num_of_rows_by_areawise_job($a['id']);
      }
    }

    return $counts;
  }

  //get area wise job count.......
  private function get_num_of_rows_by_areawise_job($id) {

    $divcount=DB::table('jobs')->where('area_id', $id)->where('published', 1)->get();
    return count($divcount);
  }

  //get city wise job count.......
  private function get_num_of_rows_by_citywise_job($id) {

    $divcount=DB::table('jobs')->where('city_id', $id)->where('published', 1)->get();
    return count($divcount);
  }

  // start get all industry type----





  private function get_industrytype() {
    $get_industrytype=DB::table('industrytypes')->get();
    return $get_industrytype;

  }

  private function count_industrytypesjob($id) {
    $count_industrytypesjob=DB::table('jobs')->where('industrytype_id', $id)->where('published', 1)->get();
    return count($count_industrytypesjob);

  }

  private function particular_count_industrytype() {
    $array=[];

    foreach($this->get_industrytype() as $i) {
      $array[$i->id]=$this->count_industrytypesjob($i->id);
    }

    return $array;

  }

  // end all industry type----


  //get all catagory-----------



  private function countCategoryWiseJob() {
    $categorys=$this->categorysForCountJob();

    $array=array();

    foreach ($categorys as $cat) {
      $array[$cat->id]=$this->countCatJob($cat->id);
    }


    return $array;

  }

  private function categorysForCountJob() {
    $cat=DB::table('catagories')->get();
    return $cat;
  }

  private function countCatJob($id) {
    $catCount=DB::table('jobs')->where('catagory_id', $id)->where('published', '1')->get();
    return count($catCount);
  }


  //end all category----------

  //start companywise search

  private function countCompanyWiseJob() {
    $companyName=$this->companyiesForCountJob();

    $array=array();

    foreach ($companyName as $com) {
      $array[$com->id]=$this->countComJob($com->id);
    }


    return $array;

  }

  private function companyiesForCountJob() {
    $company=DB::table('empprofiles')->get();
    return $company;
  }

  private function countComJob($id) {
    $countComJob=DB::table('jobs')->where('employer_id', $id)->where('published', '1')->get();
    return count($countComJob);
  }


  //end companywise search
  //all datewise filterable jobs------------------------
  private function todays_job() {
    $today=Carbon::today();
    $tomorrow=Carbon::tomorrow();
    $today_j=DB::table('jobs')->where('published', 1)->whereBetween('created_at', array($today, $tomorrow))->get();
    return count($today_j);
  }

  private function thisweek_job() {
    $start=date("Y-m-d", strtotime('monday this week'));
    $end=date("Y-m-d", strtotime('sunday this week'));
    $week_j=DB::select("select * from jobs where published=1 and date(created_at) >= ':start' and date(created_at) <= ':end'", ['start' => $start, 'end' => $end]);
    return $week_j;
  }

  private function thismonth_job() {
    $now = Carbon::now();
    $month=$now->month;
    $year=$now->year;
    $month_j=DB::table('jobs')->where('published', 1)->whereRaw('month(created_at)', $month)->whereRaw('year(created_at)', $year)->get();
    return $month_j;
  }

  private function two_days_agos_job() {
    $today=Carbon::today();
    $two_days_ago=$today->subDays(2);
    $current_date=Carbon::today();

    $six_days_ago=$current_date->subDays(6);

    //return $six_days_ago;
    $two_days_agos_job=job::where('published', 1)->whereBetween('created_at', array($two_days_ago, carbon::today()))->get();
    return count($two_days_agos_job);
  }

  private function seven_days_agos_job() {
    $today=Carbon::today();
    $sevendays_ago=$today->subDays(7);




    $seven_days_agos_job=job::where('published', 1)->whereBetween('created_at', array($sevendays_ago, carbon::today()))->get();

    return count($seven_days_agos_job);
  }

  private function last_months_job() {
    $today=Carbon::today();

    $thirty_days_ago=$today->subDays(30);

    $last_months_job=DB::table('jobs')->where('published', 1)->whereBetween('created_at', array($thirty_days_ago, carbon::today()))->get();
    return count($last_months_job);
  }


  //all datewise filterable jobs end------------------------

  //all jobtype filterable jobs start----------------
  public function jobtypecount() {
    $etypes = employmenttype::all();

    $e_jobs = [];
    foreach($etypes as $et){
      $e_jobs[$et->id]=DB::table('jobs')->where('published', '1')->where('employment_type', $et->name)->count();
    }
    return $e_jobs;

  }


  // private function salaryRangeCount(){
  //     $firstgrade=DB::table('jobs')->where('published','1')->whereBetween('salaryrange',array(0,24999))->get();
  //     $countFirstgrade=count($firstgrade);
  //      $scndgrade=DB::table('jobs')->where('published','1')->whereBetween('salaryrange',array(25000,49999))->get();
  //     $countScndgrade=count($scndgrade);
  //      $thirdgrade=DB::table('jobs')->where('published','1')->whereBetween('salaryrange',array(50000,99999))->get();
  //     $countThirdgrade=count($thirdgrade);
  //      $fourthgrade=DB::table('jobs')->where('published','1')->where('salaryrange','>=','100000')->get();
  //     $countFourthgrade=count($fourthgrade);
  //     return array($countFirstgrade,$countScndgrade,$countThirdgrade,$countFourthgrade);
  // }







  //all jobtype filterable jobs end----------------

  //necessary funciton for showing search message

  public function catMachingName() {

    $matchingName=[];
    $catformatchingname=DB::table('catagories')->get();

    foreach($catformatchingname as $catmatch) {
      $matchingName[$catmatch->id]=$catmatch->catagoryname;
    }

    return $matchingName;
  }

  public function locMachingName() {

    $matchingName=[];
    $locformatchingname=DB::table('divisions')->get();

    foreach($locformatchingname as $locmatch) {
      $matchingName[$locmatch->id]=$locmatch->name;
    }

    return $matchingName;
  }

  public function industryMachingName() {

    $matchingName=[];
    $industryformatchingname=DB::table('industrytypes')->get();

    foreach($industryformatchingname as $industrymatch) {
      $matchingName[$industrymatch->id]=$industrymatch->industrytypename;
    }

    return $matchingName;
  }








  //get job seeker list 
  private function getJobseekerList() {
    $jobseekerList=DB::table('personaldetails')->orderBy('id', 'desc')->limit(20) ->get();

    if (count($jobseekerList)>0) {
      return $jobseekerList;

    }

    else {
      return FALSE;
    }
  }

  //get job seeker list 
  private function empprofilesList() {
    $empprofilesList=DB::table('empprofiles')->orderBy('id', 'desc')->limit(20) ->get();

    if (count($empprofilesList)>0) {
      return $empprofilesList;

    }

    else {
      return FALSE;
    }
  }

  public function get_job_by_cat($id) {
    // $catjobs=DB::table('jobs') ->join('empprofiles', 'empprofiles.employer_id', 'jobs.employer_id')->join('city_areas', 'jobs.division_id', 'divisions.id')->select('jobs.*', 'empprofiles.companyname', 'empprofiles.companylogo', 'divisions.name as divnmae') ->where('catagory_id', $id) ->where('published', 1)->paginate(10);
    $catjobs=DB::table('jobs')->join('empprofiles', 'empprofiles.employer_id', 'jobs.employer_id')->join('city_areas', 'jobs.area_id', 'city_areas.id')->select('jobs.*', 'empprofiles.companyname', 'empprofiles.companylogo', 'city_areas.name as divnmae') ->where('industrytype_id', $id) ->where('published', 1)->orderby('jobs.featured','DESC')->orderby('jobs.data_featured','DESC')->orderBy('jobs.id')->paginate(20);
    //  print_r(($catjobs));
    $category_select = [];
    $category_select[$id] = 1;

    if(count($catjobs)>0) {
      //return dump($catjobs);

      $category=$this->get_category();

      $division=$this->get_division();
      $divisions=$this->get_divisions();
      $city_areas=Utils::get_cityareas();
      $count_by_div=$this->count_jobs_by_divisionwise();
      $countCategoryWiseJob=$this->countCategoryWiseJob();

      $categorysForCountJob=$this->categorysForCountJob();

      $get_ind=$this->get_industrytype();
      $pic=$this->particular_count_industrytype();

      $todays_job=$this->todays_job();
      // $thisweek_job=$this->thisweek_job();
      // $thismonth_job=$this->thismonth_job();


      $two_days_agos_job=$this->two_days_agos_job();
      $seven_days_agos_job=$this->seven_days_agos_job();
      $last_months_job=$this->last_months_job();
      $companyName=$this->companyiesForCountJob();
      $countCompanyWiseJob=$this->countCompanyWiseJob();

      $etypes = employmenttype::all();
      $jobtypecount=$this->jobtypecount();
      $catMachingName=$this->catMachingName();
      $locMachingName=$this->locMachingName();

      // return view('public.category_wise_job', compact('catjobs', 'category', 'division', 'divisions', 'count_by_div', 'countCategoryWiseJob', 'categorysForCountJob', 'get_ind', 'pic', 'todays_job', 'two_days_agos_job', 'seven_days_agos_job', 'last_months_job', 'companyName', 'countCompanyWiseJob', 'jobtypecount', 'catMachingName', 'locMachingName', 'relatedJobs', 'title', 'relatedJobsCount'));
      return view('public.category_wise_job', compact('catjobs', 'category', 'division', 'divisions', 'count_by_div', 'countCategoryWiseJob', 'categorysForCountJob', 'get_ind', 'pic', 'todays_job', 'two_days_agos_job', 'seven_days_agos_job', 'last_months_job', 'companyName', 'countCompanyWiseJob', 'jobtypecount', 'catMachingName', 'locMachingName', 'city_areas', 'etypes', 'category_select'));

    }

    else {

      return redirect('findjob');
      // return false;
    }

  }

  public function filter(Request $r) {
    $division=$this->get_division();
    $divisions=$this->get_divisions();
    $city_areas=Utils::get_cityareas();
    $count_by_div=$this->count_jobs_by_divisionwise();
    $countCategoryWiseJob=$this->countCategoryWiseJob();

    $categorysForCountJob=$this->categorysForCountJob();

    $get_ind=$this->get_industrytype();
    $pic=$this->particular_count_industrytype();

    $todays_job=$this->todays_job();

    $two_days_agos_job=$this->two_days_agos_job();
    $seven_days_agos_job=$this->seven_days_agos_job();
    $last_months_job=$this->last_months_job();
    $companyName=$this->companyiesForCountJob();
    $countCompanyWiseJob=$this->countCompanyWiseJob();
    $jobtypecount=$this->jobtypecount();
    $catMachingName=$this->catMachingName();
    $locMachingName=$this->locMachingName();
    $industryMachingName=$this->industryMachingName();

    $etypes = employmenttype::all();
    $jobtypecount=$this->jobtypecount();

    $searchQuery=DB::table('jobs')->where('published', '1');

    $location_select = [];
    if($r->location) {
      $array = $r->location;
      $searchQuery=$searchQuery->whereIn('area_id', $r->location);
      // $searchQuery=$searchQuery->whereIn('area_id', $r->location)->orWhere( function ($query) use ($array) {
      //   $query->whereIn('city_id', $array);
      // });
      foreach($r->location as $i){
        $location_select[$i] = 1;
        $location_select[CityArea::find($i)->parent_id] = 1;
      }
    }

    // by huapeng
    if($r->target_locations) {
      $locations=explode(",", $r->target_locations);
      $array = $locations;
      $searchQuery=$searchQuery->whereIn('area_id', $locations);
      // $searchQuery=$searchQuery->whereIn('area_id', $locations)->orWhere( function ($query) use ($array) {
      //   $query->whereIn('city_id', $array);
      // });
      foreach($locations as $i){
        $location_select[$i] = 1;
        $location_select[CityArea::find($i)->parent_id] = 1;
      }
    }

    $industry_select = [];
    if($r->industry) {
      $searchQuery=$searchQuery->whereIn('industrytype_id', $r->industry);
      foreach($r->industry as $i){
        $industry_select[$i] = 1;
      }
    }

    $category_select = [];
    if($r->category) {
      $searchQuery=$searchQuery->whereIn('catagory_id', $r->category);
      foreach($r->category as $i){
        $category_select[$i] = 1;
      }
    }

    if($r->company_id) {
      $searchQuery=$searchQuery->whereIn('jobs.employer_id', $r->company_id);
    }

    $keyword="";
    if($r->keyword) {
      $searchQuery=$searchQuery->where('jobs.jobtitle', 'like', "%".$r->keyword."%");
      $keyword = $r->keyword;
    }

    $date = "any";
    if($r->date) {
      if($r->date == 'week') {
        $start=date("Y-m-d", strtotime('monday this week'));
        $end=date("Y-m-d", strtotime('sunday this week'));
        $searchQuery=$searchQuery->whereBetween('jobs.created_at', [$start, $end]);

        // $searchQuery=$searchQuery->Where(function ($query) {
        //   $query-> whereBetween('jobs.created_at', array(carbon::today(), carbon::tomorrow()))-> orWhereBetween('jobs.created_at', array(carbon::today()->subDays(2), carbon::today()))-> orWhereBetween('jobs.created_at', array(carbon::today()->subDays(7), carbon::today()))-> orWhereBetween('jobs.created_at', array(carbon::today()->subDays(30), carbon::today()));
        // });
        $date = "week";
      }
      else if($r->date == 'month') {
        $now = Carbon::now();
        $month=$now->month;
        $year=$now->year;
        $searchQuery=$searchQuery->whereRaw('month(jobs.created_at)=?', [$month])->whereRaw('year(jobs.created_at)=?', [$year]);
        $date = "month";
      }
    }

    $jobtype_select = [];
    if($r->jobtype) {
      $searchQuery=$searchQuery->whereIn('employment_type', $r->jobtype);
      foreach($r->jobtype as $i){
        $jobtype_select[$i] = 1;
      }
    }

    // $searchQuery=$searchQuery->orderBy('id','desc')->get();
    // return $searchQuery;
    $countTotalSearchableJob=count($searchQuery->get());
    $category=$this->get_category();

    $searchQuery=$searchQuery->join('city_areas', 'jobs.area_id', 'city_areas.id')->join('empprofiles', 'jobs.employer_id', 'empprofiles.employer_id')->select('jobs.*', 'city_areas.name as div_name', 'empprofiles.companyname', 'empprofiles.companylogo')->orderby('jobs.featured','DESC')->orderby('jobs.data_featured','DESC')->orderBy('jobs.created_at','DESC')->paginate(20);


    //return $salaryrangeCount=$this->salaryRangeCount();


    //return  dump($jobs);
    // $theme=$this->selecttheme();

    $catjobs = $searchQuery;
    // if($theme=='newblue') {
    //   return view('public.finalsearch2', compact("searchQuery", 'category', 'division', 'count_by_div', 'divisions', 'pic', 'get_ind', 'countCategoryWiseJob', 'categorysForCountJob', 'todays_job', 'two_days_agos_job', 'seven_days_agos_job', 'last_months_job', 'companyName', 'countCompanyWiseJob', 'searchQuery', 'jobtypecount', 'countTotalSearchableJob', 'catMachingName', 'locMachingName', 'industryMachingName', 'etypes', 'jobtypecount'));
    // }
    // else {
    return view('public.category_wise_job', compact("catjobs", 'category', 'division', 'count_by_div', 'divisions', 'pic', 'get_ind', 'countCategoryWiseJob', 'categorysForCountJob', 'todays_job', 'two_days_agos_job', 'seven_days_agos_job', 'last_months_job', 'companyName', 'countCompanyWiseJob', 'searchQuery', 'jobtypecount', 'countTotalSearchableJob', 'catMachingName', 'locMachingName', 'industryMachingName', 'etypes', 'jobtypecount', 'location_select', 'industry_select', 'category_select', 'keyword', 'date', 'jobtype_select', 'city_areas'));
    // }
  }

  public function about() {
    return view('public.about');
  }

    public function termsOfUse() {
        return view('public.termsofuse');
    }

    public function privacyPolicy() {
        return view('public.privacypolicy');
    }

    public function cookiesPolicy() {
        return view('public.cookiespolicy');
    }

  public function indexpage() {
    $divisions=$this->get_divisions();
    $city_areas=jobseekerController::get_cityareas();

    return view('public.index', compact('divisions', 'city_areas'));
  }

  public function addMessage(Request $data) {
    $conv=conversation::find($data->con_id);
    if ($conv->block == 1) {
        return response()->json(['block' => '1'], 200);
    }
    $msg=message::create(['con_id'=>$data->con_id, 'message'=>$data->message, 'sender'=>$data->sender, 'js'=>$data->js, 'emp'=>$data->emp]);

    $html=view('public.message', compact('msg'))->render();
    return response()->json(['html' => $html, 'id'=>$msg->id, 'block' => '0'], 200);
  }

  public function broadcastMessage(Request $data){
    $msg = message::find($data->id);
    
    if($data->sender==1){
      // broadcast(new MessageArrivedFromEmployer(Auth::guard('employer')->user(), $msg))->toOthers();
      $this->pusher->trigger('message', 'fromemployer.arrived.'.$data->js, [Auth::guard('employer')->user(), $msg]);
      $notif = new notification();
      $ajob = Applied_job::where('employer_id', Auth::guard('employer')->user()->id)->where('jobseeker_id', $data->js)->get()[0];
      $notif->job_id = $ajob->job_id;
      $notif->jobseeker_id = $data->js;
      $notif->sender = 1;
      $notif->save();
    }
    else if($data->sender==0){
      $this->pusher->trigger('message', 'fromjobseeker.arrived.'.$data->emp, [Auth::guard('jobseeker')->user(), $msg]);
      $notif = new notification();
      $ajob = Applied_job::where('employer_id', $data->emp)->where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get()[0];
      $notif->job_id = $ajob->job_id;
      $notif->jobseeker_id = Auth::guard('jobseeker')->user()->id;
      $notif->sender = 0;
      $notif->save();
      // broadcast(new MessageArrivedFromJobseeker(Auth::guard('jobseeker')->user(), $msg))->toOthers();
    }
  }

  public function getMessage($id) {
    $msg=message::find($id);
    $msg->isread = 1;
    $msg->save();
    return view('public.message', compact('msg'));
  }

  public function loadMoreMessages(Request $data) {
    $messages=message::where('con_id', $data->con_id)->where('id', '<', $data->top_msg_id)->oldest()->limit(50)->get();

    $html = '';
    foreach ($messages as $msg) {
        $msgHtml = view('public.message', compact('msg'))->render();
        $html= $html . $msgHtml;
    }
    return response()->json(['html' => $html], 200);
  }

  public function blockConv(Request $data) {
    $conv = conversation::find($data->con_id);
    $conv->block = $data->block;
    $conv->save();
//    conversation::where('id', $data->con_id)->update(array('block' => $data->block));
    $this->pusher->trigger('message', 'fromemployer.blocked.'.$conv->jobseeker, [Auth::guard('employer')->user(), $conv]);

    return response()->json(['con_id' => $data->con_id, 'block' => $data->block], 200);
  }

  public function empInbox($convid=0) {
    $myprofile=empprofile::where('employer_id', Auth::guard('employer')->user()->id)->get();
    $myprofile=$myprofile[0];
    $conv=conversation::where('employer', Auth::guard('employer')->user()->id)->paginate(10);
    $curconv=$conv[0];
    $pageno=3;
    $messages=null;
    if($convid>0){
      $curconv = conversation::find($convid);
    }
    if($curconv != null){
//        dd(Carbon::today()->subMonths(3)->toDateString());
      message::where('con_id', $curconv->id)->whereDate('created_at', '<', Carbon::today()->subMonths(3)->toDateString())->delete();
      message::where('con_id', $curconv->id)->update(array('isread' => 1));
      $messages = message::where('con_id', $curconv->id)->orderBy('id', 'desc')->limit(50)->get();
      $messages = $messages->reverse();
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
    $ida=Auth::guard('employer')->user()->id;
    // $alljobs=DB::table('jobs')->where('employer_id', $ida)->count();
    // $active=DB::table('jobs')->where('employer_id', $ida)->where('deadline', '>', $nowFormat)->where('delete_status', 0)->count();
    $alljobs = DB::table('jobs')->where([['employer_id', $ida], ['published',1]])->count();
    $active = job::where([['employer_id', $ida], ['published',1]])->where('deadline', '>=', $nowFormat)->where('status', 0)->count();

    return view('employer.messages', compact('clss', 'alljobs', 'active', 'conv', 'myprofile', 'curconv', 'messages', 'unreadcnt', 'pageno'));

  }

  public function jsInbox($convid=0) {
    $jobprofile=personaldetails::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get()[0];

    $applied=DB::table('applied_jobs')->where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get();
    $applied=count($applied);

    $accepted = DB::table('applied_jobs')->where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->where('status', 1)->get();
    $accepted = count($accepted);

    $conv=conversation::where('jobseeker', Auth::guard('jobseeker')->user()->id)->paginate(10);

    foreach ($conv as $c) {
        if ($c && $c->employer_ != null) {
            if ($c->employer_->empprofile != null) {
                $curconv = $c;
            }
        }
    }

    if($convid>0){
      $curconv = conversation::find($convid);
      if ($curconv->employer_->empprofile == null) {
          $curconv = null;
      }
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

    $total=Applied_job::where("jobseeker_id", "=", Auth::guard('jobseeker')->user()->id)->count();

    $pageno=3;
    return view('jobseeker.messages', compact('total', 'applied', 'jobprofile', 'conv', 'pageno', 'accepted', 'curconv', 'unreadcnt'));
  }

  public function createConversation($js) {
    $conv=conversation::where('employer', Auth::guard('employer')->user()->id)->where('jobseeker', $js)->get();

    if(count($conv)>=1) {
      return redirect("/employer/message/".$conv[0]->id);
    }
    else {
      $e=Employer::find(Auth::guard('employer')->user()->id);
      $j=Jobseeker::find($js);
      $co=conversation::create(['employer'=>Auth::guard('employer')->user()->id, 'jobseeker'=>$js, 'employer_name'=>$e->name, 'jobseeker_name'=>$j->name]);
      //  return $co->id;
    }

    return redirect("/employer/message/".$co->id);

  }


  public function contact(Request $data) {

    $validator = Validator::make($data->all(), [
      'email' => 'email',
      'contact' => 'regex:/[0-9-]+/',
    ], [
      'email.email' => 'Email address is invalid!',
      'contact.regex' => 'Contact number is invalid!',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)
                    ->withInput();
    }

    $frm=new contactu();

    $rec=$data->all();

    $apath = "";
    if($data->hasFile('avatar')) {
      $path=$data->file('avatar')->store('/public/profile');
      $path=str_replace("public", "storage", $path);
      $frm->file=$path;
      $apath=url('')."/".$path;
    }

    $frm->name=$data->name;
    $frm->email=$data->email;
    $frm->phone=$data->contact;
    $frm->type=$data->type;
    $frm->message=$data->comment;

    $frm->save();

    // $rec = json_encode($rec, JSON_UNESCAPED_SLASHES);
    $rec = [
        'email' =>  $data->email,
        'name'  =>  $data->name,
        'type'  =>  $data->type,
        'message' =>  $data->comment,
        'phone' =>  $data->contact,
        'attachpath' => $apath
    ];

    Mail::send('Email.contactemail', ['rec' => $rec], function ($m) use ($rec) {
      $m->from($rec['email'], $rec['name']);

      $m->to("worldtalentjobs@gmail.com", "WorldTalentJobs")->subject('Someone contacted you!');
    });
    return view('public.contacted');
    // return redirect('/contactus');
  }

  public function contactus() {
    return view('public.contactus');
  }

  //public function filter(Request $r){
  // $searchQuery=DB::table('jobs')->whereIn('division_id',$r->location)->whereIn('industrytype_id',$r->industry)->whereIn('category_id',$r->category)->whereIn('company_id',$r->company_id)->whereIn('created_at',$r->date)->whereIn('salary_range',$r->salary_range)whereIn('jobType',$r->jobType)->orderByRaw($r->shortby)->get();
  // }

  // public function scopeDivision($query,$searchParameter)
  //  {
  //     if(!is_null($searchParameter){
  //       return $query->whereIn('division_id', $searchParameter);
  //     }else{
  //       return $query;
  //     }
  //  }

  //  public function scopeIndustryType($query,$searchParameter)
  //  {
  //     if(!is_null($searchParameter){
  //       return $query->whereIn('industrytype_id', $searchParameter);
  //     }else{
  //       return $query;
  //     }
  private function selecttheme() {
    $selectfontpage=DB::table('frontpagethemes')->where('status', '1')->pluck('pagename');

    //  if(count($selectfontpage)>0){$selectedtheme=$theme[0];}else{
    //     $selectedtheme='public';
    // }
    $selecttheme=count($selectfontpage)>0?$selectfontpage[0]: 'public';
    return $selecttheme;


  }


  // show jobdetails by id
  public function jobsdescription($id) {
    $apply='false';
    $catid=DB::table('jobs')->where('jobs.id', $id)->pluck('catagory_id');
    //return $catid;


    $relatedJobs=DB::table('jobs')->where('jobs.catagory_id', $catid)->where('jobs.id', '!=', $id)->join('empprofiles', 'jobs.employer_id', '=', 'empprofiles.employer_id') ->join('city_areas', 'jobs.area_id', '=', 'city_areas.id') ->select('jobs.*', 'city_areas.name as divname', 'empprofiles.companyname as companyname', 'empprofiles.companylogo as clogo') ->take(4)->orderByRaw("Rand()")->get();
    $jobseekerdetails=[];
    $catagories=catagory::all();
    $job = job::find($id);
    $job->totalviews++;
    $job->save();
    $jobdata=job::join('empprofiles', 'jobs.employer_id', '=', 'empprofiles.employer_id')
                // ->join('catagories', 'jobs.catagory_id', '=', 'catagories.id') 
                ->join('industrytypes', 'jobs.industrytype_id', '=', 'industrytypes.id') 
                ->join('city_areas', 'jobs.area_id', '=', 'city_areas.id') 
                ->select('jobs.*', 'empprofiles.companyname', 'empprofiles.companylogo', 'empprofiles.companyaddress', 'industrytypes.industrytypename', 'city_areas.name as divname') 
                ->where('jobs.id', $id)->get()[0];

    if (Auth::guard('jobseeker')->check()) {
      $jobseekerdetails=personaldetails::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get();
      $jobseekerdetails=$jobseekerdetails[0];
      $jobseeker_id=Auth::guard('jobseeker')->user()->id;
      $check=Applied_job::where('job_id', $id)->where('jobseeker_id', $jobseeker_id)->get();
      $num_rows=count($check);

      if($num_rows>0) {
        $apply='true';
      }

    }
    //var_dump($jobdata->quest_location_req);
    return view('public.showjobsbyid', compact('jobseekerdetails', 'jobdata', 'catagories', 'apply', 'relatedJobs'));
    // return $jobdata;

  }

  public function uploadimage(Request $request) {

    print_r($request->all());
    $path=$request->file('avatar')->store('public/profile');
    echo $path;
    //return $path;
  }

  //count job employer jobseeker jobs and total online
  public function public_stastics(Request $request) {
    if ($request->request='AJAX') {
      switch ($request->action) {
        case 'employer':
          return Employer::count();
        break;
        case 'jobseeker':
          return Jobseeker::count();
        break;
        case 'job':
          return Job::count();
        break;

        default:
          # code... break;
      }
    }

    else {
      return FALSE;
    }
  }

  public function relatedJobs(Request $r) {

    $category=$this->get_category();

    $division=$this->get_division();
    $divisions=$this->get_divisions();
    $count_by_div=$this->count_jobs_by_divisionwise();
    $countCategoryWiseJob=$this->countCategoryWiseJob();

    $categorysForCountJob=$this->categorysForCountJob();

    $get_ind=$this->get_industrytype();
    $pic=$this->particular_count_industrytype();

    $todays_job=$this->todays_job();

    $two_days_agos_job=$this->two_days_agos_job();
    $seven_days_agos_job=$this->seven_days_agos_job();
    $last_months_job=$this->last_months_job();
    $companyName=$this->companyiesForCountJob();
    $countCompanyWiseJob=$this->countCompanyWiseJob();
    $jobtypecount=$this->jobtypecount();
    $catMachingName=$this->catMachingName();
    $locMachingName=$this->locMachingName();


    $title=$r->rtitle;
    $catid=DB::table('jobs')->where('jobs.id', $r->rid)->pluck('catagory_id');
    //return $catid;
    $relatedJobs=DB::table('jobs')->where('jobs.catagory_id', $catid)->where('jobs.id', '!=', $r->rid)->join('empprofiles', 'jobs.employer_id', '=', 'empprofiles.employer_id') ->join('divisions', 'jobs.division_id', '=', 'divisions.id')->select('jobs.*', 'divisions.name as divname', 'empprofiles.companylogo as clogo', 'empprofiles.companyname')->orderByRaw('jobs.id', 'desc')->paginate(10);
    $relatedJobsCt=DB::table('jobs')->where('jobs.catagory_id', $catid)->where('jobs.id', '!=', $r->rid)->get();

    $relatedJobsCount=count($relatedJobsCt);
    return view('public.relatedJobs', compact('category', 'division', 'divisions', 'count_by_div', 'countCategoryWiseJob', 'categorysForCountJob', 'get_ind', 'pic', 'todays_job', 'two_days_agos_job', 'seven_days_agos_job', 'last_months_job', 'companyName', 'countCompanyWiseJob', 'jobtypecount', 'catMachingName', 'locMachingName', 'relatedJobs', 'title', 'relatedJobsCount'));
  }

    public function sendEVerifymailForChange($email, $new_email, $verifyToken)
    {
        $check = Employer::where('email',$email)->where('verifyToken',$verifyToken)->first();
        if ($check) {
            Employer::where('email',$email)->where('verifyToken',$verifyToken)->update(['email'=>$new_email,'verifyToken'=>'']);

            $empprofile = empprofile::find($check->id);
            $empprofile->ContactEmail = $new_email;
            $empprofile->save();

            return redirect(url('/employer/settings'));
        }
    }

}