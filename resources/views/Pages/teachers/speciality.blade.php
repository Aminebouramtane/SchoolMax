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
							<h4 class="content-title mb-0 my-auto">{{ trans('teachers.Teacher') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('teachers.specialization') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">

						<div class="pr-1 mb-3 mb-xl-0">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#modaldemo8">{{ trans('teachers.Add_specialization') }}</a>
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
												<th class="wd-305p border-bottom-0">{{ trans('teachers.specialization') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('grades.action') }}</th>
											</tr>
										</thead>
										<tbody>
											<?php $e=0 ?>
											@foreach ($Specility as $sp)
											<?php $e++ ?>
											<tr>
												<td>{{ $e }}</td>
												<td>{{App::getLocale() == 'ar'?$sp->specialit_name_ar:$sp->specialit_name_en}}</td>
												<td>
													<button type="button" class="btn btn-info btn-sm" data-target="#edit{{ $sp->id }}" data-toggle="modal"><i class="fa fa-edit"></i>
													</button>
													<button type="button" class="btn btn-danger btn-sm" data-target="#delete{{ $sp->id }}" data-toggle="modal"><i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>
                        {{-- UPDATE_modal_Grade --}}
                        <div class="modal fade" id="edit{{ $sp->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            {{ trans('teachers.Edit_specialization') }}
                                        </h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">


                                        {{-- edit_form --}}
											<form action="{{route("specilits.update",$sp->id)}}" method="post">
												@method("PUT")
												@csrf
												<div class="row">
													<div class="col">
														<label for="Name" id="Name" class="mr-sm-2">
															{{ trans('teachers.Name_specialization_ar') }} :
														</label>
														<input type="text" name="specialit_name_ar" value="{{$sp->specialit_name_ar}}" id="Name" class="form-control" required>
														<input type="text" value="{{ $sp->id }}" name="id" id="" hidden>
													</div>
													<div class="col">
														<label for="Name_en" id="Name" class="mr-sm-2">
															{{ trans('teachers.Name_specialization_en') }} :
														</label>
														<input type="text" name="specialit_name_en" value="{{$sp->specialit_name_en}}" class="form-control" required>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades.Close') }}</button>
													<button type="submit" class="btn btn-primary">{{ trans('grades.submit') }}</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>


							{{-- DELETE_modal_Grade --}}
							<div class="modal fade" id="delete{{ $sp->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">
												{{ trans('teachers.Delete_Specialization') }}
											</h5>
											<button class="close" type="button" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											{{-- add_form --}}
											<form action="{{route("specilits.destroy",$sp->id)}}" method="post">
												@method("DELETE")
												@csrf
												<div class="row">
													<div class="col">
														<label for="Name" id="Name" class="mr-sm-2">
															{{ trans('classes.Warning_class') }}
														</label>
													</div>
												</div><br>
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

					{{-- modal with effects --}}
					<div class="modal" id="modaldemo8">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">{{ trans('teachers.Add_specialization') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form action="{{route("specilits.store")}}" method="post">
										@csrf
										<div class="row">
											<div class="col">
												<label for="grade_name_en" id="Name" class="mr-sm-2">
													{{ trans('teachers.Name_specialization_en') }} :
												</label>
												<input type="text" name="specialit_name_en" id="Name" class="form-control" value="">
											</div>
											<div class="col">
												<label for="grade_name_ar" id="Name" class="mr-sm-2">
													{{ trans('teachers.Name_specialization_ar') }} :
												</label>
												<input type="text" name="specialit_name_ar" class="form-control" value="">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades.Close') }}</button>
											<button type="submit" class="btn btn-primary">{{ trans('grades.submit') }}</button>
										</div>
									</form>
								</div>

							</div>
						</div>
					</div>
					{{-- end modal with effects --}}




				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

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
