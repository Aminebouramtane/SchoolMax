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
							<h4 class="content-title mb-0 my-auto">{{ trans('promotion.promotions') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('promotion.list_promotion') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
                            <a href="#"
                            class="btn btn-sm btn-danger"
                            data-toggle="modal"
                            data-target="#delete">{{ trans('promotion.Rollback') }}</a>
                            {{-- {{route("promotions.rollback")}} --}}
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
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">{{ trans('promotion.list_promotion') }}</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table key-buttons text-md-nowrap">
						<thead>
							<tr>
								<th class="border-bottom-0 alert-info">{{ trans('promotion.Name_student') }}</th>
								<th class="border-bottom-0 alert-danger">{{ trans('promotion.Old_Grade') }}</th>
								<th class="border-bottom-0 alert-danger">{{ trans('promotion.Old_Classe') }}</th>
								<th class="border-bottom-0 alert-danger">{{ trans('promotion.Old_Section') }}</th>
								<th class="border-bottom-0 alert-danger">{{ trans('promotion.Old_Season') }}</th>

								<th class="border-bottom-0 alert-success">{{ trans('promotion.New_Grade') }}</th>
								<th class="border-bottom-0 alert-success">{{ trans('promotion.New_Classe') }}</th>
								<th class="border-bottom-0 alert-success">{{ trans('promotion.New_Section') }}</th>
								<th class="border-bottom-0 alert-success">{{ trans('promotion.New_Season') }}</th>
								<th class="border-bottom-0 alert-danger">{{ trans('grades.action') }}</th>
							</tr>
						</thead>

						<tbody>
							<?php $i=0 ?>
							@foreach ($Promotions as $Promotion)
							<?php $i++ ?>
							<tr>

                                <td>{{App::getLocale() == 'en'?$Promotion->Students->student_name_en:$Promotion->Students->student_name_ar}}</td>

                                <td>{{App::getLocale() == 'en'?$Promotion->f_Grades->grade_name_en:$Promotion->f_Grades->grade_name_ar}}</td>
                                <td>{{App::getLocale() == 'en'?$Promotion->f_Classes->classe_name_en:$Promotion->f_Classes->classe_name_ar}}</td>
                                <td>{{App::getLocale() == 'en'?$Promotion->f_Sections->section_name_en:$Promotion->f_Sections->section_name_ar}}</td>
                                <td>{{$Promotion->season}}</td>

                                <td>{{App::getLocale() == 'en'?$Promotion->t_Grades->grade_name_en:$Promotion->t_Grades->grade_name_ar}}</td>
                                <td>{{App::getLocale() == 'en'?$Promotion->t_Classes->classe_name_en:$Promotion->t_Classes->classe_name_ar}}</td>
                                <td>{{App::getLocale() == 'en'?$Promotion->t_Sections->section_name_en:$Promotion->t_Sections->section_name_ar}}</td>
                                <td>{{$Promotion->new_season}}</td>
								<td>
									<a href="#"
									class="btn btn-sm btn-danger"
									data-toggle="modal"
									data-target="#delete{{ $Promotion->id }}"><i class="las la-trash"></i></a>
								</td>
							</tr>

												{{-- START DELETE MODAL --}}
												<div class="modal fade"
												id="delete{{ $Promotion->id }}"
												tabindex="-1" role="dialog"
												aria-labelledby="exampleModalLabel"
												aria-hidden="true">
											   <div class="modal-dialog" role="document">
												   <div class="modal-content">
													   <div class="modal-header">
														   <h5 style="font-family: 'Cairo', sans-serif;"
															   class="modal-title"
															   id="exampleModalLabel">
															   {{ trans('promotion.delete') }}
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
															   action="{{ route('promotions.destroy', $Promotion->id) }}"
															   method="post">
															   @method("DELETE")
															   @csrf
															   {{ trans('classes.Warning_class') }}
															   <div class="modal-footer">
																   <button type="button"
																		   class="btn btn-secondary"
																		   data-dismiss="modal">{{ trans('grades.Close') }}</button>
																   <button type="submit"
																		   class="btn btn-danger">{{ trans('grades.Delete') }}</button>
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
    												{{-- START DELETE MODAL --}}
                                                    <div class="modal fade"
                                                    id="delete"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                   <div class="modal-dialog" role="document">
                                                       <div class="modal-content">
                                                           <div class="modal-header">
                                                               <h5 style="font-family: 'Cairo', sans-serif;"
                                                                   class="modal-title"
                                                                   id="exampleModalLabel">
                                                                   {{ trans('promotion.Rollback') }}
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
                                                                   action="{{ route('promotions.destroy','test') }}"
                                                                   method="post">
                                                                   @method("DELETE")
                                                                   @csrf
                                                                   {{ trans('promotion.rollback_warning') }}
                                                                   <input type="hidden" name="page_id" value="1" id="">
                                                                   <div class="modal-footer">
                                                                       <button type="button"
                                                                               class="btn btn-secondary"
                                                                               data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                                                       <button type="submit"
                                                                               class="btn btn-danger">{{ trans('promotion.Rollback') }}</button>
                                                                   </div>
                                                               </form>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>

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
