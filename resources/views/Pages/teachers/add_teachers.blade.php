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
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('teachers.Teacher') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('teachers.Add_Teacher') }}</span>
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
				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									{{ trans('teachers.Add_Teacher') }} :
								</div>
								<form action="{{route("teachers.store")}}" method="POST" enctype="multipart/form-data" class="parsley-style-1" id="selectForm2" name="selectForm2">
									@csrf
									<div class="">
										<label for="">{{ trans('parents.photo') }} :</label>
										<div class="col-sm-12 col-md-4 mg-t-10 mg-sm-t-0">
											<input type="file" class="dropify" name="photo" data-default-file="{{URL::asset('assets/img/photos/1.jpg')}}" data-height="200"  />
										</div><br>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>{{ trans('teachers.Name_en') }} :</label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="teacher_name_en" required="" type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('teachers.Name_ar') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="teacher_name_ar" required="" type="text">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>{{ trans('parents.Email') }} :</label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" name="email" required="" type="email">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Password') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="password" required="" type="password">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.birth') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="birthday" required="" type="date">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Phone_Father') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="phone"  required="" type="text">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Address_Father_en') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="adress_en" required="" type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Address_Father') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="adress_ar" required="" type="text">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.cin') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" name="cin"  required="" type="text">
											</div>

											<div class="col-lg-4 mg-t-20 mg-lg-t-0">
												<p class="mg-b-10">{{ trans('teachers.specialization') }}</p><select name="specialit" class="form-control select2" required="">
													@foreach ($Specialits as $Speciality)
														<option value="{{$Speciality->id}}">
															{{App::getLocale() == 'en'?$Speciality->specialit_name_en:$Speciality->specialit_name_ar}}
														</option>
													@endforeach

												</select>
											</div><!-- col-4 -->
										</div>
										<label for="">{{ trans('parents.gender') }} :</label>
											<div class="form-check">
												<input class="form-check-input" value="1" type="radio" name="sexe" id="flexRadioDefault1">
												<label class="form-check-label" for="flexRadioDefault1">
												  {{ trans('parents.male') }}
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" value="0" type="radio" name="sexe" id="flexRadioDefault2">
												<label class="form-check-label" for="flexRadioDefault2">
												  {{ trans('parents.female') }}
												</label>
											</div><br>
									</div>

									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20" type="submit">{{ trans('grades.submit') }}</button>
										<a class="btn btn-success" href="{{route("teachers.index")}}">
											{{ trans('teachers.Back') }}
										</a>
										<button class="btn btn-secondary pd-x-20" type="reset">{{ trans('teachers.Reset') }}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
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
<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<!--Internal Fancy uploader js-->
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>

@endsection
