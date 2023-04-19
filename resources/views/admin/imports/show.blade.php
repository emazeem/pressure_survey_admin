@extends("admin.layouts.app")

@section("style")
    <link href="admin_assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection

@section("wrapper")
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Import File Details</div>

            </div>
            {{--{{getFileContents('imports/643fb6a0a3d1b@0602.txt',2)}}--}}
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <tr>
                                <th>File Name</th>
                                <td>{{$import->fileName()}}</td>
                            </tr>
                            <tr>
                                <th>File</th>
                                <td>
                                    <a href="{{$import->filePath()}}" target="_blank">
                                        <img src="{{url('file.png')}}" width="100" alt="">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Uploaded on</th>
                                <td>{{$import->created_at->format('d F, Y h:i A')}}</td>
                            </tr>
                            <tr>
                                <th>Assigned to Teams</th>
                                <td>
                                    <br>
                                    <form id="update-team-form">
                                        @csrf
                                        <div class="input-group col-md-4 col-12">

                                            <select id="teams" class="form-control" name="teams[]">
                                                @foreach($teams as $team)
                                                    <option value="{{$team->id}}" >{{$team->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary btn-sm pt-2 pb-1" type="submit">
                                                    UPDATE
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered table-sm table-hover">
                            @foreach($import->fileData as $data)
                                <tr>
                                    <td>{{$data->meter}}</td>
                                    <td>{{$data->address}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section("script")
    <script>
        var selectedValuesTest = {{Js::from($selectedValues)}};
        $(document).ready(function() {
            $("#teams").select2({
                multiple: true,
            });
            $('#teams').val(selectedValuesTest).trigger('change');
            $(document).on('submit','#update-team-form', function(e) {
                e.preventDefault();
                var values=$('#teams').val();
                $.ajax({
                    type:'POST',
                    url:'{{route('import.assign.team')}}',
                    data: {'id':{{$import->id}},'teams':values,_token:'{{csrf_token()}}'},
                    dataType:'JSON',
                    success:function(data) {
                        $('#customAlert').modal('show');
                        setTimeout(function() { $('#customAlert').modal('hide'); }, 1000);
                    },
                    error:function (xhr) {
                    }
                });
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>



    <div class="modal fade" id="customAlert" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h6 >Updated successfully!</h6>
                </div>
            </div>
        </div>
    </div>

@endsection
