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
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#exampleModal">{{ trans('fees.add_fees') }}</a>
						</div>

					</div>
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
												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-20p border-bottom-0">{{ trans('fees.name_fees') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('fees.amount') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('promotion.Class') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('promotion.Grade') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('fees.description') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('grades.action') }}</th>
											</tr>
										</thead>
										<tbody>
											<?php $e=0 ?>
											@foreach ($Fees_invoices as $feees)
											<?php $e++ ?>
											<tr>
												<td>{{ $e }}</td>
												<td>{{App::getLocale() == 'ar'?$feees->Fees->fees_name_ar:$feees->Fees->fees_name_en}}</td>
												<td>{{$feees->amount}}</td>
												<td>{{App::getLocale() == 'ar'?$feees->Classes->classe_name_ar:$feees->Classes->classe_name_en}}</td>
												<td>{{App::getLocale() == 'ar'?$feees->Grades->grade_name_ar:$feees->Grades->grade_name_en}}</td>
												<td>{{$feees->description}}</td>
												<td>
													<button type="button" class="btn btn-info btn-sm" data-target="#edit{{ $feees->id }}" data-toggle="modal"><i class="fa fa-edit"></i>
													</button>
													<button type="button" class="btn btn-danger btn-sm" data-target="#Delete_Fee_invoice{{ $feees->id }}" data-toggle="modal"><i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>

						<div class="modal fade" id="edit{{ $feees->id }}" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
										id="exampleModalLabel">
										{{ trans('fees.edit_fees') }}:
									</h5>
									<button type="button" class="close" data-dismiss="modal"
											aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<!-- edit_form -->
									<form action="{{route("fees_invoices.update",$feees->id )}}" method="post">
										@method("PUT")
										@csrf
										<div class="row">
														<div class="col-12">
															<label
																for="exampleFormControlTextarea1">{{ trans('promotion.Name_student') }}
																:</label>
															<select class="form-control form-control-lg"
																	id="exampleFormControlSelect1" name="student_id">
																<option value="{{$feees->Students->id}}">{{App::getLocale() == 'en'?$feees->Students->student_name_en:$feees->Students->student_name_ar}}</option>
															</select>
														</div>
														<div class="col-12">
															<label
																for="exampleFormControlTextarea1">{{ trans('fees.name_fees') }}
																:</label>
															<select class="form-control form-control-lg"
																	id="exampleFormControlSelect1" name="fees_id">
																<option value="{{$feees->Fees->id}}">{{App::getLocale() == 'en'?$feees->Fees->fees_name_en:$feees->Fees->fees_name_ar}}</option>
																@foreach ($Fees as $fees)
																	<option value="{{$fees->id}}">{{App::getLocale() == 'en'?$fees->fees_name_en:$fees->fees_name_ar}}</option>
																@endforeach
															</select>
														</div>
														<div class="col-12">
															<label
																for="exampleFormControlTextarea1">{{ trans('fees.amount') }}
																:</label>
															<select class="form-control form-control-lg"
																	id="exampleFormControlSelect1" name="amount">
																@foreach ($Fees as $fee)
																<option value="{{$fee->amount}}" @selected($fee->id == $fees->fees_id?"true":"fale") >{{$fee->amount}}</option>
																@endforeach
															</select>

														</div>

														<div class="col-12">
                                                            <label for="Name"
                                                                class="mr-sm-2">{{ trans('fees.description') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="description"  />
                                                        </div>
										</div><br>


										<div class="modal-footer">
											<button type="button" class="btn btn-secondary"
													data-dismiss="modal">{{ trans('grades.Close') }}</button>
											<button type="submit"
													class="btn btn-primary">{{ trans('grades.submit') }}</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						</div>
<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_Fee_invoice{{$feees->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('fees.delete_fees') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('fees_invoices.destroy',$feees->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <h5 style="font-family: 'Cairo', sans-serif;">{{ trans('classes.Warning_class') }}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades.Close') }}</button>
                        <button  class="btn btn-danger">{{ trans('grades.Delete') }}</button>
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
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="max-width: 1100px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                    {{ trans('fees.add_fees') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class=" row mb-30" action="{{route("fees_invoices.store")}}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="repeater">
                                            <div data-repeater-list="List_Fees">
                                                <div data-repeater-item>
                                                    <div class="row">
														<div class="form-group">
															<label
																for="exampleFormControlTextarea1">{{ trans('promotion.Name_student') }}
																:</label>
															<select class="form-control form-control-lg"
																	id="exampleFormControlSelect1" name="student_id">

																<option value="{{$Students->id}}">{{App::getLocale() == 'en'?$Students->student_name_en:$Students->student_name_ar}}</option>
															</select>

														</div>


														<div class="form-group">
															<label
																for="exampleFormControlTextarea1">{{ trans('fees.name_fees') }}
																:</label>
															<select class="form-control form-control-lg"
																	id="exampleFormControlSelect1" name="fees_id">
																@foreach ($Fees as $fees)
																	<option value="{{$fees->id}}">{{App::getLocale() == 'en'?$fees->fees_name_en:$fees->fees_name_ar}}</option>
																@endforeach
															</select>

														</div>

														<div class="form-group">
															<label
																for="exampleFormControlTextarea1">{{ trans('fees.amount') }}
																:</label>
															<select class="form-control form-control-lg"
																	id="exampleFormControlSelect1" name="amount">
																@foreach ($Fees as $fees)
																<option value="{{$fees->amount}}">{{$fees->amount}}</option>
																@endforeach
															</select>

														</div>

														<div class="col">
                                                            <label for="Name"
                                                                class="mr-sm-2">{{ trans('fees.description') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="description"  />
                                                        </div>


                                                        <div class="col">
                                                            <label for="Name_en"
                                                                class="mr-sm-2">{{ trans('grades.action') }}
                                                                :</label>
                                                                <button type="button" value="DELETE" class="btn btn-danger btn-block" data-repeater-delete ><i class="fa fa-trash"></i>
                                                                </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row mt-20">
                                                <div class="col-12">
                                                    <input class="btn btn-primary" data-repeater-create type="button" value="ADDED Classe"/>
                                                </div>

                                            </div>
											<input type="hidden" name="grade_id" value="{{$Students->grade_id}}">
											<input type="hidden" name="classe_id" value="{{$Students->classe_id}}">
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

{{-- modal --}}
<!-- jquery -->

<script src="{{ URL::asset('assets/js/mo/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">
    var plugin_path='{{ asset('assets/js/mo') }}/';
</script>


<!-- custom -->
<script src="{{ URL::asset('assets/js/mo/custom.js') }}"></script>




@endsection
