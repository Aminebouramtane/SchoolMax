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
            <h4 class="content-title mb-0 my-auto">{{ trans('grades.title_page') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/{{ trans('grades.List_Grade') }}</span>
        </div>
    </div>

    <div class="d-flex my-xl-auto right-content">

        <div class="pr-1 mb-3 mb-xl-0">
            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal"
                href="#modaldemo8">{{ trans('grades.add_Grade') }}</a>
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
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">{{ trans('grades.Name') }} </th>
                                <th class="wd-20p border-bottom-0">{{ trans('grades.Notes') }}</th>
                                <th class="wd-20p border-bottom-0">{{ trans('grades.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $e=0 ?>
                            @foreach ($grade as $i)
                            <?php $e++ ?>
                            <tr>
                                <td>{{ $e }}</td>
                                <td>{{App::getLocale() == 'ar'?$i->grade_name_ar:$i->grade_name_en}}</td>
                                <td>{{$i->grade_note}}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" title="{{trans('grades.edit_Grade')}}" data-target="#edit{{ $i->id }}"
                                        data-toggle="modal"><i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" title="{{trans('grades.delete_Grade')}}" class="btn btn-danger btn-sm"
                                        data-target="#delete{{ $i->id }}" data-toggle="modal"><i
                                            class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            {{-- UPDATE_modal_Grade --}}
                            <div class="modal fade" id="edit{{ $i->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{ trans('grades.edit_Grade') }}
                                            </h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">


                                            {{-- edit_form --}}
                                            <form action="{{route("grades.update",$i->id)}}" method="post">
                                                @method("PUT")
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name" id="Name" class="mr-sm-2">
                                                            {{ trans('grades.grade_name_ar') }} :
                                                        </label>
                                                        <input type="text" name="grade_name_ar"
                                                            value="{{$i->grade_name_ar}}" id="Name" class="form-control"
                                                            required>
                                                        <input type="text" value="{{ $i->id }}" name="id" id="" hidden>
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en" id="Name" class="mr-sm-2">
                                                            {{ trans('grades.grade_name_en') }} :
                                                        </label>
                                                        <input type="text" name="grade_name_en"
                                                            value="{{$i->grade_name_en}}" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">
                                                        {{ trans('grades.Notes') }}
                                                    </label>
                                                    <textarea class="form-control" name="grade_note"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3">{{$i->grade_note}}</textarea>
                                                </div><br><br>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                                    <button type="submit" class="btn btn-primary">{{ trans('grades.Edit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- DELETE_modal_Grade --}}
                            <div class="modal fade" id="delete{{ $i->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{ trans('grades.delete_Grade') }}
                                            </h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- add_form --}}
                                            <form action="{{route("grades.destroy",$i->id)}}" method="post">
                                                @method("DELETE")
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name" id="Name" class="mr-sm-2">
                                                            {{ trans('grades.Warning_Grade') }}
                                                        </label>
                                                    </div>
                                                </div><br><br>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                                    <button type="submit" class="btn btn-danger">{{ trans('grades.Delete') }}</button>
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

    {{-- modal with effects --}}
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ trans('grades.newgrade') }}</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route("grades.store")}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="grade_name_en" id="Name" class="mr-sm-2">
                                    {{ trans('grades.grade_name_en') }} :
                                </label>
                                <input type="text" name="grade_name_en" id="Name" class="form-control" value="">
                            </div>
                            <div class="col">
                                <label for="grade_name_ar" id="Name" class="mr-sm-2">
                                    {{ trans('grades.grade_name_ar') }} :
                                </label>
                                <input type="text" name="grade_name_ar" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">
                                {{ trans('grades.Notes') }}
                            </label>
                            <textarea class="form-control" name="grade_note" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades.Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ trans('grades.add_Grade') }}</button>
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
@endsection
