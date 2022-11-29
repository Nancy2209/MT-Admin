@extends('Common.app')
<!-- Content Wrapper. Contains page content -->

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">

            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-block">

            <strong>{{ $errors->first() }}</strong>
        </div>
    @endif
    <div class="content-wrapper">
        <!--//Page Toolbar//-->
        <div class="toolbar p-4 pb-0">
            <div class="position-relative container-fluid px-0">
                <div class="row align-items-center position-relative">
                    <div class="col-md-8 mb-4 mb-md-0">
                        <h3 class="mb-2">Investor Presentations</h3>
                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Investor Presentations</button>

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
                                                    <th>Invest Year</th>
                                                    <th>Quarter Name</th>
                                                    <th>Quarter Code</th>
                                                    <th>File</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($investers as $invester)
                                                    <tr>
                                                        <td>{{ $invester->invest_year }}</td>
                                                        <td>{{ $invester->quarter_name }}</td>
                                                        <td>{{ $invester->quarter_code }}</td>

                                                        <td>
                                                            <a href="{{ asset('storage/' . $invester->file_name) }}"
                                                                target="_blank"> View File</a>
                                                        </td>
                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit invest"
                                                                data-id="{{ @$invester->id }}"
                                                                data-invest_year="{{ @$invester->invest_year }}"
                                                                data-quarter_name="{{ @$invester->quarter_name }}"
                                                                data-quarter_code="{{ @$invester->quarter_code }}"
                                                                data-filename="{{ asset('storage/' . $invester->file_name) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.invester.presentation', @$invester->id) }}"
                                                                title="delete invest"
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
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Investor Presentations
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.invester.presentation') }}" id="addInvestorPresentation"
                            method="post" enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">File Invest Year</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Investor Year"
                                        id="invest_year" name="invest_year" required>

                                    <label for="maskPhone" class="form-label">File Quarter Name</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Quarter Name"
                                        id="quarter_name" name="quarter_name" required>

                                    <label for="maskPhone" class="form-label">File Quarter Code</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Quarter Code"
                                        id="quarter_code" name="quarter_code" required>


                                    <label for="maskPhone" class="form-label">File upload</label>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="file_name" id="filename"
                                            accept=".pdf" required>
                                    </div>
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
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Investor Presentations
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.edit.invester.presentation') }}" method="post"
                            id="updatePresentation" enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <input type="hidden" name="id" id="count_id">
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">File Invest Year</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Investor Year"
                                        name="invest_year" id="invest_year" required>

                                    <label for="maskPhone" class="form-label">File Quarter Name</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Quarter Name"
                                        name="quarter_name" id="quarter_name" required>

                                    <label for="maskPhone" class="form-label">File Quarter Code</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Quarter Code"
                                        name="quarter_code" id="quarter_code" required>

                                    <label for="maskPhone" class="form-label">File upload</label>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="file_name" id="filename"
                                            accept=".pdf">
                                        <a href="" id="investorFile" target="_blank">View File</a>
                                    </div>
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
            $('#addInvestorPresentation').validate({ // initialize the plugin
                rules: {
                    invest_year: {
                        required: true
                    },
                    quarter_name: {
                        required: true,
                    },
                    quarter_code: {
                        required: true,

                    },
                    filename: {
                        required: true,
                        extension: "pdf"
                    },


                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#updatePresentation').validate({ // initialize the plugin
                rules: {
                    invest_year: {
                        required: true
                    },
                    quarter_name: {
                        required: true,
                    },
                    quarter_code: {
                        required: true,

                    },
                    filename: {
                        required: true,
                        extension: "pdf"
                    },
                }
            });
        });
    </script>

    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var invest_year = $(this).attr('data-invest_year');
            var quarter_name = $(this).attr('data-quarter_name');
            var quarter_code = $(this).attr('data-quarter_code');
            var filename = $(this).attr('data-filename');


            $("#editModal .modal-dialog #count_id").val(id);
            $("#editModal .modal-dialog #invest_year").val(invest_year);
            $("#editModal .modal-dialog #quarter_name").val(quarter_name);
            $("#editModal .modal-dialog #quarter_code").val(quarter_code);
            $("#editModal .modal-dialog #investorFile").attr("href", filename);
        });
    </script>
    <script>
        $(".allow_numeric").on("input", function(evt) {
            var self = $(this);
            self.val(self.val().replace(/\D/g, ""));
            if ((evt.which < 48 || evt.which > 57)) {
                evt.preventDefault();
            }
        });
    </script>
@endsection
