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
							<h4 class="content-title mb-0 my-auto">{{ trans('classes.title_page') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('classes.List_classes') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">

						<div class="pr-1 mb-3 mb-xl-0">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#exampleModal">{{ trans('classes.add_class') }}</a>

						</div>
						<div class="pr-1"></div>
						<button type="button" class="modal-effect btn btn-outline-danger x-small" id="btn_delete_all" data-toggle="modal" data-target="#delete_all">
							{{ trans('classes.delete_checkbox') }}
						</button>

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

												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-20p border-bottom-0">{{ trans('classes.Name') }}</th>
												<th class="wd-20p border-bottom-0">{{ trans('classes.Name_Grade') }}</th>
												<th class="wd-10p border-bottom-0">{{ trans('grades.action') }}</th>
												<th class="wd-5p border-bottom-0"><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
											</tr>
										</thead>
										<tbody>
											<?php $e=0 ?>
											@foreach ($Classes as $Classe)
											<?php $e++ ?>
											<tr>
												<td>{{ $e }}</td>
												<td>{{App::getLocale() == 'ar'?$Classe->classe_name_ar:$Classe->classe_name_en}}</td>
												<td>{{  App::getLocale() == 'ar'?$Classe->Grades->grade_name_ar:$Classe->Grades->grade_name_en}}</td>
												<td>
													<button type="button" class="btn btn-info btn-sm" data-target="#edit{{ $Classe->id }}" data-toggle="modal"><i class="fa fa-edit"></i>
													</button>
													<button type="button" class="btn btn-danger btn-sm" data-target="#delete{{ $Classe->id }}" data-toggle="modal"><i class="fa fa-trash"></i>
													</button>
												</td>
												<td><input type="checkbox" value="{{ $Classe->id }}" class="box1" ></td>
											</tr>
                        {{-- UPDATE_modal_Grade --}}
						<div class="modal fade" id="edit{{ $Classe->id }}" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
										id="exampleModalLabel">
										Update_My_Classes_::
									</h5>
									<button type="button" class="close" data-dismiss="modal"
											aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<!-- edit_form -->
									<form action="{{route("updatee")}}" method="post">
										@csrf
										<div class="row">
											<div class="col">
												<label for="Name"
														class="mr-sm-2">{{ trans('classes.Name_class_en') }}
													:</label>
												<input id="Name" type="text" name="classe_name_en"
														class="form-control"
														value="{{$Classe->classe_name_en}}"
														required>
														<input type="text" name="id" value="{{$Classe->id}}" hidden>
											</div>
											<div class="col">
												<label for="Name_en"
														class="mr-sm-2">{{ trans('classes.Name_class') }}
													:</label>
												<input type="text" class="form-control"
														value="{{$Classe->classe_name_ar}}"
														name="classe_name_ar" required>
											</div>
										</div><br>
										<div class="form-group">
											<label
												for="exampleFormControlTextarea1">{{ trans('classes.Name_Grade') }}
												:</label>
											<select class="form-control form-control-lg"
													id="exampleFormControlSelect1" name="grade_id">
													<option value="{{ $Classe->Grades->id }}" readonly >
                                                        {{ App::getLocale() == 'ar'?$Classe->Grades->grade_name_ar:$Classe->Grades->grade_name_en}}
                                                    </option>
												@foreach ($Grades as $Grade)
													<option value="{{ $Grade->id }}">
														{{ App::getLocale() == 'ar'?$Grade->grade_name_ar:$Grade->grade_name_en }}
													</option>
												@endforeach
											</select>

										</div>
										<br><br>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary"
													data-dismiss="modal">{{ trans('classes.Close') }}</button>
											<button type="submit"
													class="btn btn-primary">{{ trans('classes.submit') }}</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						</div>
											{{-- DELETE_modal_Grade --}}
											<div class="modal fade" id="delete{{ $Classe->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">
																{{ trans('classes.delete_classe') }}
															</h5>
															<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															{{-- add_form --}}
															<form action="{{route("supp")}}" method="post">
																@csrf
																<div class="row">
																	<div class="col">
																		<label for="Name" id="Name" class="mr-sm-2">
																			{{ trans('classes.Warning_class') }}
																		</label>
																		<input type="text" name="id" value="{{$Classe->id}}" hidden>
																	</div>
																</div><br><br>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('classes.Close') }}</button>
																	<button type="submit" class="btn btn-danger">{{ trans('classes.Delete') }}</button>
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
                        {{-- delete selected classes --}}
                        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                    {{ trans('classes.delete_checkbox') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="{{route("delete_all")}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    {{ trans('classes.Warning_class') }}
                                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('classes.Close') }}</button>
                                    <button type="submit" class="btn btn-danger">{{ trans('classes.Delete') }}</button>
                                </div>
                            </form>
                        </div>
                        </div>
                        </div>
						{{-- end delete selected  --}}

					{{-- modal with effects --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                    {{ trans('classes.add_class') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form class=" row mb-30" action="{{route("classes.store")}}" method="POST">
                                    @csrf

                                    <div class="card-body">
                                        <div class="repeater">
                                            <div data-repeater-list="List_Classes">
                                                <div data-repeater-item>

                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="Name"
                                                                class="mr-sm-2">{{ trans('classes.Name_class_en') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="classe_name_en"  />
                                                        </div>


                                                        <div class="col">
                                                            <label for="Name"
                                                                class="mr-sm-2">{{ trans('classes.Name_class') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="classe_name_ar" />
                                                        </div>


														<div class="form-group">
															<label
																for="exampleFormControlTextarea1">{{ trans('classes.Name_Grade') }}
																:</label>
															<select class="form-control form-control-lg"
																	id="exampleFormControlSelect1" name="grade_id">
																@foreach ($Grades as $Grade)
																	<option value="{{ $Grade->id }}">
																		{{ App::getLocale() == 'ar'?$Grade->grade_name_ar:$Grade->grade_name_en }}
																	</option>
																@endforeach
															</select>

														</div>

                                                        <div class="col">
                                                            <label for="Name_en"
                                                                class="mr-sm-2">{{ trans('grades.action') }}
                                                                :</label>
                                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                                type="button" value="{{trans('classes.Delete')}}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row mt-20">
                                                <div class="col-12">
                                                    <input class="btn btn-primary" data-repeater-create type="button" value="{{trans('classes.add_row')}}"/>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('classes.Close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-primary">{{ trans('classes.submit') }}</button>
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


<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;
        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>
{{-- to show modal --}}
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#example1 input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
            console.log(selected);
        });
    });
</script>

@endsection
