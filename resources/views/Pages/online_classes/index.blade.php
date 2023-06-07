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
							<h4 class="content-title mb-0 my-auto">{{ trans('sidebar_trans.Dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('online_classes.online_classes') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">

						<div class="pr-1 mb-3 mb-xl-0">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#exampleModal">{{ trans('online_classes.add') }}</a>

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
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">#</th>
                                                <th class="wd-20p border-bottom-0">{{ trans('online_classes.teacher') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('online_classes.title') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('promotion.Grade') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('promotion.Class') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('promotion.section') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('online_classes.date') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('online_classes.duration') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('online_classes.link') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('grades.action') }}</th>
											</tr>
										</thead>
										<tbody>
											<?php $e=0 ?>
											@foreach ($online_classes as $online_classe)
											<?php $e++ ?>
											<tr>
												<td>{{ $e }}</td>
                                                <td>{{$User}}</td>
                                                <td>{{$online_classe->topic}}</td>
												<td>{{App::getLocale()=='en'?$online_classe->Grades->grade_name_en:$online_classe->Grades->grade_name_ar}}</td>
												<td>{{App::getLocale()=='en'?$online_classe->Classes->classe_name_en:$online_classe->Classes->classe_name_ar}}</td>
												<td>{{App::getLocale()=='en'?$online_classe->Sections->section_name_en:$online_classe->Sections->section_name_ar}}</td>
                                                <td>{{$online_classe->start_at}}</td>
                                                <td>{{$online_classe->duration}}</td>
                                                <td class="text-danger"><a href="{{$online_classe->join_url}}" target="_blank">{{ trans('online_classes.join') }}</a></td>
												<td>
													<button type="button" class="btn btn-danger btn-sm" data-target="#delete{{$online_classe->id}}" data-toggle="modal"><i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>
											{{-- DELETE_modal_Grade --}}
											<div class="modal fade" id="delete{{$online_classe->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
															<form action="{{route("exams.destroy",$online_classe->id)}}" method="post">
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
                                    {{ trans('online_classes.add') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class=" row mb-30" action="{{route("online_classes.store")}}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="repeater">
                                            <div data-repeater-list="List_Classes">
                                                <div data-repeater-item>
                                                    <div class="row">
														<div class="col">
															<p class="mg-b-10">{{ trans('promotion.Grade') }}</p><select name="grade_id" class="form-control select2" required="">
																<option selected disabled label="........."></option>
																@foreach ($grades as $grade)
																	<option value="{{$grade->id}}">{{App::getLocale()=='en'?$grade->grade_name_en:$grade->grade_name_ar}}</option>
																@endforeach
															</select>
														</div><!-- col-4 -->

														<div class="col">
															<p class="mg-b-10">{{ trans('promotion.Class') }}</p>
															<select class="form-control select2" required="" name="classe_id">

															</select>
														</div><!-- col-4 -->
														<div class="col">
															<p class="mg-b-10">{{ trans('promotion.section') }}</p><select name="section_id" class="form-control select2" required="">
																<option selected disabled label="............."></option>

															</select>
														</div><!-- col-4 -->
                                                    </div><br>
													<div class="row">
														<div class="col">
															<p class="mg-b-10">{{ trans('promotion.title') }}</p>
                                                            <input class="form-control" data-parsley-class-handler="#fnWrapper" name="topic" required="" type="text">
														</div><!-- col-4 -->
														<div class="col">
															<p class="mg-b-10">{{ trans('subjects.name_subject') }}</p>
                                                            <input class="form-control" type="datetime-local" name="start_time">
														</div><!-- col-4 -->
                                                    </div><br>
													<div class="row">
														<div class="col">
															<p class="mg-b-10">{{ trans('online_classes.time') }}</p>
                                                            <input class="form-control" data-parsley-class-handler="#fnWrapper"  name="duration" required="" type="text">
														</div><!-- col-4 -->
														<div class="col">
															<p class="mg-b-10">{{ trans('online_classes.meeting_id') }}</p>
                                                            <input class="form-control" data-parsley-class-handler="#fnWrapper"  name="meeting_id" required="" type="text">
														</div><!-- col-4 -->
													</div><br>
													<div class="row">
														<div class="col">
															<p class="mg-b-10">{{ trans('online_classes.start_link') }}</p>
                                                            <input class="form-control" data-parsley-class-handler="#fnWrapper" name="start_url" required="" type="text">
														</div><!-- col-4 -->
														<div class="col">
															<p class="mg-b-10">{{ trans('online_classes.student_link') }}</p>
                                                            <input class="form-control" data-parsley-class-handler="#fnWrapper" name="join_url" required="" type="text">
														</div><!-- col-4 -->
														<div class="col">
															<p class="mg-b-10">{{ trans('online_classes.password') }}</p>
                                                            <input class="form-control" data-parsley-class-handler="#fnWrapper"  name="password" required="" type="text">
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
