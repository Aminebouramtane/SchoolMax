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
							<h4 class="content-title mb-0 my-auto">{{ trans('fees.fees') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('fees.list_fees') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">

						<div class="pr-1 mb-3 mb-xl-0">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#exampleModal">{{ trans('fees.add_o_fees') }}</a>

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
									<h4 class="card-title mg-b-0">{{ trans('fees.list_fees') }}</h4>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>

												<th class="wd-5p border-bottom-0">#</th>
												<th class="wd-20p border-bottom-0">{{ trans('fees.name_fees') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('fees.amount') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('promotion.Grade') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('promotion.Class') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('promotion.academic_year') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('grades.action') }}</th>
											</tr>
										</thead>
										<tbody>
											<?php $e=0 ?>
											@foreach ($Fees as $fees)
											<?php $e++ ?>
											<tr>
												<td>{{ $e }}</td>
												<td>{{App::getLocale() == 'en'?$fees->fees_name_en:$fees->fees_name_ar}}</td>
												<td>{{$fees->amount}}</td>
												<td>{{App::getLocale() == 'en'?$fees->Grades->grade_name_en:$fees->Grades->grade_name_ar}}</td>
												<td>{{App::getLocale() == 'en'?$fees->Classes->classe_name_en:$fees->Classes->classe_name_ar}}</td>
												<td>{{$fees->season}}</td>
												<td>
													<button type="button" class="btn btn-info btn-sm" data-target="#edit{{$fees->id}}" data-toggle="modal"><i class="fa fa-edit"></i>
													</button>
													<button type="button" class="btn btn-danger btn-sm" data-target="#delete{{$fees->id}}" data-toggle="modal"><i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>
											{{-- DELETE_modal_Grade --}}
											<div class="modal fade" id="delete{{$fees->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
															<form action="{{route("fees.destroy",$fees->id)}}" method="post">
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
													<div class="modal fade" id="edit{{$fees->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
													aria-hidden="true">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
																	{{ trans('fees.edit_fees') }}
																</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">

																<form class=" row mb-30" action="{{route("fees.update",$fees->id)}}" method="POST">
																	@method("PUT")
																	@csrf
																	<div class="card-body">
																		<div class="repeater">
																			<div data-repeater-list="List_Classes">
																				<div data-repeater-item>
																					<div class="row">
																						<div class="parsley-input col-md-6" id="fnWrapper">
																							<label>{{ trans('fees.fees_en') }}: </label>
																							<input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$fees->fees_name_en}}" name="fees_name_en" required="" type="text">
																						</div>
																						<div class="parsley-input col-md-6" id="fnWrapper">
																							<label>{{ trans('fees.fees_ar') }}:</label>
																							<input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$fees->fees_name_ar}}" name="fees_name_ar" required="" type="text"><br>
																						</div><br>
																						<div class="parsley-input col-md-12" id="fnWrapper">
																							<label>{{ trans('fees.amount') }}:</label>
																							<input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$fees->amount}}" name="amount" required="" type="text">
																						</div>
																					</div><br>
																					<div class="row">

																						{{-- content --}}
																						<div class="col">
																							<label for="inputName"
																									class="control-label">{{ trans('promotion.Grade') }}</label>
																							<select name="grade_id" class="custom-select"
																									onchange="console.log($(this).val())">
																								<!--placeholder-->
																								<option value="{{$fees->Grades->id}}" selected>{{App::getLocale() == 'en'?$fees->Grades->grade_name_en:$fees->Grades->grade_name_ar}}
																								</option>
																								@foreach ($Grade_list as $list_Grade)
																								<option value="{{ $list_Grade->id }}"> {{ App::getLocale() == 'en'?$list_Grade->grade_name_en:$list_Grade->grade_name_ar }}
																								</option>
																								@endforeach
																							</select>
																						</div>
																						<div class="col">
																							<label for="inputName"
																									class="control-label">{{ trans('promotion.Class') }}</label>
																							<select name="classe_id" class="custom-select">
																								<option selected value="{{$fees->Classes->id}}">{{App::getLocale() == 'en'?$fees->Classes->classe_name_en:$fees->Classes->classe_name_ar}}</option>

																							</select>
																						</div>
																						<div class="col">
																							<p class="mg-b-10">{{ trans('promotion.academic_year') }}</p><select name="season" class="form-control" required="">
																								<option selected label="Choose one">{{$fees->season}}</option>
																									@php
																									$current_year = date("Y");
																									@endphp
																									@for($i=$current_year; $i<=$current_year +1 ;$i++)
																										<option value="{{ ($i-1).'-'.($i)}}">{{ $i-1 }}-{{ $i }}</option>
																									@endfor
																							</select>
																						</div><br>

																					</div>

																					<div class="form-group">
																						<label for="exampleFormControlTextarea1">
																							{{ trans('fees.description') }} :
																						</label>
																						<textarea class="form-control" name="grade_note" id="exampleFormControlTextarea1" rows="3" >{{App::getLocale() == 'en'?$fees->note:$fees->note}}</textarea>
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
                                    {{ trans('fees.add_o_fees') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form class=" row mb-30" action="{{route("fees.store")}}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="repeater">
                                            <div data-repeater-list="List_Classes">
                                                <div data-repeater-item>
													<div class="row">
														<div class="parsley-input col-md-6" id="fnWrapper">
															<label>{{ trans('fees.fees_en') }}: </label>
															<input class="form-control" data-parsley-class-handler="#fnWrapper" name="fees_name_en" required="" type="text">
														</div>
														<div class="parsley-input col-md-6" id="fnWrapper">
															<label>{{ trans('fees.fees_ar') }}:</label>
															<input class="form-control" data-parsley-class-handler="#fnWrapper" name="fees_name_ar" required="" type="text"><br>
														</div><br>
														<div class="parsley-input col-md-12" id="fnWrapper">
															<label>{{ trans('fees.amount') }}:</label>
															<input class="form-control" data-parsley-class-handler="#fnWrapper" name="amount"  required="" type="text">
														</div>
													</div><br>
                                                    <div class="row">

														{{-- content --}}
														<div class="col">
															<label for="inputName"
																   class="control-label">{{ trans('promotion.Grade') }}</label>
															<select name="grade_id" class="custom-select"
																	onchange="console.log($(this).val())">
                                                                <option selected disabled label="Choose one"></option>
																@foreach ($Grade_list as $list_Grade)
																<option value="{{ $list_Grade->id }}"> {{ App::getLocale() == 'en'?$list_Grade->grade_name_en:$list_Grade->grade_name_ar }}
																</option>
																@endforeach
															</select>
														</div>
														<div class="col">
															<label for="inputName"
																   class="control-label">{{ trans('promotion.Class') }}</label>
															<select name="classe_id" class="custom-select">
                                                                <option selected disabled label="Choose one"></option>

															</select>
														</div>
														<div class="col">
															<p class="mg-b-10">{{ trans('promotion.academic_year') }}</p><select name="season" class="form-control" required="">
																<option selected disabled label="Choose one"></option>
																	@php
																	$current_year = date("Y");
																	@endphp
																	@for($i=$current_year; $i<=$current_year +1 ;$i++)
																		<option value="{{ ($i-1).'-'.($i)}}">{{ $i-1 }}-{{ $i }}</option>
																	@endfor
															</select>
														</div><br>

                                                    </div>

													<div class="form-group">
														<label for="exampleFormControlTextarea1">
															{{ trans('fees.description') }} :
														</label>
														<textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3" ></textarea>
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
