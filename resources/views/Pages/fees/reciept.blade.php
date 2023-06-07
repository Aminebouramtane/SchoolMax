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
							<h4 class="content-title mb-0 my-auto">{{ trans('fees.fees') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('fees.payed') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">

						<div class="pr-1 mb-3 mb-xl-0">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#exampleModal"> {{ trans('fees.add_amount') }}</a>

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
									<h4 class="card-title mg-b-0">{{ trans('fees.payed') }}</h4>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">#</th>
												<th class="wd-20p border-bottom-0">{{ trans('fees.amount') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('fees.description') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('grades.action') }}</th>
											</tr>
										</thead>
										<tbody>
											<?php $e=0 ?>
											@foreach ($Reciept as $res)
											<?php $e++ ?>
											<tr>
												<td>{{ $e }}</td>
												<td>{{$res->Debit}}</td>
												<td>{{$res->description}}</td>
												<td>
													<button type="button" class="btn btn-info btn-sm" data-target="#edit{{$res->id}}" data-toggle="modal"><i class="fa fa-edit"></i>
													</button>
													<button type="button" class="btn btn-danger btn-sm" data-target="#delete{{$res->id}}" data-toggle="modal"><i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>
											{{-- DELETE_modal_Grade --}}
											<div class="modal fade" id="delete{{$res->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
															<form action="{{route("receipt_students.destroy",$res->id)}}" method="post">
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
																{{-- modal update with effects --}}
																<div class="modal fade" id="edit{{$res->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
																aria-hidden="true">
																<div class="modal-dialog modal-lg">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
																				{{ trans('fees.edit_reciept') }}
																			</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																			</button>
																		</div>
																		<div class="modal-body">

																			<form class=" row mb-30" action="{{route("receipt_students.update",$res->id)}}" method="POST">
																				@method("PUT")
																				@csrf
																				<div class="card-body">
																					<div class="repeater">
																						<div data-repeater-list="List_Classes">
																							<div data-repeater-item>
																								<div class="row">
																									<div class="parsley-input col-md-12" id="fnWrapper">
																										<label>{{ trans('fees.amount') }}: </label>
																										<input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$res->Debit}}" name="debit" required="" type="text">
																										<input type="hidden" name="student_id" value="{{$Ids}}" id="">
																									</div>
																									</div>
																								</div><br>
																								<div class="form-group">
																									<label for="exampleFormControlTextarea1">
																										{{ trans('fees.description') }} :
																									</label>
																									<textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" >{{$res->description}}</textarea>
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
                                    {{ trans('fees.add_reciept') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form class=" row mb-30" action="{{route("receipt_students.store")}}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="repeater">
                                            <div data-repeater-list="List_Classes">
                                                <div data-repeater-item>
													<div class="row">
														<div class="parsley-input col-md-12" id="fnWrapper">
															<label>{{ trans('fees.amount') }}: </label>
															<input class="form-control" data-parsley-class-handler="#fnWrapper" name="debit" required="" type="text">
															<input type="hidden" name="student_id" value="{{$Ids}}" id="">
														</div>
														</div>
													</div><br>
													<div class="form-group">
														<label for="exampleFormControlTextarea1">
															{{ trans('fees.description') }} :
														</label>
														<textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" ></textarea>
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
