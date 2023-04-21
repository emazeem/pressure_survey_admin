@extends("layouts.master")

@section("content")
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Member</div>
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
                    <button class="btn btn-sm btn-primary create" data-bs-toggle="modal" data-bs-target="#modal" ><i class="bx bx-plus-circle"></i> Member</button>
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
                                <th>Name</th>
                                <th>Phone</th>
                                <th>CNIC</th>
                                <th>Address</th>
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
                    <h5 class="modal-title"><i class="bx bx-plus"></i> Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="team_id">Team</label>
                            <select  class="form-control" name="team_id" id="team_id">
                                <option selected disabled hidden>-- Select team of member</option>
                                @foreach($teams as $team)
                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name of member">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone of member">
                        </div>

                        <div class="form-group">
                            <label for="cnic">CNIC</label>
                            <input type="text" class="form-control" name="cnic" id="cnic" placeholder="XXXXX-XXXXXXX-X">
                        </div>


                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea  class="form-control" name="address" id="address" placeholder="Address of member"></textarea>
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
                    "url": '{{ route('member.fetch')}}',
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: '{{csrf_token()}}'}
                },
                "columns":[
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "phone"},
                    {"data": "cnic"},
                    {"data": "address"},
                    {"data": "action",orderable: false, searchable: false},

                ]
            });
        }
        $(document).ready(function () {
            InitTable();

            $('#modal').on('submit','#modal-form',function (e) {
                e.preventDefault();
                var route = '{{route('member.submit')}}';
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
                var route = '{{route('member.destroy')}}';
                var next = {'type':'soft-dt'};
                cdelete('Are you sure to delete this team?',id,token,route,next)
            });
            $(document).on('click','.edit',function () {

                $.ajax({
                    type:'POST',
                    url:'{{route('member.edit')}}',
                    data: {'id':$(this).attr('data-id'),_token:'{{csrf_token()}}'},
                    dataType:'JSON',
                    success:function(data) {
                        $('#id').val(data.id);
                        $('#team_id').val(data.team_id);
                        $('#name').val(data.name);
                        $('#phone').val(data.phone);
                        $('#cnic').val(data.cnic);
                        $('#address').val(data.address);
                        $('#modal').modal('show');
                    },
                    error:function (xhr) {
                    }
                });

            });
        });
    </script>
    <script src="{{url('index.js')}}"></script>
@endsection