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
							<h4 class="content-title mb-0 my-auto">{{ trans('sidebar_trans.Dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('subjects.subjects') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">

						<div class="pr-1 mb-3 mb-xl-0">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#exampleModal">{{ trans('subjects.add_subject') }}</a>

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
												<th class="wd-20p border-bottom-0"> {{ trans('subjects.name_subject') }}</th>
												<th class="wd-20p border-bottom-0"> {{ trans('subjects.Grade') }}</th>
												<th class="wd-10p border-bottom-0"> {{ trans('subjects.Class') }}</th>
												<th class="wd-10p border-bottom-0"> {{ trans('subjects.Name_Teacher') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('grades.action') }}</th>
											</tr>
										</thead>
										<tbody>
											<?php $e=0 ?>
											@foreach ($Subjects as $sbj)
											<?php $e++ ?>
											<tr>
												<td>{{ $e }}</td>
												<td>{{App::getLocale() == 'en'?$sbj->name_subject_en:$sbj->name_subject_ar}}</td>
												<td>{{App::getLocale() == 'en'?$sbj->Grades->grade_name_en:$sbj->Grades->grade_name_ar}}</td>
												<td>{{App::getLocale() == 'en'?$sbj->Classes->classe_name_en:$sbj->Classes->classe_name_ar}}</td>
												<td>{{App::getLocale() == 'en'?$sbj->Teachers->teacher_name_en:$sbj->Teachers->teacher_name_ar}}</td>
												<td>
													<button type="button" class="btn btn-info btn-sm" data-target="#edit{{$sbj->id}}" data-toggle="modal"><i class="fa fa-edit"></i>
													</button>
													<button type="button" class="btn btn-danger btn-sm" data-target="#delete{{$sbj->id}}" data-toggle="modal"><i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>
											{{-- DELETE_modal_Grade --}}
											<div class="modal fade" id="delete{{$sbj->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
															<form action="{{route("subjects.destroy",$sbj->id)}}" method="post">
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

                                            {{-- End DELETE_modal_Grade --}}

                                            {{-- start update Model --}}
                                            <div class="modal fade" id="edit{{$sbj->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                                                        <form class=" row mb-30" action="{{route("subjects.update",$sbj->id)}}" method="POST">
                                                            @csrf
                                                            @method("PUT")
                                                            <div class="card-body">
                                                                <div class="repeater">
                                                                    <div data-repeater-list="List_Classes">
                                                                        <div data-repeater-item>
                                                                            <div class="row">
                                                                                <div class="parsley-input col-md-6" id="fnWrapper">
                                                                                    <label>{{ trans('subjects.name_subject_en') }}: </label>
                                                                                    <input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$sbj->name_subject_en}}" name="subject_name_en" required="" type="text">
                                                                                </div>
                                                                                <div class="parsley-input col-md-6" id="fnWrapper">
                                                                                    <label>{{ trans('subjects.name_subject_ar') }}:</label>
                                                                                    <input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$sbj->name_subject_ar}}" name="subject_name_ar" required="" type="text"><br>
                                                                                </div>
                                                                            </div><br>
                                                                            <div class="row">

                                                                                {{-- content --}}
                                                                                <div class="col">
                                                                                    <label for="inputName"
                                                                                        class="control-label">{{ trans('subjects.Grade') }}</label>
                                                                                    <select name="grade_id" class="custom-select"
                                                                                            onchange="console.log($(this).val())">
                                                                                        <!--placeholder-->
                                                                                        <option value="{{$sbj->Grades->id}}" selected >{{ App::getLocale() == 'en'?$sbj->Grades->grade_name_en:$sbj->Grades->grade_name_ar }}</option>
                                                                                        @foreach ($Grade_list as $list_Grade)
                                                                                        <option value="{{ $list_Grade->id }}"> {{ App::getLocale() == 'en'?$list_Grade->grade_name_en:$list_Grade->grade_name_ar }}
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <label for="inputName"
                                                                                        class="control-label">{{ trans('subjects.Class') }}</label>
                                                                                    <select name="classe_id" class="custom-select">
                                                                                        <option value="{{$sbj->Classes->id}}" selected >{{ App::getLocale() == 'en'?$sbj->Classes->classe_name_en:$sbj->Classes->classe_name_ar }}</option>


                                                                                    </select>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <label for="inputName" class="control-label">{{ trans('subjects.Name_Teacher') }}</label>
                                                                                    <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                                                                        <option selected value="{{$sbj->Teachers->id}}">{{App::getLocale() == 'en'?$sbj->Teachers->teacher_name_en:$sbj->Teachers->teacher_name_ar}}</option>
                                                                                        @foreach($Teachers as $teacher)
                                                                                            <option value="{{$teacher->id}}">{{App::getLocale() == 'en'?$teacher->teacher_name_en:$teacher->teacher_name_ar}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
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
                                            {{-- end update model --}}
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
                                    {{ trans('subjects.add_subject') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form class=" row mb-30" action="{{route("subjects.store")}}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="repeater">
                                            <div data-repeater-list="List_Classes">
                                                <div data-repeater-item>
													<div class="row">
														<div class="parsley-input col-md-6" id="fnWrapper">
															<label>{{ trans('subjects.name_subject_en') }}: </label>
															<input class="form-control" data-parsley-class-handler="#fnWrapper" name="subject_name_en" required="" type="text">
														</div>
														<div class="parsley-input col-md-6" id="fnWrapper">
															<label>{{ trans('subjects.name_subject_ar') }}:</label>
															<input class="form-control" data-parsley-class-handler="#fnWrapper" name="subject_name_ar" required="" type="text"><br>
														</div>
													</div><br>
                                                    <div class="row">

														{{-- content --}}
														<div class="col">
															<label for="inputName"
																   class="control-label">{{ trans('subjects.Grade') }}</label>
															<select name="grade_id" class="custom-select"
																	onchange="console.log($(this).val())">
																<!--placeholder-->
																<option value="" selected
																		disabled>Choose...
																</option>
																@foreach ($Grade_list as $list_Grade)
																<option value="{{ $list_Grade->id }}"> {{ App::getLocale() == 'en'?$list_Grade->grade_name_en:$list_Grade->grade_name_ar }}
																</option>
																@endforeach
															</select>
														</div>
														<div class="col">
															<label for="inputName"
																   class="control-label">{{ trans('subjects.Class') }}</label>
															<select name="classe_id" class="custom-select">

															</select>
														</div>
														<div class="col">
															<label for="inputName" class="control-label">{{ trans('subjects.Name_Teacher') }}</label>
                                                            <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                                                <option selected disabled>Choose...</option>
                                                                @foreach($Teachers as $teacher)
                                                                    <option value="{{$teacher->id}}">{{App::getLocale() == 'en'?$teacher->teacher_name_en:$teacher->teacher_name_ar}}</option>
                                                                @endforeach
                                                            </select>
														</div>
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

{{-- modal --}}

@include('layouts.ajax')

@endsection
