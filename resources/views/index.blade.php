@extends('layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
                    <h3>{{ trans('dashboards.Welcom') }} {{auth()->user()->name}}</h3>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ trans('dashboards.students') }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white"></h4>
											<p class="mb-0 tx-12 text-white op-7">{{App\Models\Student::count()}}</p>
										</div>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1"></span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ trans('dashboards.parents') }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white"></h4>
											<p class="mb-0 tx-12 text-white op-7">{{App\Models\Add_parent::count()}}</p>
										</div>
										<span class="float-right my-auto mr-auto">
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1"></span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ trans('dashboards.teachers') }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white"></h4>
											<p class="mb-0 tx-12 text-white op-7">{{App\Models\Teacher::count()}}</p>
										</div>
										<span class="float-right my-auto mr-auto">
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1"></span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ trans('dashboards.sections') }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white"></h4>
											<p class="mb-0 tx-12 text-white op-7">{{App\Models\Section::count()}}</p>
										</div>
									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1"></span>
						</div>
					</div>
				</div>
				<!-- row closed -->
                                {{-- row open --}}
                                <div class="row row-sm">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title mg-b-0">{{ trans('dashboards.students_n') }} :</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table text-md-nowrap" id="example1">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-10p border-bottom-0 alert alert-info">#</th>
                                                                <th class="wd-15p border-bottom-0 alert alert-info">{{ trans('dashboards.name_student') }}</th>
                                                                <th class="wd-15p border-bottom-0 alert alert-info">{{ trans('dashboards.cin') }}</th>
                                                                <th class="wd-10p border-bottom-0 alert alert-info">{{ trans('dashboards.gender') }}</th>
                                                                <th class="wd-15p border-bottom-0 alert alert-info">{{ trans('dashboards.Grade') }}</th>
                                                                <th class="wd-15p border-bottom-0 alert alert-info">{{ trans('dashboards.Class') }}</th>
                                                                <th class="wd-15p border-bottom-0 alert alert-info">{{ trans('dashboards.section') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $e=0 ?>
                                                            @foreach (App\Models\Student::all() as $Student)
                                                            <?php $e++ ?>
                                                            <tr>
                                                                <td>{{$e}}</td>
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
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/div-->
                                </div>
                                {{-- Close Row --}}
                                {{-- row open --}}
                                <div class="row row-sm">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title mg-b-0">{{ trans('dashboards.teachers_n') }} :</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table text-md-nowrap" id="example1">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-10p border-bottom-0 alert alert-danger">#</th>
                                                                <th class="wd-15p border-bottom-0 alert alert-danger">{{ trans('dashboards.name_teacher') }}</th>
                                                                <th class="wd-15p border-bottom-0 alert alert-danger">{{ trans('dashboards.cin') }}</th>
                                                                <th class="wd-10p border-bottom-0 alert alert-danger">{{ trans('dashboards.gender') }}</th>
                                                                <th class="wd-15p border-bottom-0 alert alert-danger">{{ trans('dashboards.Email') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $e=0 ?>
                                                            @foreach (App\Models\Teacher::all() as $Student)
                                                            <?php $e++ ?>
                                                            <tr>
                                                                <td>{{$e}}</td>
                                                                <td>{{App::getLocale() == 'ar'?$Student->teacher_name_ar:$Student->teacher_name_en}}</td>
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
                                                                <td>{{$Student->email}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/div-->
                                </div>
                                {{-- Close Row --}}
                                {{-- row open --}}
                                <div class="row row-sm">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title mg-b-0">{{ trans('parents.parent') }} :</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table text-md-nowrap" id="example1">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-10p border-bottom-0 alert alert-success">#</th>
                                                                <th class="wd-15p border-bottom-0 alert alert-success">{{ trans('dashboards.name_parent') }}</th>
                                                                <th class="wd-15p border-bottom-0 alert alert-success">{{ trans('dashboards.cin') }}</th>
                                                                <th class="wd-10p border-bottom-0 alert alert-success">{{ trans('dashboards.gender') }}</th>
                                                                <th class="wd-15p border-bottom-0 alert alert-success">{{ trans('dashboards.Email') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $e=0 ?>
                                                            @foreach (App\Models\Add_parent::all() as $Student)
                                                            <?php $e++ ?>
                                                            <tr>
                                                                <td>{{$e}}</td>
                                                                <td>{{App::getLocale() == 'ar'?$Student->parent_name_ar:$Student->parent_name_en}}</td>
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
                                                                <td>{{$Student->email}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/div-->
                                </div>
                                {{-- Close Row --}}

                <livewire:calendar />
                @livewireScripts
                @stack('scripts')

			</div>
		</div>
		<!-- Container closed -->
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
@endsection
