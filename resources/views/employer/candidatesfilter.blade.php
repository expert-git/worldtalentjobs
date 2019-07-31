<div class="container" style="width:90%;margin:auto;">
    <form method="POST" action="/employer/candidatessearch/{{$status}}" id="filterform">
        {{csrf_field()}}
        <div class="col-md-9">
            {{-- ======================= salary start ======================= --}}
            <div class="col-md-4 filter-panel" id="panel_salary">
                <h3><b>Minimum Salary</b></h3>
                <input name="salary" type="form-control" style="width:100%" placeholder="Query minimum salary"
                    @if(!empty($minsalary) && $minsalary>=0) value="{{$minsalary}}" @endif>
            </div>
            {{-- ======================= salary end ======================= --}}

            {{-- ======================= experience start ======================= --}}
            <div class="col-md-4 filter-panel" id="panel_experience">
                <h3><b>Minimum Years of Experience</b></h3>
                <input name="experience" type="form-control" style="width:100%" placeholder="Query minimum experience"
                    @if(!empty($minexperience) && $minexperience>=0) value="{{$minexperience}}" @endif>
            </div>
            {{-- ======================= experience end ======================= --}}
            {{-- ======================= visa type start ======================= --}}
            <div class="col-md-4 filter-panel" id="panel_visatype">
                <h3><b>Visa Type</b></h3>
                <div class="filter-box">
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" id="all_visa_type" name="all_job_type">
                        <label for="all_visa_type">All</label>
                    </div>
                    <?php $cnt=0 ?>
                    @foreach($vtypes as $et)
                    <div class="checkbox checkbox-primary @if($cnt>5) additional_visatype @endif" style="@if($cnt>5) display:none; @endif margin-top:5px; margin-bottom:5px;">
                        <input type="checkbox" name="visatype[]" @if($visatypecount[$et->id]=='0' ){{"disabled"}} @endif
                            id="visatype_{{ $et->name }}"
                            @isset($visatype_select[$et->name]) checked @endisset
                            value="{{ $et->name }}">
                        <label for="visatype_{{ $et->name }}">{{ $et->name }} ({{$visatypecount[$et->id]}})</label>
                    </div>
                    <?php $cnt++ ?>
                    @endforeach
                </div>
                <p style="color:#28c29f;cursor:pointer;" class="showmore" data-id="visatype">
                    Show More
                    <span style="float:right;">
                        <i class="fas fa-ellipsis-h" style="font-size: 18px;"></i>
                    </span>
                </p>
            </div>
            {{-- ======================= visa type end ======================= --}}
            {{-- ======================= job title start ======================= --}}
            <div class="col-md-4 filter-panel" id="panel_jobtitle">
                <h3><b>Job Title</b></h3>
                <div class="filter-box">
                    <?php $cnt=0 ?>
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" id="all_job_category" name="all_job_category">
                        <label for="all_job_category">All</label>
                    </div>
                    @forelse($categorysForCountJob as $cfc)
                    <div class="checkbox checkbox-primary @if($cnt>6) additional_category @endif" style="@if($cnt>6) display:none; @endif margin-top:5px; margin-bottom:5px;">
                        <input type="checkbox"
                            @if($countCategoryWiseJob[$cfc->id]==0){{"disabled"}}@endif
                            name="category[]"
                            id="category_{{$cfc->id}}"
                            @isset($category_select[$cfc->id]) checked @endisset
                            value="{{$cfc->id}}">
                        <label for="category_{{$cfc->id}}">{{$cfc->catagoryname." (".$countCategoryWiseJob[$cfc->id].")"}}</label>
                    </div>
                    <?php $cnt++ ?>
                    @empty
                    no Job Category found
                    @endforelse
                </div>
                <p style="color:#28c29f;cursor:pointer;" class="showmore" data-id="category">
                    Show More
                    <span style="float:right;">
                        <i class="fas fa-ellipsis-h" style="font-size: 18px;"></i>
                    </span>
                </p>
            </div>
            {{-- ======================= job title end ======================= --}}
            {{-- ======================= job type start ======================= --}}
            <div class="col-md-4 filter-panel" id="panel_jobtype">
                <h3><b>Employment Type</b></h3>
                <div class="filter-box">
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" id="all_job_type" name="all_job_type">
                        <label for="all_job_type">All</label>
                    </div>
                    @foreach($etypes as $et)
                    <div class="checkbox checkbox-primary" style="margin-top:5px; margin-bottom:5px;">
                        <input type="checkbox" name="jobtype[]" @if($jobtypecount[$et->id]=='0' ){{"disabled"}} @endif
                            id="jobtype_{{ $et->name }}"
                            @isset($jobtype_select[$et->name]) checked @endisset
                            value="{{ $et->name }}">
                        <label for="jobtype_{{ $et->name }}">{{ $et->name }} ({{$jobtypecount[$et->id]}})</label>
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- ======================= job type end ======================= --}}
            
            {{-- ======================= location start ======================= --}}
            <div id="panel_location" class="col-md-4 filter-panel" id="panel_location">
                <h3><b>Location</b></h3>
                <div class="locationlist filter-box">
                    <ul>
                        <li>
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" id="all_city_area" name="all_city_area">
                                <label for="all_city_area">
                                    All
                                </label>
                            </div>
                        </li>
                        @foreach($city_areas as $city)
                        <li>
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" id="city_area{{$city['id']}}" data-type="city" data-id="{{$city['id']}}"
                                    @if($count_by_div[$city['id']]==0) disabled @endif  value="{{$city['id']}}" name="location[]"
                                    data-name="{{$city['name']}}" @isset($location_select[$city['id']]) checked @endisset>
                                <label for="city_area{{$city['id']}}">
                                    {{$city['name']}} ({{$count_by_div[$city['id']]}})
                                </label>
                                <a style="float:right;" href="#collapse_city{{$city['id']}}" data-toggle="collapse"
                                    aria-expanded="false"><i class="fas fa-chevron-down"></i></a>
                            </div>

                            <ul class="collapse" id="collapse_city{{$city['id']}}">
                                @foreach($city['areas'] as $area)
                                <li>
                                    <div class="checkbox checkbox-primary">
                                        <input type="checkbox" id="city_area{{$area['id']}}" data-type="area" name="location[]"
                                        data-parid="{{$city['id']}}" data-id="{{$area['id']}}" data-name="{{$area['name']}}" value="{{$area['id']}}"
                                        @if($count_by_div[$area['id']]==0) disabled @endif
                                        @isset($location_select[$area['id']]) checked @endisset>
                                        <label for="city_area{{$area['id']}}">
                                            {{$area['name']}} ({{$count_by_div[$area['id']]}})
                                        </label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <p style="color:#28c294;cursor:pointer;" class="showmore" data-id="city">Show More<span style="float:right;"><i
                    class="fas fa-ellipsis-h" style="font-size: 18px;"></i></span></p>
            </div>
            
            {{-- ======================= location end ======================= --}}
            {{-- ======================= job industry start ======================= --}}
            <div class="col-md-4 filter-panel" id="panel_industry">
                <h3><b>Job Industry</b></h3>
                <div class="filter-box">
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" id="all_job_industry" name="all_job_industry">
                        <label for="all_job_industry">All</label>
                    </div>
                    <?php $cnt=0 ?>
                    @forelse($get_ind as $ind)
                    <div class="checkbox checkbox-primary @if($cnt>6) additional_industry @endif" style="@if($cnt>6) display:none; @endif margin-top:5px; margin-bottom:5px;">
                        <input type="checkbox"
                            @if($pic[$ind->id]==0) disabled @endif
                            @isset($industry_select[$ind->industrytypename]) checked @endisset
                            id="industry_{{$ind->id}}"
                            name="industry[]" value="{{$ind->industrytypename}}">
                        <label for="industry_{{$ind->id}}">
                            {{$ind->industrytypename." (".$pic[$ind->id].")"}}
                        </label>
                    </div>
                    <?php $cnt++ ?>
                    @empty
                    no Industry type found
                    @endforelse
                </div>
                <p style="color:#28c294;cursor:pointer;" class="showmore" data-id="industry">Show More<span
                    style="float:right;"><i class="fas fa-ellipsis-h" style="font-size: 18px;"></i></span></p>
            </div>
            {{-- ======================= job industry end ======================= --}}

            
            {{-- ======================= NOC start ======================= --}}        
            <div class="col-md-4 filter-panel" id="panel_noc">
                <h3><b>NOC</b></h3>
                <div class="checkbox checkbox-primary">
                    <input id="NOC_avaiable" name="NOC[]" type="checkbox" @isset($noc_select["1"]) checked @endisset value="1"/>
                    <label for="NOC_avaiable">
                        Available ({{$noccount['1']}})
                    </label>
                </div>

                <div class="checkbox checkbox-primary">
                <input id="NOC_navaiable" name="NOC[]" type="checkbox" @isset($noc_select["0"]) checked @endisset value="0"/>
                    <label for="NOC_navaiable">
                        Non-Available ({{$noccount['0']}})
                    </label>
                </div>
            </div>
            {{-- ======================= NOC end ======================= --}}        

            {{-- ======================= nationality start ======================= --}}
            <div class="col-md-4 filter-panel" id="panel_nationality">
                <h3><b>Nationality</b></h3>
                <div class="filter-box">
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" id="all_nationality" name="all_nationality">
                        <label for="all_nationality">All</label>
                    </div>
                    <?php $cnt=0 ?>
                    @forelse($nationalities as $n)
                    <div class="checkbox checkbox-primary @if($cnt>6) additional_nationality @endif" style="@if($cnt>6) display:none; @endif margin-top:5px; margin-bottom:5px;">
                        <input type="checkbox"
                            @if($nation_count[$n->id]==0) disabled @endif
                            @isset($nation_select[$n->name]) checked @endisset
                            id="nation_{{$n->id}}"
                            name="nation[]" value="{{$n->name}}">
                        <label for="nation_{{$n->id}}">
                            {{$n->name." (".$nation_count[$n->id].")"}}
                        </label>
                    </div>
                    <?php $cnt++ ?>
                    @empty
                    No Nationality Found
                    @endforelse
                </div>
                <p style="color:#28c294;cursor:pointer;" class="showmore" data-id="nationality">Show More<span
                    style="float:right;"><i class="fas fa-ellipsis-h" style="font-size: 18px;"></i></span></p>
            </div>
            {{-- ======================= nationality end ======================= --}}

            {{-- ======================= Gender start ======================= --}}        
            <div class="col-md-4 filter-panel" id="panel_gender">
                <h3><b>Gender</b></h3>
                <div class="checkbox checkbox-primary">
                    <input id="gender_male" name="gender[]" type="checkbox" @isset($gender_select["male"]) checked @endisset value="male"/>
                    <label for="gender_male">
                        Male ({{$gendercount['male']}})
                    </label>
                </div>

                <div class="checkbox checkbox-primary">
                <input id="gender_female" name="gender[]" type="checkbox" @isset($gender_select["female"]) checked @endisset value="female"/>
                    <label for="gender_female">
                        Female ({{$gendercount['female']}})
                    </label>
                </div>
            </div>
            {{-- ======================= Gender end ======================= --}}  
        </div>
        <div class="col-md-3">
            <button style="background:none;"><i style="font-size:20px;color:#7889FF;" class="fas fa-sort-amount-down" aria-hidden="true"></i></button>
            <span style="font-size:18px;font-weight:bold;float:right;">Filter</span>
            <div class="searchbox1" style="margin-bottom:30px;">
                <input type="text" name="keyword" id="keyword" @isset($keyword) value="{{$keyword}}" @endisset>
                    <a><i class="fas fa-search"></i></a>
            </div>

            <button class="chk_btn1" id="salary" type="button">Salary</button>
            <button class="chk_btn1" id="experience" type="button">Experience</button>
            <button class="chk_btn1" id="visatype" type="button">Visa Type</button>
            <button class="chk_btn1" id="location" type="button">Location</button>
            <button class="chk_btn1" id="industry" type="button">Industry</button>
            <button class="chk_btn1" id="noc" type="button">NOC</button>
            <button class="chk_btn1" id="nationality" type="button">Nationality</button>
            <button class="chk_btn1" id="jobtype" type="button">Employment Type</button>
            <button class="chk_btn1" id="jobtitle" type="button">Job Title</button>
            <button class="chk_btn1" id="gender" type="button">Gender</button>

            <div class="row" style="margin-top:300px;">
                <div class="col-md-5 text-right">
                    <a href="javascript:resetfilter()" style="font-size:18px;font-weight:bold;">Clear</a>
                </div>
                <div class="col-md-7 text-right" style="padding-right:0;">
                    <button class="acceptbtn">APPLY FILTER</button>
                </div>
            </div>
        </div>
    </form>
</div>