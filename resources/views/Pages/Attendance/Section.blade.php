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
<!-- Interenal Accordion Css -->
<link href="{{URL::asset('assets/plugins/accordion/accordion.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('sidebar_trans.Dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('sections.title_page') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">
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
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div id="accordion" class="w-100 br-2 overflow-hidden">
                                    @foreach ($Grade_list as $list)
									<div class="">
										<div class="accor bg-primary" id="heading{{$list->id}}">
											<h4 class="m-0">
												<a href="#collapse{{$list->id}}" class="collapsed" data-toggle="collapse" aria-expanded="true" aria-controls="collapse{{$list->id}}">
												   {{App::getLocale() == 'en'?$list->grade_name_en:$list->grade_name_ar}}
												</a>
											</h4>
										</div>
										<div id="collapse{{$list->id}}" class="collapse b-b0 bg-white" aria-labelledby="headingOne" data-parent="#accordion">
											<div class="border p-3">
                                                <div class="card-body">
                                                    <div class="table-responsive border-top userlist-table">
                                                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th class="wd-lg-8p"><span>{{ trans('sections.list_page') }}</span></th>
                                                                    <th class="wd-lg-20p"><span>{{ trans('promotion.Grade') }}</span></th>
                                                                    <th class="wd-lg-20p"><span>{{ trans('sections.Status') }}</span></th>
                                                                    <th class="wd-lg-20p">{{ trans('grades.action') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($list->Sections as $grade)
                                                                    <tr>
                                                                    <td>
                                                                        {{App::getLocale() == 'en'?$grade->section_name_en:$grade->section_name_ar}}
                                                                    </td>

                                                                    <td>
                                                                        {{App::getLocale() == 'en'?$grade->Classes->classe_name_en:$grade->Classes->classe_name_ar}}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @if ($grade->active == 0)
                                                                        <span class="label text-muted d-flex"><div class="dot-label bg-gray-300 ml-1"></div>{{ trans('sections.Status_Section_No') }}</span>
                                                                        @else
                                                                        <span class="label text-success d-flex"><div class="dot-label bg-success ml-1"></div>{{ trans('sections.Status_Section_AC') }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-sm btn-warning" href="{{route("attendances.show",$grade->id)}}">{{ trans('attandences.Attendance') }}</a>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
										</div>
									</div><br>
                                    @endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
    <!-- row closed -->
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

<!--- Internal Accordion Js -->
<script src="{{URL::asset('assets/plugins/accordion/accordion.min.js')}}"></script>
<script src="{{URL::asset('assets/js/accordion.js')}}"></script>

@endsection
