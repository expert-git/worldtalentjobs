{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
    HomePage
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('theme/css/tagsinput-combo.css') }}">
    <style>
        .bootstrap-tagsinput {
            border: none;
            box-shadow: none;
            position: relative;
            overflow-y: hidden;
        }

        .bootstrap-tagsinput input {
            display: block;
            border-left: none;
            border-right: none;
            border-bottom: none;
            border-top: none;
            border-radius: 0;
            -webkit-box-shadow: none !important;
            -moz-box-shadow: none !important;
            box-shadow: none !important;
            padding: 4px;
            width: 100%;
            overflow: hidden;
            margin-top: 0px;
        }

        .bootstrap-tagsinput:before {
            position: absolute;
            right: 10px;
            top: 7px;
            content: '\f107';
            font-family: FontAwesome;
            color: grey;
        }

        .bootstrap-tagsinput input:focus {
            border: none;
        }


    </style>
@endsection
@section('content')
    <div>
        <div class="container">
            <div class="sixteen columns">
                <div class="search-container">

                    <!-- Form -->
                    <form action="{{url('search') }}" method="get" class=" form-inline" id="searchform">
                        <input type="hidden" id="target_locations" name="target_locations">
                        <div class="search-job-list" style="box-shadow: 0px 3px 49px rgba(0, 0, 0, 0.2);">
                            <input name="keyword" type="text" id="job-search-title" class="ico-01" placeholder="Type Job title, skills, etc."
                                   value=""/>

                            <div class="form-group job-search-location">
                                <div id="target_location_input" class="find-jobs-search-location">
                                    <input name="target_location" type="hidden" id="target_location"
                                           data-role="tagsinput" data-toggle="dropdown">
                                </div>

                                <div id="accordion-city" class="searchlocationdropdown" role="menu"
                                     aria-labelledby="target_location">
                                    <ul>
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


                            <button type="submit" style="margin-top:0%;    margin-left: 1%;">Search</button>


                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <h1 class="find1hed">Jobs You Might Be Interested In</h1>

    <div class="container tableconta"
         style="box-shadow: -7px 8px 55px -5px rgba(0,0,0,0.35); padding: 4%; line-height: 3; margin-bottom:300px; max-height:700px; overflow-x:auto;">

        <div class="row" id="changeheight"
             style="max-height:520px; overflow:hidden;font-size:22px;">
            <?php $cnt = 0 ?>
            @foreach($get_ind as $ind)
                <div class="col-md-6 @if($cnt>11) additional @endif">
                    <div class="col-md-10">
                        <a href="{{url('category/').'/'.$ind->id}}">{{$ind->industrytypename}}</a>
                    </div>
                    <div class="col-md-2" style="color:#7889FF;text-align:right;">{{ $pic[$ind->id] }}</div>
                </div>
                <?php $cnt++ ?>
            @endforeach
        </div>
        <div class="btn-search-more row ">
            <div class="col-md-12" style="padding-right:30px;">
                <p id="seemore" class="tablro1">SEE MORE</p>
            </div>
        </div>
    </div>
@endsection

@section('extrascript')
    <script>
		$('.additional').hide();
		$("#seemore").on("click", function () {
			// alert("a");
			$("#changeheight").css("max-height", "100%");
			$("#seemore").hide();
			$('.additional').show();
		})
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

		$('.bootstrap-tagsinput input').attr('placeholder', 'Choose Location');


		$("#target_location").change(function () {
			if ($('#target_location').val() == '') {
				$('.bootstrap-tagsinput input').attr('placeholder', 'Choose Location');
				$('.bootstrap-tagsinput input').css('display', 'block');
				$('.bootstrap-tagsinput').css('overflow-y', 'hidden');
			} else {
				$('.bootstrap-tagsinput input').css('display', 'none');
				$('.bootstrap-tagsinput').css('overflow-y', 'auto');
			}
		});
		// ============================== target location end =======================
    </script>
@endsection
