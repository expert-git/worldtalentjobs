{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
    HomePage
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('theme/css/tagsinput-combo.css') }}">
    <style>
        @media (max-width: 768px) {
            .button1 {
                margin-top: 5% !important;
            }
        }

        .search-container button {
            background-color: #28C294;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 15px;
            box-sizing: border-box;
            text-align: center;
            height: 48px;
            padding: 0 10px;
            position: relative;
        }

        .button1 {
            padding: 0px;
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 42px;
            user-select: none;
            -webkit-user-select: none;
        }

        .bootstrap-tagsinput {
            border-radius: 0;
            box-shadow: none;
        }
    </style>
@endsection
@section('content')
    <div id="banner">
        <div class="container">
            <div class="sixteen columns">
                <div class="search-container">
                    <!-- Form -->
                    <h2 style="   text-align: center !important; ">FIND JOBS</h2>
                    <h3 style="    font-size: 36px; color:white;   padding-bottom: 15%;text-align: center !important; ">
                        Jobs In Qatar</h3>
                    <div class="search-list" style="width:80%;">
                        <form action="{{url('search') }}" method="get" class=" form-inline" id="searchform">
                            <input name="keyword" type="text" class="ico-01 res-input" style="width:37%;margin-left:4%;"
                                   placeholder="Job title, skills, etc." value=""/>
                            <input type="hidden" id="target_locations" name="target_locations">
                            <div class="form-group res-drop-down" style="position:relative; width:37%;margin-left:3%;">
                                <div id="target_location_input">
                                    <div class="location-placeholder">
                                        Place
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <input name="target_location" id="target_location" data-role="tagsinput"
                                           data-toggle="dropdown">
                                </div>

                                <div id="accordion-city" class="searchlocationdropdown" role="menu"
                                     aria-labelledby="target_location">
                                    <ul class="res-list">
                                        @foreach($city_areas as $city)
                                            <li>
                                                <div class="searchlocationdropdown-item">
                                                    <div class="checkbox checkbox-primary"
                                                         style="display:inline-block;">
                                                        <input type="checkbox" id="city_area{{$city['id']}}"
                                                               data-type="city" data-id="{{$city['id']}}"
                                                               data-name="{{$city['name']}}">
                                                        <label for="city_area{{$city['id']}}">
                                                            {{$city['name']}}
                                                        </label>
                                                    </div>

                                                    <div data-id="{{$city['id']}}" class="tagsinputtoggle"
                                                         style="margin-top: 18px;float:right;margin-right:30px;">
                                                        <img src="/icon-img/down.png" style="width:20px;height:20px;">
                                                    </div>
                                                </div>
                                                <div id="collapse-city{{$city['id']}}" class="collapse">
                                                    <ul>
                                                        @foreach($city['areas'] as $area)
                                                            <li class="searchlocationdropdown-item-item">
                                                                <div class="checkbox checkbox-primary">
                                                                    <input type="checkbox" id="city_area{{$area['id']}}"
                                                                           data-type="area" data-parid="{{$city['id']}}"
                                                                           data-id="{{$area['id']}}"
                                                                           data-name="{{$area['name']}}">
                                                                    <label for="city_area{{$area['id']}}">
                                                                        {{$area['name']}}
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="search-btn">
                                <button class="button1 res-btn"
                                        style="">Search
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="fircon1 container">
        <div class="postccv col-sm-12 col-md-3">
            <h3 class="Posthed">Post Your CV</h3>
            <p class="Postcont">In a few seconds </p>
            <p class="cbtn desktop-display"><a href="/jobseeker">
                    <button class="postbtn" class="post-now">POST NOW</button>
                </a></p>
        </div>

        <div class="post-cv-container">
            <div class="post-cv-employer col-sm-12 col-md-3">
                <img class="jobiconleft" src="img/Group 2.5.png" width="80%;">
            </div>

            <div class="post-cv-image col-sm-12 col-md-6">
                <p class="badcon"> Stay updated on the latest jobs in Qatar with World Talent Jobs. Post your CV and get
                    noticed by recruiters in Qatar.</p>
            </div>
        </div>
        <p class="cbtn mobile-display"><a href="/jobseeker">
                <button class="postbtn" class="post-now">POST NOW</button>
            </a></p>
    </div>

    <div class="fircon1 container">
        <h3 class="Posthed mobile-display">Employers</h3>
        <p class="Postcont mobile-display">Post your job for free </p>
        <div class="post-cv-employer mobile-display col-sm-12 col-md-3">
            <img class="jobiconleft" src="img/Group 2.3.png" >
        </div>
        <div class="post-cv-image col-md-6">
            <p class="badconright"> Post your vacancies to World Talent Jobs and receive applications from qualified
                candidates looking for jobs in Qatar.</p>
        </div>
        <div class="col-sm-12  col-md-3 desktop-display">
            <img class="joinconright" src="img/Group 2.3.png" class="res-employer">
        </div>
        <div class="postccvright col-sm-12 col-md-3">
            <h3 class="Posthed desktop-display">Employers</h3>
            <p class="Postcont desktop-display">Post your job for free </p>
            <p class="cbtn"><a href="/employer">
                    <button class="postbtn" style="background:#28c294;">JOIN NOW</button>
                </a></p>
        </div>
    </div>

    <div class="fircon1 container">
        <div class="postccv col-sm-12 col-md-3">
            <h3 class="Posthed">Urgently Need<br>a Job?</h3>
            <p class="Postcont">Tell the employers! </p>
            <p class="cbtn desktop-display"><a href="#">
                    <button onclick="location.href = '{{url('/jobseeker/checkout')}}'" class="get-listed">GET LISTED
                    </button>
                </a></p>
        </div>

        <div class="post-cv-employer col-sm-12 col-md-3">
            <img class="jobiconleft" src="img/Group 2.4.png" width="80%;">
        </div>

        <div class="post-cv-image col-sm-12 col-md-6">
            <p class="badcon"> List your Profile on our special board <a href='#' style="color:#2784fc">Job Needed</a>
                and get noticed by the employers faster!.</p>
        </div>
        <p class="cbtn mobile-display"><a href="#">
                <button onclick="location.href = '{{url('/jobseeker/checkout')}}'" class="get-listed">GET LISTED
                </button>
            </a></p>
    </div>

