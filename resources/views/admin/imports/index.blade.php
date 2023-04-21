@extends("layouts.master")
@section("content")
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Import Files</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button class="btn btn-sm btn-primary create" data-bs-toggle="modal" data-bs-target="#modal" ><i class="bx bx-plus-circle"></i> Import</button>
                </div>
            </div>

            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Import</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end page wrapper -->

    <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="modal-form">
                    @csrf
                    <input type="hidden" name="id" value="0" id="id">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bx bx-plus"></i> Import</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control" name="file" id="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>

        function InitTable() {
            $('#example').DataTable({
                responsive: false,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,
                "order": [[0, 'asc']],
                "pageLength": 25,
                "ajax": {
                    "url":'{{ route('import.fetch')}}',
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: '{{csrf_token()}}'}
                },
                "columns":[
                    {"data": "id"},
                    {"data": "file"},
                    {"data": "action",orderable: false, searchable: false},

                ]
            });
        }
        $(document).ready(function () {
            InitTable();

            $('#modal').on('submit','#modal-form',function (e) {
                e.preventDefault();
                var route = '{{route('import.submit')}}';
                var method = 'POST';
                var data = new FormData(this);
                var next = {'type':'data-table-modal'};
                $(this).find('.form-control.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback.is-invalid').remove();
                submit($(this).find('button[type=submit]'),method,route,data,next);
            });
            $(document).on('click','.create',function () {
                $('#id').val(0);
                $('#name').val('');
            });
            $(document).on('click','.delete',function () {
                var id = $(this).attr('data-id');
                var route = '{{route('import.destroy')}}';
                var next = {'type':'soft-dt'};
                cdelete('Are you sure to delete this import?',id,token,route,next)
            });
            $(document).on('click','.edit',function () {

                $.ajax({
                    type:'POST',
                    url:'{{route('import.edit')}}',
                    data: {'id':$(this).attr('data-id'),_token:'{{csrf_token()}}'},
                    dataType:'JSON',
                    success:function(data) {
                        $('#id').val(data.id);
                        $('#modal').modal('show');
                    },
                    error:function (xhr) {
                    }
                });

            });
        });
    </script>

@endsection
