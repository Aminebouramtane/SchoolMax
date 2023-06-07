@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
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
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('exams.exam') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('exams.list_exam') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">

						<div class="pr-1 mb-3 mb-xl-0">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#exampleModal">{{ trans('exams.add_exam') }}</a>

						</div>

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


				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{ trans('exams.list_exam') }}</h4>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>

												<th class="wd-5p border-bottom-0">#</th>
												<th class="wd-10p border-bottom-0">{{ trans('exams.name_exam') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('exams.Grade') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('exams.Class') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('exams.section') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('exams.Name_Teacher') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('subjects.name_subject') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('grades.action') }}</th>
											</tr>
										</thead>
										<tbody>
											<?php $e=0 ?>
											@foreach ($Exams as $exam)
											<?php $e++ ?>
											<tr>
												<td>{{ $e }}</td>
												<td>{{App::getLocale()=='en'?$exam->exam_name_en:$exam->exam_name_ar}}</td>
												<td>{{App::getLocale()=='en'?$exam->Grades->grade_name_en:$exam->Grades->grade_name_ar}}</td>
												<td>{{App::getLocale()=='en'?$exam->Classes->classe_name_en:$exam->Classes->classe_name_ar}}</td>
												<td>{{App::getLocale()=='en'?$exam->Sections->section_name_en:$exam->Sections->section_name_ar}}</td>
												<td>{{App::getLocale()=='en'?$exam->Teachers->teacher_name_en:$exam->Teachers->teacher_name_ar}}</td>
												<td>{{App::getLocale()=='en'?$exam->Subjects->name_subject_en:$exam->Subjects->name_subject_ar}}</td>
												<td>
													<button type="button" class="btn btn-info btn-sm" data-target="#edit{{$exam->id}}" data-toggle="modal"><i class="fa fa-edit"></i>
													</button>
													<button type="button" class="btn btn-danger btn-sm" data-target="#delete{{$exam->id}}" data-toggle="modal"><i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>
											{{-- DELETE_modal_Grade --}}
											<div class="modal fade" id="delete{{$exam->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">
																{{ trans('grades.Delete') }}
															</h5>
															<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>

														<div class="modal-body">
															{{-- add_form --}}
															<form action="{{route("exams.destroy",$exam->id)}}" method="post">
																@method("DELETE")
																@csrf
																<div class="row">
																	<div class="col">
																		<label for="Name" id="Name" class="mr-sm-2">
																			{{ trans('classes.Warning_class') }}
																		</label>
																	</div>
																</div><br><br>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades.Close') }}</button>
																	<button type="submit" class="btn btn-danger">{{ trans('grades.Delete') }}</button>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>

													{{-- modal Edit with effects --}}
                                                    <div class="modal fade" id="edit{{$exam->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                    {{ trans('fees.edit_process') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class=" row mb-30" action="{{route("exams.update",$exam->id)}}" method="POST">
                                                                    @csrf
                                                                    @method("PUT")
                                                                    <div class="card-body">
                                                                        <div class="repeater">
                                                                            <div data-repeater-list="List_Classes">
                                                                                <div data-repeater-item>
                                                                                    <div class="row">
                                                                                        <div class="parsley-input col-md-6" id="fnWrapper">
                                                                                            <label>{{ trans('exams.name_exam_en') }}: </label>
                                                                                            <input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$exam->exam_name_en}}" name="exam_name_en" required="" type="text">
                                                                                        </div>
                                                                                        <div class="parsley-input col-md-6" id="fnWrapper">
                                                                                            <label>{{ trans('exams.name_exam_ar') }}:</label>
                                                                                            <input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$exam->exam_name_ar}}" name="exam_name_ar" required="" type="text"><br>
                                                                                        </div>
                                                                                    </div><br>
																					<div class="row">

																						<div class="col">
																							<p class="mg-b-10">{{ trans('subjects.Grade') }}</p><select name="grade_id" class="form-control select2" required="">
																								<option selected value="{{$exam->Grades->id}}">{{App::getLocale()=='en'?$exam->Grades->grade_name_en:$exam->Grades->grade_name_ar}}</option>
																								@foreach ($grades as $grade)
																									<option value="{{$grade->id}}">{{App::getLocale()=='en'?$grade->grade_name_en:$grade->grade_name_ar}}</option>
																								@endforeach
																							</select>
																						</div><!-- col-4 -->

																						<div class="col">
																							<p class="mg-b-10">{{ trans('subjects.Class') }}</p>
																							<select class="form-control select2" required="" name="classe_id">
																								<option selected value="{{$exam->Classes->id}}">{{App::getLocale()=='en'?$exam->Classes->classe_name_en:$exam->Classes->classe_name_ar}}</option>

																							</select>
																						</div><!-- col-4 -->
																						<div class="col">
																							<p class="mg-b-10">{{ trans('exams.section') }}</p><select name="section_id" class="form-control select2" required="">
																								<option selected value="{{$exam->Sections->id}}">{{App::getLocale()=='en'?$exam->Sections->section_name_en:$exam->Sections->section_name_ar}}</option>

																							</select>
																						</div><!-- col-4 -->
																					</div><br>
																					<div class="row">
																						<div class="col">
																							<p class="mg-b-10">{{ trans('exams.Name_Teacher') }}</p><select name="teacher_id" class="form-control select2" required="">
																								<option selected value="{{$exam->Teachers->id}}">{{App::getLocale()=='en'?$exam->Teachers->teacher_name_en:$exam->Teachers->teacher_name_ar}}</option>
																								@foreach ($Teachers as $teacher)
																									<option value="{{$teacher->id}}">{{App::getLocale()=='en'?$teacher->teacher_name_en:$teacher->teacher_name_ar}}</option>
																								@endforeach
																							</select>
																						</div><!-- col-4 -->
																						<div class="col">
																							<p class="mg-b-10">{{ trans('subjects.name_subject') }}</p><select name="subject_id" class="form-control select2" required="">
																								<option selected value="{{$exam->Subjects->id}}">{{App::getLocale()=='en'?$exam->Subjects->name_subject_en:$exam->Subjects->name_subject_ar}}</option>
																								@foreach ($Subjects as $subject)
																									<option value="{{$subject->id}}">{{App::getLocale()=='en'?$subject->name_subject_en:$subject->name_subject_ar}}</option>
																								@endforeach
																							</select>
																						</div><!-- col-4 -->
																					</div>
                                                                                </div>
                                                                            </div><br>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary"
                                                                                    data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">{{ trans('grades.submit') }}</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>


                                                        </div>

                                                    </div>

                                                </div>
													{{-- end Edit modal with effects --}}
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->


					{{-- modal with effects --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                    {{ trans('exams.add_exam') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class=" row mb-30" action="{{route("exams.store")}}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="repeater">
                                            <div data-repeater-list="List_Classes">
                                                <div data-repeater-item>
													<div class="row">
														<div class="parsley-input col-md-6" id="fnWrapper">
															<label>{{ trans('exams.name_exam_en') }}: </label>
															<input class="form-control" data-parsley-class-handler="#fnWrapper" name="exam_name_en" required="" type="text">
														</div>
														<div class="parsley-input col-md-6" id="fnWrapper">
															<label>{{ trans('exams.name_exam_ar') }}:</label>
															<input class="form-control" data-parsley-class-handler="#fnWrapper" name="exam_name_ar" required="" type="text"><br>
														</div>
													</div><br>
                                                    <div class="row">

														<div class="col">
															<p class="mg-b-10">{{ trans('subjects.Grade') }}</p><select name="grade_id" class="form-control select2" required="">
																<option selected disabled label="............."></option>
																@foreach ($grades as $grade)
																	<option value="{{$grade->id}}">{{App::getLocale()=='en'?$grade->grade_name_en:$grade->grade_name_ar}}</option>
																@endforeach
															</select>
														</div><!-- col-4 -->

														<div class="col">
															<p class="mg-b-10">{{ trans('subjects.Class') }}</p>
															<select class="form-control select2" required="" name="classe_id">

															</select>
														</div><!-- col-4 -->
														<div class="col">
															<p class="mg-b-10">{{ trans('exams.section') }}</p><select name="section_id" class="form-control select2" required="">
																<option selected disabled label="..............."></option>

															</select>
														</div><!-- col-4 -->
                                                    </div>
													<div class="row">
														<div class="col">
															<p class="mg-b-10">{{ trans('exams.Name_Teacher') }}</p><select name="teacher_id" class="form-control select2" required="">
																<option selected disabled label="................."></option>
																@foreach ($Teachers as $teacher)
																	<option value="{{$teacher->id}}">{{App::getLocale()=='en'?$teacher->teacher_name_en:$teacher->teacher_name_ar}}</option>
																@endforeach
															</select>
														</div><!-- col-4 -->
														<div class="col">
															<p class="mg-b-10">{{ trans('subjects.name_subject') }}</p><select name="subject_id" class="form-control select2" required="">
																<option selected disabled label="................."></option>
																@foreach ($Subjects as $subject)
																	<option value="{{$subject->id}}">{{App::getLocale()=='en'?$subject->name_subject_en:$subject->name_subject_ar}}</option>
																@endforeach
															</select>
														</div><!-- col-4 -->
													</div>
                                                </div>
                                            </div><br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-primary">{{ trans('grades.submit') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>


                        </div>

                    </div>

                </div>
					{{-- end modal with effects --}}



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
