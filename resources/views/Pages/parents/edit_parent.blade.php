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
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
<!---Internal Fancy uploader css-->
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('parents.parent') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/{{ trans('parents.edit_parent') }}</span>
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
									{{ trans('parents.edit_parent') }} :
								</div>
								<form action="{{route("addparents.update",$add_parent->id)}}" method="POST" enctype="multipart/form-data" class="parsley-style-1" id="selectForm2" name="selectForm2">
									@csrf
									@method("PUT")
									<div class="">
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>{{ trans('parents.Name_Father_en') }}:</label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$add_parent->parent_name_en}}" name="parent_name_en" placeholder="Enter name en" required="" type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Name_Father') }}:</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$add_parent->parent_name_ar}}" name="parent_name_ar" placeholder="Enter name ar" required="" type="text">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6" id="fnWrapper">
												<label>{{ trans('parents.Email') }} :</label>
												<input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{$add_parent->email}}" name="email" placeholder="Enter name en" required="" type="email">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Password') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$add_parent->password}}" name="password" placeholder="Enter name ar" required="" type="password">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.birth') }}:</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$add_parent->birthday}}" name="birthday" placeholder="day-mount-year" required="" type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Phone_Father') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$add_parent->phone}}" name="phone" placeholder="+21 2* ** ** **" required="" type="text">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Address_Father_en') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$add_parent->adress_en}}" name="adress_en" placeholder="Enter Adress en" required="" type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Address_Father') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper"value="{{$add_parent->adress_ar}}" name="adress_ar" placeholder="Enter Adress ar" required="" type="text">
											</div>
										</div>
										<div class="row mg-b-20">
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.cin') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$add_parent->cin}}" name="cin" placeholder="Enter CIN" required="" type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Job_Father_en') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$add_parent->jobe_en}}" name="jobe_en" placeholder="Enter Jobe" required="" type="text">
											</div>
											<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
												<label>{{ trans('parents.Job_Father') }} :</label>
												<input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{$add_parent->jobe_ar}}" name="jobe_ar" placeholder="Enter Jobe" required="" type="text">
											</div>
										</div>
										@if ($add_parent->sexe==1)
										<label for="">{{ trans('parents.gender') }} :</label>
											<div class="form-check">
												<input class="form-check-input" checked value="1" type="radio" name="sexe" id="flexRadioDefault1">
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
											@else
											<label for="">{{ trans('parents.gender') }} :</label>
											<div class="form-check">
												<input class="form-check-input"  value="1" type="radio" name="sexe" id="flexRadioDefault1">
												<label class="form-check-label" for="flexRadioDefault1">
                                                    {{ trans('parents.male') }}
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" checked value="0" type="radio" name="sexe" id="flexRadioDefault2">
												<label class="form-check-label" for="flexRadioDefault2">
                                                    {{ trans('parents.female') }}
												</label>
											</div><br>
										@endif
											<label for="">{{ trans('parents.photo') }} :</label>
											<div class="col-sm-12 col-md-4 mg-t-10 mg-sm-t-0">
												<input type="file" class="dropify" name="photo" data-default-file="{{URL::asset('photos/'.$add_parent->photo)}}" data-height="200"  />
											</div>
									</div>

									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20" type="submit">{{ trans('grades.submit') }}</button>
									</div>
								</form>
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
