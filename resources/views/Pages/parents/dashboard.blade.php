@extends('layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<!--Internal  Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
                    <h3>{{ trans('dashboards.Welcom') }} {{App::getLocale()=='en'?auth()->user()->parent_name_en:auth()->user()->parent_name_ar}}</h3>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
                <div class="row row-sm">
                    @foreach($sons as $son)
                        <div class="col-md-12 col-xl-4 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="feature2">
                                        <div class="text-center">
                                                <img src="{{URL::asset('assets/img/student.png')}}" alt="img" class="img-fluid">
                                        </div>
                                    </div><br>
                                    <h2 style="text-align: center;" class="mb-2 tx-16">{{App::getLocale()=='en'?$son->student_name_en:$son->student_name_ar}}</h2><hr>
                                    <h5 class="mb-2 tx-16">{{ trans('promotion.Grade') }} :{{App::getLocale()=='en'?$son->Grades->grade_name_en:$son->Grades->grade_name_ar}}</h5>
                                    <h5 class="mb-2 tx-16">{{ trans('promotion.Class') }} :{{App::getLocale()=='en'?$son->Classes->classe_name_en:$son->Classes->classe_name_ar}}</h5>
                                    <h5 class="mb-2 tx-16">{{ trans('promotion.section') }} :{{App::getLocale()=='en'?$son->Sections->section_name_en:$son->Sections->section_name_ar}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
				</div>

@endsection

@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>

<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
@endsection
