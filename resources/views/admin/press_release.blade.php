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
                        <h3 class="mb-2">Releases</h3>
                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Press Release</button>

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
                                                    <th>Release Category</th>
                                                    <th>File Title</th>
                                                    <th>Quarter Name</th>
                                                    <th>Release Date</th>
                                                    <th>File</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($press_releases as $press_release)
                                                    <tr>
                                                        <td>{{ $press_release->category ? $press_release->category->name : '' }}
                                                        </td>
                                                        <td>{{ $press_release->file_title }}</td>
                                                        <td>{{ $press_release->invest_quater }}</td>
                                                        <td>{{ $press_release->date }}</td>

                                                        <td>
                                                            <a href="{{ asset('storage/' . $press_release->file_name) }}"
                                                                target="_blank"> View File</a>
                                                        </td>
                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit invest"
                                                                data-id="{{ @$press_release->id }}"
                                                                data-category="{{ $press_release->category ? $press_release->category->id : '' }}"
                                                                data-file_title="{{ @$press_release->file_title }}"
                                                                data-invest_quater="{{ @$press_release->invest_quater }}"
                                                                data-date="{{ @$press_release->date }}"
                                                                data-filename="{{ asset('storage/' . $press_release->file_name) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.press.release', @$press_release->id) }}"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Press Release
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.press.release') }}" id="addRelease" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">Release Category</label>
                                    <select class="form-control mb-2" name="release_category_id" id="release_category_id"
                                        required>
                                        <option disabled selected> Please select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="maskPhone" class="form-label">File Title</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Title" id="file_title"
                                        name="file_title" required>

                                    <label for="maskPhone" class="form-label">File Quarter Name</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Quarter Name"
                                        id="invest_quater" name="invest_quater" required>

                                    <label for="maskPhone" class="form-label">File Release Date</label>
                                    <input class="form-control mb-2" type="date" placeholder="File Release Date"
                                        id="date" name="date" required>


                                    <label for="maskPhone" class="form-label">File upload</label>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="file_name" id="filename"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Press Release
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.edit.press.release') }}" id="updateRelease" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <input type="hidden" name="id" id="count_id">
                            <div class="modal-body">
                                <div class="card-body">

                                    <label for="maskPhone" class="form-label">Release Category</label>
                                    <select class="form-control mb-2" name="release_category_id" id="release_category_id"
                                        required>
                                        <option disabled selected> Please select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="maskPhone" class="form-label">File Title</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Title"
                                        name="file_title" id="file_title" required>

                                    <label for="maskPhone" class="form-label">File Quarter Name</label>
                                    <input class="form-control mb-2" type="text" placeholder="File Quarter Name"
                                        name="invest_quater" id="invest_quater" required>

                                    <label for="maskPhone" class="form-label">File Release Date</label>
                                    <input class="form-control mb-2" type="date" placeholder="File Release Date"
                                        name="date" id="date" required>

                                    <label for="maskPhone" class="form-label">File upload</label>
                                    <div class="mb-0">
                                        <input class="form-control" type="file" name="file_name" id="filename"
                                            accept=".pdf">
                                        <a href="" id="investorFile" target="_blank">View File</a>
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
            $('#addRelease').validate({ // initialize the plugin
                rules: {
                    release_category_id: {
                        required: true
                    },
                    file_title: {
                        required: true,
                    },
                    invest_quater: {
                        required: true,

                    },
                    date: {
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
            $('#updateRelease').validate({ // initialize the plugin
                rules: {
                    release_category_id: {
                        required: true
                    },
                    file_title: {
                        required: true,
                    },
                    invest_quater: {
                        required: true,

                    },
                    date: {
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
            var file_title = $(this).attr('data-file_title');
            var invest_quater = $(this).attr('data-invest_quater');
            var date = $(this).attr('data-date');
            var category = $(this).attr('data-category');
            var filename = $(this).attr('data-filename');


            $("#editModal .modal-dialog #count_id").val(id);
            $("#editModal .modal-dialog #file_title").val(file_title);
            $("#editModal .modal-dialog #invest_quater").val(invest_quater);
            $("#editModal .modal-dialog #date").val(date);
            $('#editModal .modal-dialog #release_category_id option[value="' + category + '"]').attr("selected",
                "selected");
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
