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
            <h4 class="content-title mb-0 my-auto">{{ trans('sidebar_trans.Dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('attandences.Attendance') }}</span>
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
            <div class="card-body">
                <form method="post" action="{{ route('children.attendance.search') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ trans('dashboards.info') }}</h6><br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student">{{ trans('dashboards.students_n') }}</label>
                                <select class="custom-select mr-sm-2" name="student_id">
                                    <option value="0">{{App::getLocale()=='en'?'All':'الكل'}}</option>
                                    @foreach($Students as $student)
                                        <option value="{{ $student->id }}">{{App::getLocale()=='en'? $student->student_name_en:$student->student_name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>

                        <div class="card-body">
                            <div class="input-group" data-date-format="dd-mm-yyyy">
                                {{-- <input type="date" placeholder="" required name="from"> --}}

                                <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                    <input class="form-control" data-parsley-class-handler="#lnWrapper" name="from" required="" type="date">
                                </div>
                                <button type="button" disabled class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8Zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5Z"/>
                                    </svg>
                                </button>
                                {{-- <input placeholder="" type="date" required name="to"> --}}

                                <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                    <input class="form-control" data-parsley-class-handler="#lnWrapper" name="to" required="" type="date">
                                </div>
                            </div>
                        </div>

                    </div>
                    <button class="btn-outline-primary btn-sm nextBtn btn-lg pull-right" type="submit">{{ trans('dashboards.Report') }}</button>
                </form><br><br>
                    @isset($Attendances)
                        <div class="table">
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
                                    @foreach ($Attendances as $Student)
                                    <?php $e++ ?>
                                    <tr>
                                        <td>{{$e}}</td>
                                        <td>{{App::getLocale() == 'en'?$Student->Students->student_name_en:$Student->Students->student_name_ar}}</td>
                                        <td>
                                            @if (App::getLocale() == 'en')
                                                @if ($Student->Students->sexe==1)
                                                    Male
                                                @else
                                                    Female
                                                @endif
                                            @else
                                                @if ($Student->Students->sexe==1)
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
                                            @if($Student->attendence_status == 0)
                                                <span class="btn-danger">{{ trans('attandences.Absent') }}</span>
                                            @else
                                                <span class="btn-success">{{ trans('attandences.Present') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endisset




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
<script src="{{URL::asset('assets/js/datepicker.js')}}"></script>


@endsection
