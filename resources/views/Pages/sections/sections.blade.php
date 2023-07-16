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
							<h4 class="content-title mb-0 my-auto">{{ trans('sections.title_page') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('sections.list_page') }}</span>
						</div>
					</div>

					<div class="d-flex my-xl-auto right-content">

						<div class="pr-1 mb-3 mb-xl-0">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#modaldemo8">{{ trans('sections.add_section') }}</a>
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
                                                                    <th class="wd-lg-8p"><span>{{ trans('sections.Name_Section') }}</span></th>
                                                                    <th class="wd-lg-20p"><span>{{ trans('sections.Name_Class') }}</span></th>
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
                                                                        <span class="label text-muted d-flex"><div class="dot-label bg-gray-300 ml-1"></div>{{ trans('sections.Status_Section_No')}}</span>
                                                                        @else
                                                                        <span class="label text-success d-flex"><div class="dot-label bg-success ml-1"></div>{{ trans('sections.Status_Section_AC') }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>

                                                                        <a href="#"
                                                                           class="btn btn-sm btn-info"
                                                                           data-toggle="modal"
                                                                           data-target="#edit{{ $grade->id }}"><i class="las la-pen"></i></a>

                                                                        <a href="#"
                                                                           class="btn btn-sm btn-danger"
                                                                           data-toggle="modal"
                                                                           data-target="#delete{{ $grade->id }}"><i class="las la-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                                {{-- Start update modal --}}
                                                                <div class="modal fade"
                                                                id="edit{{ $grade->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                               <div class="modal-dialog" role="document">
                                                                   <div class="modal-content">
                                                                       <div class="modal-header">
                                                                           <h5 class="modal-title"
                                                                               style="font-family: 'Cairo', sans-serif;"
                                                                               id="exampleModalLabel">
                                                                               {{ trans('sections.edit_Section') }}
                                                                           </h5>
                                                                           <button type="button" class="close"
                                                                                   data-dismiss="modal"
                                                                                   aria-label="Close">
                                                                           <span
                                                                               aria-hidden="true">&times;</span>
                                                                           </button>
                                                                       </div>
                                                                       <div class="modal-body">

                                                                           <form
                                                                               action="{{ route('sections.update', $grade->id) }}"
                                                                               method="POST">
                                                                               @csrf
                                                                               @method("PUT")
                                                                               <div class="row">
                                                                                   <div class="col">
                                                                                    <label for="section_name_en" id="Name" class="mr-sm-2">
                                                                                        {{ trans('sections.Section_name_en') }} :
                                                                                    </label>
                                                                                       <input type="text"
                                                                                              name="section_name_en"
                                                                                              class="form-control"
                                                                                              value="{{ $grade->section_name_en }}">
                                                                                   </div>

                                                                                   <div class="col">
                                                                                    <label for="section_name_en" id="Name" class="mr-sm-2">
                                                                                        {{ trans('sections.Section_name_ar') }} :
                                                                                    </label>
                                                                                       <input type="text"
                                                                                              name="section_name_ar"
                                                                                              class="form-control"
                                                                                              value="{{ $grade->section_name_ar }}">
                                                                                       <input id="id"
                                                                                              type="hidden"
                                                                                              name="id"
                                                                                              class="form-control"
                                                                                              value="{{ $grade->id }}">
                                                                                   </div>

                                                                               </div>
                                                                               <br>


                                                                               <div class="col">
                                                                                   <label for="inputName"
                                                                                          class="control-label">{{ trans('sections.Name_Grade') }}</label>
                                                                                   <select name="grade_id"
                                                                                           class="custom-select"
                                                                                           onclick="console.log($(this).val())">
                                                                                       <option
                                                                                           value="{{ $list->id }}">
                                                                                           {{ App::getLocale() == 'en'?$list->grade_name_en:$list->grade_name_ar }}
                                                                                       </option>
                                                                                       @foreach ($Grade_list as $list_Grade)
                                                                                           <option
                                                                                               value="{{ $list_Grade->id }}">
                                                                                               {{ App::getLocale() == 'en'?$list_Grade->grade_name_en:$list_Grade->grade_name_ar }}
                                                                                           </option>
                                                                                       @endforeach
                                                                                   </select>
                                                                               </div>
                                                                               <br>

                                                                               <div class="col">
                                                                                   <label for="inputName"
                                                                                          class="control-label">{{ trans('sections.Name_Class') }} :</label>
                                                                                   <select name="classe_id"
                                                                                           class="custom-select">
                                                                                       <option
                                                                                           value="{{ $grade->Classes->id }}">
                                                                                           {{ App::getLocale() == 'en'?$grade->Classes->classe_name_en:$grade->Classes->classe_name_ar }}
                                                                                       </option>
                                                                                   </select>
                                                                               </div>
                                                                               <br>
                                                                               <div class="col">
                                                                                    <label for="inputName" class="control-label">{{ trans('sections.Name_Teacher') }} :</label>
                                                                                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                                                                            @foreach($grade->Teachers as $teacher)
                                                                                                <option selected value="{{$teacher['id']}}">{{App::getLocale() == 'en'?$teacher['teacher_name_en']:$teacher['teacher_name_ar']}}</option>
                                                                                            @endforeach
                                                                                            @foreach($teachers as $teacher)
                                                                                                <option value="{{$teacher->id}}">{{App::getLocale() == 'en'?$teacher->teacher_name_en:$teacher->teacher_name_ar}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                </div><br>
                                                                               <div class="col">
                                                                                   <div class="form-check">

                                                                                       @if ($grade->active === 1)
                                                                                       <div class="form-check">
                                                                                        <input class="form-check-input" type="checkbox" name="active" id="flexCheckChecked" checked>
                                                                                        <label class="form-check-label" for="flexCheckChecked">
                                                                                            {{ trans('sections.Status') }}
                                                                                        </label>
                                                                                        </div>
                                                                                        @else
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" name="active" id="flexCheckChecked" >
                                                                                            <label class="form-check-label" for="flexCheckChecked"><br>
                                                                                                {{ trans('sections.Status') }}
                                                                                            </label>
                                                                                        </div>
                                                                                       @endif
                                                                                   </div>
                                                                               </div>


                                                                       </div>
                                                                       <div class="modal-footer">
                                                                           <button type="button"
                                                                                   class="btn btn-secondary"
                                                                                   data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                                                           <button type="submit"
                                                                                   class="btn btn-primary">{{ trans('grades.submit') }}</button>
                                                                       </div>
                                                                       </form>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                                {{-- End update modale --}}
                                                                {{-- START DELETE MODAL --}}
                                                                <div class="modal fade"
                                                                id="delete{{ $grade->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                               <div class="modal-dialog" role="document">
                                                                   <div class="modal-content">
                                                                       <div class="modal-header">
                                                                           <h5 style="font-family: 'Cairo', sans-serif;"
                                                                               class="modal-title"
                                                                               id="exampleModalLabel">
                                                                               {{ trans('sections.delete_Section') }}
                                                                           </h5>
                                                                           <button type="button" class="close"
                                                                                   data-dismiss="modal"
                                                                                   aria-label="Close">
                                                                           <span
                                                                               aria-hidden="true">&times;</span>
                                                                           </button>
                                                                       </div>
                                                                       <div class="modal-body">
                                                                           <form
                                                                               action="{{ route('sections.destroy', $grade->id) }}"
                                                                               method="post">
                                                                               @method("DELETE")
                                                                               @csrf
                                                                               {{ trans('sections.Warning_Section') }}
                                                                               <input id="id" type="hidden"
                                                                                      name="id"
                                                                                      class="form-control"
                                                                                      value="{{ $grade->id }}">
                                                                               <div class="modal-footer">
                                                                                   <button type="button"
                                                                                           class="btn btn-secondary"
                                                                                           data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                                                                   <button type="submit"
                                                                                           class="btn btn-danger">{{ trans('sections.Delete') }}</button>
                                                                               </div>
                                                                           </form>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                                {{-- END DELETE MODAL --}}
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

                    {{-- modal with effects --}}
                    <div class="modal" id="modaldemo8">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">{{ trans('sections.add_section') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route("sections.store")}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <label for="section_name_en" id="Name" class="mr-sm-2">
                                                    {{ trans('sections.Section_name_en') }}
                                                </label>
                                                <input type="text" name="section_name_en" id="Name" class="form-control" value="">
                                            </div>
                                            <div class="col">
                                                <label for="section_name_ar" id="Name" class="mr-sm-2">
                                                    {{ trans('sections.Section_name_ar') }}
                                                </label>
                                                <input type="text" name="section_name_ar" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="inputName"
                                                   class="control-label">{{ trans('sections.Name_Grade') }}</label>
                                            <select name="grade_id" class="custom-select"
                                                    onchange="console.log($(this).val())">
                                                <!--placeholder-->
                                                <option value="" selected
                                                        disabled>{{ trans('sections.Select_Grade') }}
                                                </option>
                                                @foreach ($Grade_list as $list_Grade)
                                                <option value="{{ $list_Grade->id }}"> {{ App::getLocale() == 'en'?$list_Grade->grade_name_en:$list_Grade->grade_name_ar }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        <div class="col">
                                            <label for="inputName"
                                                   class="control-label">{{ trans('sections.Name_Class') }}</label>
                                            <select name="classe_id" class="custom-select">

                                            </select>
                                        </div><br>
                                        <div class="col">
                                            <label for="inputName" class="control-label">{{ trans('sections.Name_Teacher') }}</label>
                                            <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                                @foreach($teachers as $teacher)
                                                    <option value="{{$teacher->id}}">{{App::getLocale() == 'en'?$teacher->teacher_name_en:$teacher->teacher_name_ar}}</option>
                                                @endforeach
                                            </select>
                                        </div><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="active" id="flexCheckChecked" checked>
                                            <label class="form-check-label" for="flexCheckChecked"><br>
                                                {{ trans('sections.Status') }}
                                            </label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                            <button type="submit" class="btn btn-primary">{{ trans('grades.submit') }}</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- end modal with effects --}}
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

@include('layouts.ajax')

@endsection
