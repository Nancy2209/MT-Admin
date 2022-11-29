@extends('Common.app')
<!-- Content Wrapper. Contains page content -->

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">

            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($errors->any())
        <h4 class="error-msg">{{ $errors->first() }}</h4>
    @endif
    <div class="content-wrapper">
        <!--//Page Toolbar//-->
        <div class="toolbar p-4 pb-0">
            <div class="position-relative container-fluid px-0">
                <div class="row align-items-center position-relative">
                    <div class="col-md-8 mb-4 mb-md-0">
                        <h3 class="mb-2">Key Management</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Key Management</button>

                    </div>
                </div>
            </div>
        </div>
        <!--//Page Toolbar End//-->
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="content p-4 d-flex flex-column-fluid">

                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table mt-0 table-striped table-card table-nowrap">
                                            <thead class="text-uppercase small text-muted">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Telephone No</th>
                                                    <th>Email</th>
                                                    <th>Fax</th>
                                                    <th>Address</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($directors as $management)
                                                    <tr>
                                                        <td>{{ $management->title }} </td>

                                                        <td>{{ $management->mobile }}

                                                        </td>
                                                        <td>{{ $management->email }} </td>
                                                        <td> {{ $management->fax }} </td>
                                                        <td> {{ $management->address }} {{ $management->address1 }}
                                                        </td>

                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$management->id }}"
                                                                data-title="{{ @$management->title }}"
                                                                data-mobile="{{ @$management->mobile }}"
                                                                data-email="{{ @$management->email }}"
                                                                data-fax="{{ @$management->fax }}"
                                                                data-address="{{ @$management->address }}"
                                                                data-address1="{{ @$management->address1 }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.keyManagement', @$management->id) }}"
                                                                title="delete logo"
                                                                onClick="return  confirm('Are you sure you want to delete ?')"><i
                                                                    class="fa fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>

            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Key Management
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.keyManagement') }}" id="addKeyManagement" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">Title</label>
                                    <input class="form-control mb-2" type="text" placeholder="Title" name="title"
                                        id="title" required>
                                    <label for="maskPhone" class="form-label">Email</label>
                                    <input class="form-control mb-2" type="email" placeholder="Email" name="email"
                                        id="email" required>
                                    <label for="maskPhone" class="form-label">Mobile</label>
                                    <input class="form-control mb-2" type="text" placeholder="Tele no" name="mobile"
                                        id="email" required>
                                    <label for="maskPhone" class="form-label">Fax No.</label>
                                    <input class="form-control mb-2" type="text" placeholder="Fax no" name="fax"
                                        id="fax" required>

                                    <label for="maskPhone" class="form-label">Address</label>
                                    <input class="form-control mb-2" type="text" placeholder="Street Number"
                                        name="address" id="address" required>

                                    <label for="maskPhone" class="form-label">Address1</label>
                                    <input class="form-control mb-2" type="text"
                                        placeholder="State and city pin code " name="address1" id="address1" required>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="editModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Management
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.keyManagement') }}" id="updateKeyManagement" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <input type="hidden" id="management_id" name="id">
                                    <label for="maskPhone" class="form-label">Title</label>
                                    <input class="form-control mb-2" type="text" placeholder="Title" name="title"
                                        id="title" required>
                                    <label for="maskPhone" class="form-label">Email</label>
                                    <input class="form-control mb-2" type="email" placeholder="email" name="email"
                                        id="email" required>
                                    <label for="maskPhone" class="form-label">Mobile</label>
                                    <input class="form-control mb-2" type="text" placeholder="Tele no" name="mobile"
                                        id="mobile" required>
                                    <label for="maskPhone" class="form-label">Fax No.</label>
                                    <input class="form-control mb-2" type="text" placeholder="Fax no" name="fax"
                                        id="fax" required>

                                    <label for="maskPhone" class="form-label">Address</label>
                                    <input class="form-control mb-2" type="text" placeholder="Street Number"
                                        id="address" name="address" required>

                                    <label for="maskPhone" class="form-label">Address1</label>
                                    <input class="form-control mb-2" type="text"
                                        placeholder="State and city pin code " id="address1" name="address1" required>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </section>
    </div>
    <script src="{{ asset('/login/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <style>
        .error {
            color: #FF0000;
            display: block;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#addKeyManagement"').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    },
                    mobile: {
                        required: true,
                        number: true
                    },
                    email: {
                        required: true,
                        email: true

                    },
                    fax: {
                        required: true,
                        number: true

                    },
                    address: {
                        required: true,

                    },
                    address1: {
                        required: true,

                    },
                }
            });
        });
    </script>



    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var title = $(this).attr('data-title');
            var mobile = $(this).attr('data-mobile');
            var email = $(this).attr('data-email');
            var fax = $(this).attr('data-fax');
            var address = $(this).attr('data-address');
            var address1 = $(this).attr('data-address1');

            $("#editModal .modal-dialog #management_id").val(id);
            $("#editModal .modal-dialog #title").val(title);
            $("#editModal .modal-dialog #mobile").val(mobile);
            $("#editModal .modal-dialog #email").val(email);
            $("#editModal .modal-dialog #fax").val(fax);
            $("#editModal .modal-dialog #address").val(address);
            $("#editModal .modal-dialog #address1").val(address1);
        });
    </script>
@endsection
