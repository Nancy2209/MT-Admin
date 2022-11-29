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
                        <h3 class="mb-2">Reports</h3>
                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Reports</button>

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
                                                    <th>Report Category</th>
                                                    <th>Report Year</th>
                                                    <th>Quarter Name</th>
                                                    <th>Quarter Code</th>
                                                    <th>File</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reports as $report)
                                                    <tr>
                                                        <td>{{ $report->category ? $report->category->name : '' }}
                                                        </td>
                                                        <td>{{ $report->report_year }}</td>
                                                        <td>{{ $report->quarter_name }}</td>
                                                        <td>{{ $report->quarter_code }}</td>

                                                        <td>
                                                            <a href="{{ asset('storage/' . $report->file_name) }}"
                                                                target="_blank"> View File</a>
                                                        </td>
                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit report"
                                                                data-id="{{ @$report->id }}"
                                                                data-category="{{ $report->category ? $report->category->id : '' }}"
                                                                data-report_year="{{ @$report->report_year }}"
                                                                data-quarter_name="{{ @$report->quarter_name }}"
                                                                data-quarter_code="{{ @$report->quarter_code }}"
                                                                data-filename="{{ asset('storage/' . $report->file_name) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.report', @$report->id) }}"
                                                                title="delete report"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Report
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.report') }}" id="addReport" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">Report Category</label>
                                    <select class="form-control mb-2 allow_numeric" name="report_category_id"
                                        id="report_category_id" required>
                                        <option disabled selected> Please select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="maskPhone" class="form-label">File Report Year</label>
                                    <input class="form-control mb-2 allow_numeric" type="text"
                                        placeholder="File Report Year" id="report_year" name="report_year" required>

                                    <label for="maskPhone" class="form-label">File Quarter Name</label>
                                    <input class="form-control mb-2 " type="text" placeholder="File Quarter Name"
                                        id="quarter_name" name="quarter_name" required>

                                    <label for="maskPhone" class="form-label">File Quater Code</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Release Date"
                                        id="quarter_code" name="quarter_code" required>


                                    <label for="maskPhone" class="form-label">File upload</label>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="file_name" id="file_name"
                                            accept=".pdf" required>
                                    </div>
                                    <span style="color: red">(File should be PDF and max size 1mb only.)</span>
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Report
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.edit.report') }}" id="updateReport" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <input type="hidden" name="id" id="count_id">
                            <div class="modal-body">
                                <div class="card-body">

                                    <label for="maskPhone" class="form-label">Report Category</label>
                                    <select class="form-control mb-2" name="report_category_id" id="report_category_id"
                                        required>
                                        <option disabled selected> Please select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="maskPhone" class="form-label">File Report Year</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Report Year"
                                        name="report_year" id="report_year" required>

                                    <label for="maskPhone" class="form-label">File Quarter Name</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Quarter Name"
                                        name="quarter_name" id="quarter_name" required>

                                    <label for="maskPhone" class="form-label">File Release Date</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Release Date"
                                        name="quarter_code" id="quarter_code" required>

                                    <label for="maskPhone" class="form-label">File upload</label>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="file_name" id="filename"
                                            accept=".pdf">
                                        <span style="color: red">(File should be PDF and max size 1mb only.)</span>
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

    <script>
        $(document).ready(function() {
            $('#addReport').validate({ // initialize the plugin
                rules: {
                    report_category_id: {
                        required: true
                    },
                    report_year: {
                        required: true,
                        // number: true
                    },
                    quarter_name: {
                        required: true,

                    },
                    quarter_code: {
                        required: true,
                        // minlength: 5

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
            $('#updateReport').validate({ // initialize the plugin
                rules: {
                    report_category_id: {
                        required: true
                    },
                    report_year: {
                        required: true,
                        // number: true
                    },
                    quarter_name: {
                        required: true,

                    },
                    quarter_code: {
                        required: true,
                        number: true

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
            var report_year = $(this).attr('data-report_year');
            var quarter_name = $(this).attr('data-quarter_name');
            var quarter_code = $(this).attr('data-quarter_code');
            var category = $(this).attr('data-category');
            var filename = $(this).attr('data-filename');


            $("#editModal .modal-dialog #count_id").val(id);
            $("#editModal .modal-dialog #report_year").val(report_year);
            $("#editModal .modal-dialog #quarter_name").val(quarter_name);
            $("#editModal .modal-dialog #quarter_code").val(quarter_code);
            $('#editModal .modal-dialog #report_category_id option[value="' + category + '"]').attr("selected",
                "selected");
            $("#editModal .modal-dialog #investorFile").attr("href", filename);
        });
    </script>
@endsection
