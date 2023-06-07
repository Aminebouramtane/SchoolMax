@extends('layouts.master')
@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('students.students') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('dtudents.edit') }} </span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
					</div>
				</div>
				<!-- breadcrumb -->
@endsection

@section('content')
				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									{{ trans('dtudents.edit') }} :
								</div>
								<form action="{{route("students.update",$Students->id)}}" method="POST" enctype="multipart/form-data" class="parsley-style-1" id="selectForm2" name="selectForm2">
                                    @method("PUT")
									@csrf
									<div class="">
										<label for="">{{ trans('parents.photo') }} :</label>
										<div class="col-sm-12 col-md-4 mg-t-10 mg-sm-t-0">
											<input type="file" class="dropify" name="photo" data-default-file="" data-height="200"  />
										</div><br>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>{{ trans('students.name_en') }} :</label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$Students->student_name_en}}" name="student_name_en" placeholder="Enter name en" required="" type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('students.name_ar') }}:</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$Students->student_name_ar}}" name="student_name_ar" placeholder="Enter name ar" required="" type="text">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>{{ trans('students.email') }} :</label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$Students->email}}" name="email" placeholder="Enter Email" required="" type="email">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('students.password') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$Students->password}}" name="password" placeholder="Enter Password" required="" type="password">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="col-lg-6 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('students.academic_year') }}</p><select name="season" class="form-control" required="">
                                                    <option selected value="{{$Students->season}}">{{$Students->season}}</option>
													<option disabled label="Choose one"></option>
														@php
														$current_year = date("Y");
														@endphp
														@for($i=$current_year; $i<=$current_year +1 ;$i++)
															<option value="{{ $i}}">{{ $i }}</option>
														@endfor
												</select>
											</div>
                                            <div class="col-lg-6 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('parents.name_parent') }} </p><select name="parent_id" class="form-control select2" required="">
                                                    <option selected value="{{$Students->Parents->id}}">{{App::getLocale() == 'en'?$Students->Parents->parent_name_en:$Students->Parents->parent_name_ar}}</option>
													{{-- <option  disabled label="Choose one"></option> --}}
                                                    @foreach ($parents as $parent)
                                                        <option value="{{$parent->id}}">{{App::getLocale() == 'en'?$parent->parent_name_en:$parent->parent_name_ar}}</option>
                                                    @endforeach
												</select>
											</div><!-- col-4 -->
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.birth') }}:</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$Students->birthday}}" name="birthday" placeholder="day-mount-year" required="" type="date">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Phone_Father') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$Students->phone}}" name="phone" placeholder="+21 2* ** ** **" required="" type="text">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Address_Father_en') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$Students->adress_en}}" name="adress_en" placeholder="Enter Adress en" required="" type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Address_Father') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$Students->adress_ar}}" name="adress_ar" placeholder="Enter Adress ar" required="" type="text">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.cin') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$Students->cin}}" name="cin" placeholder="Enter CIN" required="" type="text">
											</div>
                                            @if ($Students->sexe == 1)
                                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                    <label for="">{{ trans('parents.gender') }} :</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" checked value="1" type="radio" name="sexe" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            {{ trans('parents.male') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" value="0" type="radio" name="sexe" id="flexRadioDefault2">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            {{ trans('parents.female') }}
                                                        </label>
                                                    </div><br>
                                                </div><!-- col-4 -->
                                            @else
                                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                    <label for="">{{ trans('parents.gender') }} :</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" value="1" type="radio" name="sexe" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            {{ trans('parents.male') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" checked value="0" type="radio" name="sexe" id="flexRadioDefault2">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            {{ trans('parents.female') }}
                                                        </label>
                                                    </div><br>
                                                </div><!-- col-4 -->
                                            @endif
										</div>
										<div class="row mg-b-20">

											<div class="col-lg-4 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('students.Grade') }}</p><select name="grade_id" class="form-control select2" required="">
                                                    <option selected value="{{$Students->Grades->id}}">{{App::getLocale() == 'en'?$Students->Grades->grade_name_en:$Students->Grades->grade_name_ar}}</option>
													<option disabled label="Choose ..."></option>
                                                    @foreach ($grades as $grade)
                                                        <option value="{{$grade->id}}">{{$grade->grade_name_en}}</option>
                                                    @endforeach
												</select>
											</div><!-- col-4 -->

											<div class="col-lg-4 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('students.Class') }}</p>
                                                <select class="form-control select2" required="" name="classe_id">
                                                     <option selected value="{{$Students->Classes->id}}">{{App::getLocale() == 'en'?$Students->Classes->classe_name_en:$Students->Classes->classe_name_ar}}</option>

												</select>
											</div><!-- col-4 -->
											<div class="col-lg-4 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('students.section') }}</p><select name="section_id" class="form-control select2" required="">
                                                    <option selected value="{{$Students->Sections->id}}">{{App::getLocale() == 'en'?$Students->Sections->section_name_en:$Students->Sections->section_name_ar}}</option>

												</select>
											</div><!-- col-4 -->
										</div>

									</div>

									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20" type="submit">{{ trans('grades.submit') }}</button>
										<a class="btn btn-success" href="{{route("students.index")}}">
											{{ trans('teachers.Back') }}
										</a>
										<button class="btn btn-secondary pd-x-20" type="reset">{{ trans('teachers.Reset') }}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->

@endsection


@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<!--Internal Fancy uploader js-->
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>


@if (App::getLocale() == 'en')
    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classess') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classe_id"]').empty();
                            $('select[name="classe_id"]').append('<option selected disabled >Choose...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="classe_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('select[name="classe_id"]').on('change', function () {
                var classe_id = $(this).val();
                if (classe_id) {
                    $.ajax({
                        url: "{{ URL::to('ssections') }}/" + classe_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $('select[name="section_id"]').append('<option selected disabled >Choose...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@else
<script>
    $(document).ready(function () {
        $('select[name="grade_id"]').on('change', function () {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    url: "{{ URL::to('classessar') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="classe_id"]').empty();
                        $('select[name="classe_id"]').append('<option selected disabled >تحديد</option>');
                        $.each(data, function (key, value) {
                            $('select[name="classe_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
    <script>
        $(document).ready(function () {
            $('select[name="classe_id"]').on('change', function () {
                var classe_id = $(this).val();
                if (classe_id) {
                    $.ajax({
                        url: "{{ URL::to('ssectionsar') }}/" + classe_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $('select[name="section_id"]').append('<option selected disabled >تحديد</option>');
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endif



@endsection
