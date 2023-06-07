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
							<h4 class="content-title mb-0 my-auto">{{ trans('questions.questions') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('questions.list_questions') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">

						<div class="pr-1 mb-3 mb-xl-0">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#exampleModal">{{ trans('questions.add_questions') }}</a>

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
												<th class="wd-30p border-bottom-0">{{ trans('questions.questions') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('exams.name_exam') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('questions.answers') }}</th>
												<th class="wd-15p border-bottom-0">{{ trans('questions.r_answers') }}</th>
												<th class="wd-5p border-bottom-0">{{ trans('questions.score') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('grades.action') }}</th>
											</tr>
										</thead>
										<tbody>
											<?php $e=0 ?>
											@foreach ($Questions as $question)
											<?php $e++ ?>
											<tr>
												<td>{{ $e }}</td>
												<td>{{$question->title}}</td>
												<td>{{App::getLocale()=='en'?$question->Exams->exam_name_en:$question->Exams->exam_name_ar}}</td>
												<td>{{$question->answers}}</td>
												<td>{{$question->right_answer}}</td>
												<td>{{$question->score}}</td>
												<td>
													<button type="button" class="btn btn-info btn-sm" data-target="#edit{{$question->id}}" data-toggle="modal"><i class="fa fa-edit"></i>
													</button>
													<button type="button" class="btn btn-danger btn-sm" data-target="#delete{{$question->id}}" data-toggle="modal"><i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>
											{{-- DELETE_modal_Grade --}}
											<div class="modal fade" id="delete{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
															<form action="{{route("questions.destroy",$question->id)}}" method="post">
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
                                                    <div class="modal fade" id="edit{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                    {{ trans('questions.add_questions') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class=" row mb-30" action="{{route("questions.update",$question->id)}}" method="POST">
                                                                    @csrf
                                                                    @method("PUT")
                                                                    <div class="card-body">
                                                                        <div class="repeater">
                                                                            <div data-repeater-list="List_Classes">
                                                                                <div data-repeater-item>
                                                                                    <div class="row">
                                                                                        <div class="parsley-input col-md-12" id="fnWrapper">
                                                                                            <label>{{ trans('questions.question') }}: </label>
                                                                                            <input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$question->title}}" name="title" placeholder="Enter question" required="" type="text">
                                                                                        </div><br>
                                                                                        <div class="parsley-input col-md-12" id="fnWrapper">
                                                                                            <label>{{ trans('questions.answers') }}:</label>
                                                                                            <input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$question->answers}}" name="answers" placeholder="Enter Answers" required="" type="text"><br>
                                                                                        </div><br>
                                                                                        <div class="parsley-input col-md-12" id="fnWrapper">
                                                                                            <label>{{ trans('questions.r_answers') }}:</label>
                                                                                            <input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$question->right_answer}}" name="right_answer" placeholder="Enter right Answers" required="" type="text"><br>
                                                                                        </div>
                                                                                    </div><br>
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <p class="mg-b-10">{{ trans('exams.name_exam') }}</p><select name="exam_id" class="form-control select2" required="">
                                                                                                <option selected value="{{$question->Exams->id}}">{{App::getLocale()=='en'?$question->Exams->exam_name_en:$question->Exams->exam_name_ar}}</option>
                                                                                                @foreach ($Exams as $exam)
                                                                                                    <option value="{{$exam->id}}">{{App::getLocale()=='en'?$exam->exam_name_en:$exam->exam_name_ar}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div><!-- col-4 -->
                                                                                        <div class="col">
                                                                                            <p class="mg-b-10">{{ trans('questions.score') }}</p><select name="score" class="form-control select2" required="">
                                                                                                <option selected value="{{$question->id}}">{{$question->score}}</option>
                                                                                                <option value="10">1</option>
                                                                                                <option value="20">10</option>
                                                                                                <option value="40">20</option>
                                                                                                <option value="100">100</option>
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
                                    {{ trans('questions.add_questions') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class=" row mb-30" action="{{route("questions.store")}}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="repeater">
                                            <div data-repeater-list="List_Classes">
                                                <div data-repeater-item>
													<div class="row">
														<div class="parsley-input col-md-12" id="fnWrapper">
															<label>{{ trans('questions.question') }}: </label>
															<input class="form-control" data-parsley-class-handler="#fnWrapper" name="title" required="" type="text">
														</div><br>
														<div class="parsley-input col-md-12" id="fnWrapper">
															<label>{{ trans('questions.answers') }}:</label>
															<input class="form-control" data-parsley-class-handler="#fnWrapper" name="answers" required="" type="text"><br>
														</div><br>
														<div class="parsley-input col-md-12" id="fnWrapper">
															<label>{{ trans('questions.r_answers') }}:</label>
															<input class="form-control" data-parsley-class-handler="#fnWrapper" name="right_answer" required="" type="text"><br>
														</div>
													</div><br>
													<div class="row">
														<div class="col">
															<p class="mg-b-10">{{ trans('exams.name_exam') }}</p><select name="exam_id" class="form-control select2" required="">
																<option selected disabled label="Choose ..."></option>
																@foreach ($Exams as $exam)
																	<option value="{{$exam->id}}">{{$exam->exam_name_en}}</option>
																@endforeach
															</select>
														</div><!-- col-4 -->
                                                        <div class="col">
															<p class="mg-b-10">{{ trans('questions.score') }}</p><select name="score" class="form-control select2" required="">
																<option selected disabled label="Choose ..."></option>
																<option value="10">1</option>
																<option value="20">10</option>
																<option value="40">20</option>
																<option value="100">100</option>
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

@endsection