@endsection

@section('extrascript')
    <script>
		// ============================== target location start =======================

		$('.tagsinputtoggle').click(function () {
			var id = $(this).data('id');
			if ($('#collapse-city' + id).hasClass("in")) {
				$('#collapse-city' + id).collapse('hide');
				$(this).html('<img src="/icon-img/down.png" style="width:20px;height:20px;">');
			} else {
				$('#collapse-city' + id).collapse('show');
				$(this).html('<img src="/icon-img/up.png" style="width:20px;height:20px;">');
			}
		});

		$('#target_location').tagsinput({
			itemValue: 'id',
			itemText: 'text'
		});

		$('input[id^="city_area"]').click(function () {

			if ($(this).data('type') == 'city') {
				var id = $(this).data('id');
				if ($(this).prop("checked")) {
					$('input[data-type="area"][data-parid="' + id + '"]').prop("checked", true);
				} else {
					$('input[data-type="area"][data-parid="' + id + '"]').prop("checked", false);
				}
			} else if ($(this).data('type') == 'area') {
				var id = $(this).data('parid');
				if ($(this).prop("checked")) {
					$('input[data-type="city"][data-id="' + id + '"]').prop("checked", true);
				}
			}

			$('#target_location').tagsinput('removeAll');

			$('input[id^="city_area"]').each(function (index) {
				if ($(this).prop('checked')) {
					$('#target_location').tagsinput('add', {id: $(this).data('id'), text: $(this).data('name')});
				}
			});

			$('#target_location').tagsinput('refresh');
		});

		$('#target_location').on('itemRemoved', function (event) {
			$('input[id^="city_area"][data-id="' + event.item.id + '"]').prop("checked", false);
		});

		$('#target_location_input').click(function () {
			if ($('#accordion-city').css("display") == "none") {
				$('#accordion-city').css("display", "block");
			} else {
				$('#accordion-city').css("display", "none");
			}
			event.stopPropagation();
		});

		$('html').click(function () {
			if ($('#accordion-city').css("display") == "block") {
				$('#accordion-city').css("display", "none");
			}
		});

		$('#accordion-city').click(function () {
			event.stopPropagation();
		});

		$('#searchform').submit(function (event) {
			$('#target_locations').val($('#target_location').val());
		});

		// ============================== target location end =======================
    </script>
@endsection
