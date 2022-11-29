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
                        <h3 class="mb-2">Standard List</h3>


                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Standard</button>

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
                                                    <th>Course Type</th>
                                                    <th>Name</th>
                                                    <th>Board Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($classCategories as $classCategory)
                                                    <tr>
                                                        <td>
                                                            {{ $classCategory->courseType->name }}
                                                        </td>
                                                        <td>{{ @$classCategory->name }}</td>
                                                        <td>{{ @$classCategory->board_name }}</td>

                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer"
                                                                title="edit standard" data-id="{{ @$classCategory->id }}"
                                                                data-course_name="{{ $classCategory->courseType->id }}"
                                                                data-name="{{ $classCategory->name }}"
                                                                data-board_name="{{ $classCategory->board_name }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.classCategory', @$classCategory->id) }}"
                                                                title="delete standard"
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Standard
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.classCategory') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">Category</label>
                                    <select class="form-control mb-2" name="course_id" required>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }} </option>
                                        @endforeach
                                    </select>

                                    <label for="maskPhone" class="form-label">Name</label>
                                    <input class="form-control mb-2" type="text" placeholder="name" name="name"
                                        required>



                                    <label for="maskPhone" class="form-label">Board Name</label>
                                    <input class="form-control mb-2" type="text" placeholder="board" name="board_name"
                                        required>
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Standard
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.classCategory') }}" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <input type="hidden" name="id" id="coueseId">
                                    <label for="maskPhone" class="form-label">Category</label>
                                    <select class="form-control mb-2" name="course_id" id="course_id" required>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }} </option>
                                        @endforeach
                                    </select>

                                    <label for="maskPhone" class="form-label">Name</label>
                                    <input class="form-control mb-2" type="text" placeholder="name" name="name"
                                        id="name" required>
                                    <label for="maskPhone" class="form-label">Board Name</label>
                                    <input class="form-control mb-2" type="text" placeholder="board" id="board_name"
                                        name="board_name" required>
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
        <!-- /.content -->
    </div>
    <script src="{{ asset('/login/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var course_name = $(this).attr('data-course_name');
            var name = $(this).attr('data-name');
            var board_name = $(this).attr('data-board_name');

            $("#editModal .modal-dialog #coueseId").val(id);
            $("#editModal .modal-dialog #name").val(name);
            $("#editModal .modal-dialog #board_name").val(board_name);
            $('#editModal .modal-dialog #course_id option[value="' + course_name + '"]').attr("selected",
                "selected");


        });
    </script>
@endsection
