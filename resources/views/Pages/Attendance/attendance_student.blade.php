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
							<h4 class="content-title mb-0 my-auto">{{ trans('sections.title_page') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('attandences.Attendance') }}</span>
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


<div class="row row-sm">
	<!--div-->
	<div class="col-xl-12">
		<div class="card mg-b-20">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
                    <h5 style="font-family: 'Cairo', sans-serif;color: red"> {{ trans('attandences.Today') }} : {{ date('Y-m-d') }}</h5>
				</div>
			</div>

			<div class="card-body">
                <form  action="{{ route('attendances.store') }}" method="POST">
                @csrf
				<div class="table-responsive">
					<table id="example" class="table key-buttons text-md-nowrap">
						<thead>
							<tr>
								<th class="border-bottom-0 alert-success">#</th>
								<th class="border-bottom-0 alert-success">{{ trans('students.name') }}</th>
								<th class="border-bottom-0 alert-success">{{ trans('parents.cin') }}</th>
								<th class="border-bottom-0 alert-success">{{ trans('parents.gender') }}</th>
								<th class="border-bottom-0 alert-success">{{ trans('sections.Name_Grade') }}</th>
								<th class="border-bottom-0 alert-success">{{ trans('sections.Name_Class') }}</th>
								<th class="border-bottom-0 alert-success">{{ trans('sections.Name_Section') }}</th>
								<th class="border-bottom-0 ">{{ trans('attandences.Attendance') }}</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0 ?>
							@foreach ($Students as $Student)
							<?php $i++ ?>
							<tr>
								<td>{{$i}}</td>
								<td>{{App::getLocale() == 'ar'?$Student->student_name_ar:$Student->student_name_en}}</td>
								<td>{{$Student->cin}}</td>
								<td>
									@if (App::getLocale() == 'en')
										@if ($Student->sexe==1)
											Male
										@else
											Female
										@endif
									@else
										@if ($Student->sexe==1)
												ذكر
											@else
												انثى
											@endif
										@endif
								</td>
								<td>{{App::getLocale() == 'en'?$Student->Grades->grade_name_en:$Student->Grades->grade_name_ar}}</td>
								<td>{{App::getLocale() == 'en'?$Student->Classes->classe_name_en:$Student->Classes->classe_name_ar}}</td>
								<td>{{App::getLocale() == 'en'?$Student->Sections->section_name_en:$Student->Sections->section_name_ar}}</td>
								<td>
                                    @if(isset($Student->Attendances()->where('attendence_date',date('Y-m-d'))->first()->student_id))
                                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                            <input name="attendences[{{ $Student->id }}]" disabled
                                                {{ $Student->Attendances()->first()->attendence_status == 1 ? 'checked' : '' }}
                                                class="leading-tight" type="radio" value="presence">
                                            <span class="text-success">{{ trans('attandences.Present') }}</span>
                                        </label>

                                        <label class="ml-4 block text-gray-500 font-semibold">
                                            <input name="attendences[{{ $Student->id }}]" disabled
                                                {{ $Student->Attendances()->first()->attendence_status == 0 ? 'checked' : '' }}
                                                class="leading-tight" type="radio" value="absent">
                                            <span class="text-danger">{{ trans('attandences.Absent') }}</span>
                                        </label>
                                    @else
                                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                            <input name="attendences[{{ $Student->id }}]" class="leading-tight" type="radio"
                                                value="presence">
                                            <span class="text-success">{{ trans('attandences.Present') }}</span>
                                        </label>

                                        <label class="ml-4 block text-gray-500 font-semibold">
                                            <input name="attendences[{{ $Student->id }}]" class="leading-tight" type="radio"
                                                value="absent">
                                            <span class="text-danger">{{ trans('attandences.Absent') }}</span>
                                        </label>
                                    @endif

                                    <input type="hidden" name="student_id[]" value="{{ $Student->id }}">
                                    <input type="hidden" name="grade_id" value="{{ $Student->grade_id }}">
                                    <input type="hidden" name="classe_id" value="{{ $Student->classe_id }}">
                                    <input type="hidden" name="section_id" value="{{ $Student->section_id }}">

                                </td>
							</tr>
							@endforeach
						</tbody>
					</table>
                    <P>
                        <button class="btn btn-success" type="submit">{{ trans('grades.submit') }}</button>
                    </P>
                </form><br>
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
