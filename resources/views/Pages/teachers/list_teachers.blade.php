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
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('teachers.Teacher') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('teachers.List_Teacher') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<a class="btn btn-outline-primary btn-block" href="{{route("teachers.create")}}">{{ trans('teachers.Add_Teacher') }}</a>
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


<div class="row row-sm">
	<!--div-->
	<div class="col-xl-12">
		<div class="card mg-b-20">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table key-buttons text-md-nowrap">
						<thead>
							<tr>
								<th class="border-bottom-0">#</th>
								<th class="border-bottom-0">{{ trans('teachers.Name_Teacher') }}</th>
								<th class="border-bottom-0">{{ trans('parents.cin') }}</th>
								<th class="border-bottom-0">{{ trans('teachers.specialization') }}</th>
								<th class="border-bottom-0">{{ trans('parents.gender') }}</th>
								<th class="border-bottom-0">{{ trans('parents.birth') }}</th>
								<th class="border-bottom-0">{{ trans('parents.Phone_Father') }}</th>
								<th class="border-bottom-0">{{ trans('teachers.Address') }}</th>
								<th class="border-bottom-0">{{ trans('grades.action') }}</th>
							</tr>
						</thead>

						<tbody>
							<?php $i=0 ?>
							@foreach ($Teachers as $Teacher)
							<?php $i++ ?>
							<tr>
								<td>{{$i}}</td>
								<td>{{App::getLocale() == 'en'?$Teacher->teacher_name_en:$Teacher->teacher_name_ar}}</td>
								<td>{{$Teacher->cin}}</td>
								<td>{{App::getLocale() == 'en'?$Teacher->Specialits->specialit_name_en:$Teacher->Specialits->specialit_name_ar}}</td>
								<td>

									@if (App::getLocale() == 'en')
										@if ($Teacher->sexe==1)
											Male
										@else
											Female
										@endif
									@else
										@if ($Teacher->sexe==1)
												ذكر
											@else
												انثى
											@endif
										@endif
								</td>
								<td>{{$Teacher->birthday}}</td>
								<td>{{$Teacher->phone}}</td>
								<td>{{App::getLocale() == 'en'?$Teacher->adress_en:$Teacher->adress_ar}}</td>
								<td>
									<a href="{{route("teachers.edit",$Teacher->id)}}" class="btn btn-sm btn-info"><i class="las la-pen"></i></a>

									<a href="#"
									class="btn btn-sm btn-danger"
									data-toggle="modal"
									data-target="#delete{{ $Teacher->id }}"><i class="las la-trash"></i></a>
								</td>
							</tr>

												{{-- START DELETE MODAL --}}
												<div class="modal fade"
												id="delete{{ $Teacher->id }}"
												tabindex="-1" role="dialog"
												aria-labelledby="exampleModalLabel"
												aria-hidden="true">
											   <div class="modal-dialog" role="document">
												   <div class="modal-content">
													   <div class="modal-header">
														   <h5 style="font-family: 'Cairo', sans-serif;"
															   class="modal-title"
															   id="exampleModalLabel">
															   {{ trans('teachers.Delete_Teacher') }}
														   </h5>
														   <button type="button" class="close"
																   data-dismiss="modal"
																   aria-label="Close">
														   <span
															   aria-hidden="true">&times;</span>
														   </button>
													   </div>
													   <div class="modal-body">
														   <form
															   action="{{ route('teachers.destroy', $Teacher->id) }}"
															   method="post">
															   @method("DELETE")
															   @csrf
															   {{ trans('classes.Warning_class') }}
															   <div class="modal-footer">
																   <button type="button"
																		   class="btn btn-secondary"
																		   data-dismiss="modal">{{ trans('grades.Close') }}</button>
																   <button type="submit"
																		   class="btn btn-danger">{{ trans('grades.submit') }}</button>
															   </div>
														   </form>
													   </div>
												   </div>
											   </div>
										   </div>

												{{--END DELETE MODAL --}}
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--/div-->
</div>



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
