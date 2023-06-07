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
            <h4 class="content-title mb-0 my-auto">{{ trans('dashboards.students') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('dashboards.my_students') }}</span>
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
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5 style="font-family: 'Cairo', sans-serif;color: red"> {{ trans('attandences.Today') }} : {{ date('Y-m-d') }}</h5>
                </div>
            </div>
            <div class="card-body">
                <form  action="{{ route('attendance') }}" method="POST">
                    @csrf
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">{{ trans('dashboards.name_student') }}</th>
                                <th class="wd-10p border-bottom-0">{{ trans('dashboards.gender') }}</th>
                                <th class="wd-15p border-bottom-0">{{ trans('dashboards.Grade') }}</th>
                                <th class="wd-15p border-bottom-0">{{ trans('dashboards.Class') }}</th>
                                <th class="wd-15p border-bottom-0">{{ trans('dashboards.section') }}</th>
                                <th class="wd-30p border-bottom-0">{{ trans('attandences.Attendance') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $e=0 ?>
                            @foreach ($Students as $Student)
                            <?php $e++ ?>
                            <tr>
								<td>{{$e}}</td>
								<td>{{App::getLocale() == 'ar'?$Student->student_name_ar:$Student->student_name_en}}</td>
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
                                    <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                        <input name="attendences[{{ $Student->id }}]"
                                               @foreach($Student->Attendances()->where('attendence_date',date('Y-m-d'))->get() as $attendance)
                                               {{ $attendance->attendence_status == 1 ? 'checked' : '' }}
                                               @endforeach
                                               class="leading-tight" type="radio"
                                               value="presence">
                                        <span class="text-success">{{ trans('attandences.Present') }}</span>
                                    </label>

                                    <label class="ml-4 block text-gray-500 font-semibold">
                                        <input name="attendences[{{ $Student->id }}]"
                                               @foreach($Student->Attendances()->where('attendence_date',date('Y-m-d'))->get() as $attendance)
                                               {{ $attendance->attendence_status == 0 ? 'checked' : '' }}
                                               @endforeach
                                               class="leading-tight" type="radio"
                                               value="absent">
                                        <span class="text-danger">{{ trans('attandences.Absent') }}</span>
                                    </label>

                                    <input type="hidden" name="student_id[]" value="{{ $Student->id }}">
                                    <input type="hidden" name="grade_id" value="{{ $Student->grade_id }}">
                                    <input type="hidden" name="classe_id" value="{{ $Student->classe_id }}">
                                    <input type="hidden" name="section_id" value="{{ $Student->section_id }}">
                                </td>
							</tr>
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
