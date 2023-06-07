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
							<h4 class="content-title mb-0 my-auto">{{ trans('promotion.promotions') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('promotion.add_promotion') }}</span>
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
									{{ trans('promotion.add_promotion') }} :
								</div>
								<form action="{{route("promotions.store")}}" method="POST" enctype="multipart/form-data" class="parsley-style-1" id="selectForm2" name="selectForm2">
									@csrf
									<div class="">
                                        <h3>{{ trans('promotion.from') }} :</h3><br>
										<div class="row mg-b-20">
											<div class="col-lg-3 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('promotion.Grade') }}</p><select name="grade_id" class="form-control select2" required="">
													<option selected disabled label="Choose ..."></option>
                                                    @foreach ($grades as $grade)
                                                        <option value="{{$grade->id}}">{{App::getLocale() == 'en'?$grade->grade_name_en:$grade->grade_name_ar}}</option>
                                                    @endforeach
												</select>
											</div><!-- col-4 -->

											<div class="col-lg-3 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('promotion.Class') }}</p>
                                                <select class="form-control select2" required="" name="classe_id">
                                                    {{-- <option selected disabled label="Choose one"></option> --}}

												</select>
											</div><!-- col-4 -->
											<div class="col-lg-3 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('promotion.section') }}</p><select name="section_id" class="form-control select2" required="">
                                                    <option selected disabled label="Choose ..."></option>

												</select>
											</div><!-- col-4 -->
                                            <div class="col-lg-3 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('promotion.academic_year') }}</p><select name="season" class="form-control" required="">
													<option selected disabled label="Choose one"></option>
														@php
														$current_year = date("Y");
														@endphp
														@for($i=$current_year; $i<=$current_year +1 ;$i++)
															<option value="{{ $i}}">{{ $i }}</option>
														@endfor
												</select>
											</div><!-- col-4 -->
										</div>
									</div><br>
									<div class="">
                                        <h3>{{ trans('promotion.to') }} :</h3><br>
										<div class="row mg-b-20">
											<div class="col-lg-3 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('promotion.Grade') }}</p><select name="new_grade_id" class="form-control select2" required="">
													<option selected disabled label="Choose ..."></option>
                                                    @foreach ($grades as $grade)
                                                        <option value="{{$grade->id}}">{{App::getLocale() == 'en'?$grade->grade_name_en:$grade->grade_name_ar}}</option>
                                                    @endforeach

												</select>
											</div><!-- col-4 -->

											<div class="col-lg-3 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('promotion.Class') }}</p>
                                                <select class="form-control select2" required="" name="new_classe_id">
                                                    {{-- <option selected disabled label="Choose one"></option> --}}

												</select>
											</div><!-- col-4 -->
											<div class="col-lg-3 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('promotion.section') }}</p><select name="new_section_id" class="form-control select2" required="">

												</select>
											</div><!-- col-4 -->
											<div class="col-lg-3 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('promotion.academic_year') }}</p><select name="new_season" class="form-control" required="">
														@php
														$current_year = date("Y");
														@endphp
														@for($i=$current_year; $i<=$current_year +1 ;$i++)
															<option value="{{ $i}}">{{ $i }}</option>
														@endfor
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

@if (App::getLocale() == 'en')
    <script>
        $(document).ready(function () {
            $('select[name="new_grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classess') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="new_classe_id"]').empty();
                            $('select[name="new_classe_id"]').append('<option selected disabled >Choose...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="new_classe_id"]').append('<option value="' + key + '">' + value + '</option>');
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
            $('select[name="new_classe_id"]').on('change', function () {
                var classe_id = $(this).val();
                if (classe_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_ssections') }}/" + classe_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="new_section_id"]').empty();
                            $('select[name="new_section_id"]').append('<option selected disabled >Choose...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="new_section_id"]').append('<option value="' + key + '">' + value + '</option>');
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
        $('select[name="new_grade_id"]').on('change', function () {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_classessar') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="new_classe_id"]').empty();
                        $('select[name="new_classe_id"]').append('<option selected disabled >Choose...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="new_classe_id"]').append('<option value="' + key + '">' + value + '</option>');
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
        $('select[name="new_classe_id"]').on('change', function () {
            var classe_id = $(this).val();
            if (classe_id) {
                $.ajax({
                    url: "{{ URL::to('Get_ssectionsar') }}/" + classe_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="new_section_id"]').empty();
                        $('select[name="new_section_id"]').append('<option selected disabled >Choose...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="new_section_id"]').append('<option value="' + key + '">' + value + '</option>');
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
