@extends('Common.app')
<!-- Content Wrapper. Contains page content -->

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $errors->first() }}</strong>
        </div>
    @endif
    <div class="content-wrapper">
        <!--//Page Toolbar//-->
        <div class="toolbar p-4 pb-0">
            <div class="position-relative container-fluid px-0">
                <div class="row align-items-center position-relative">
                    <div class="col-md-8 mb-4 mb-md-0">
                        <h3 class="mb-2">Subjects</h3>
                    </div>

                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Subject</button>

                    </div>

                </div>
            </div>
        </div>
        <!--//Page Toolbar End//-->
        <!-- Main content -->
        {{-- List of Centers start --}}
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
                                                    <th>Category</th>
                                                    <th>Standard</th>
                                                    <th>Board </th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subjects as $subject)
                                                    <tr>
                                                        <td>
                                                            {{ $subject->courseType ? $subject->courseType->name : '' }}
                                                        </td>
                                                        <td>
                                                            {{ $subject->classCategory->name }}
                                                        </td>
                                                        <td>
                                                            {{ $subject->board_name }}
                                                        </td>
                                                        <td>{{ @$subject->name }}</td>

                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer"
                                                                title="edit subject" data-id="{{ $subject->id }}"
                                                                data-course="{{ $subject->courseType ? $subject->courseType->id : '' }}"
                                                                data-class_id="{{ $subject->classCategory->name }}"
                                                                data-board_name="{{ $subject->board_name }}"
                                                                data-name="{{ $subject->name }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.subject', @$subject->id) }}"
                                                                title="delete subject"
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


            {{-- List of centers End --}}

            {{-- Add Center Modal start --}}

            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Subject
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.subject') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Category</label>
                                    <select class="form-control mb-2 js-change-category" name="classCategory_id" required>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="email-1">Standard</label>
                                    <select class="form-control mb-2 js-change-standard" name="course_id" required>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email-1">Board</label>
                                    <select class="form-control mb-2 js-change-board" name="board_name" required>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email-1">Name</label>

                                    <input class="form-control mb-2" type="text" placeholder="name" name="name"
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

            {{-- Add Modal End  --}}

            {{-- Edit Modal Start --}}

            <div class="modal fade" id="editModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Subject
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.subject') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <input type="hidden" name="id" id="subject_id">
                            <div class="modal-body">
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="name">Category</label>
                                        <select name="classCategory_id" id="category_id"
                                            class="form-control js-change-category" required>
                                            <option>Select Category</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">
                                                    {{ $course->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="email-1">Standard</label>
                                        <select name="course_id" id="standard_id" class="form-control js-change-standard"
                                            required>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-1">Board</label>
                                        <select name="board_name" id="board_id" class="form-control js-change-board"
                                            required>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-1">Name</label>
                                        <input type="text" id="name" class="form-control" name="name"
                                            value="{{ old('name') }}" required>
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
            {{-- Edit Modal End --}}



        </section>
    </div>
    <script src="{{ asset('/login/plugins/jquery/jquery.min.js') }}"></script>

    {{-- Edit Modal Scriptiing start --}}
    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var course = $(this).attr('data-course');
            var class_id = $(this).attr('data-class_id');
            var board_name = $(this).attr('data-board_name');
            var name = $(this).attr('data-name');

            $("#editModal .modal-dialog #subject_id").val(id);
            $("#editModal .modal-dialog #name").val(name);
            $("#editModal .modal-dialog #standard_id").append(`<option value="${class_id}">
                                       ${class_id}
                                  </option>`);
            $("#editModal .modal-dialog #board_id").append(`<option value="${board_name}">
                                       ${board_name}
                                  </option>`);
            $('#editModal .modal-dialog #category_id option[value="' + course + '"]').attr("selected",
                "selected");


        });
        // On Chage on start start

        $('.js-change-category').on('change', function() {
            var that = $(this).val();
            getStandard(that);

        });
        $('.js-change-standard').on('change', function() {
            var that = $(this).val();
            getboard(that);

        });


        function getStandard(course_id) {
            var id = course_id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{!! route('course.standard') !!}', //the page containing php script
                type: "post", //request type,
                data: {
                    id: id,
                    _token: _token
                },
                success: function(result) {
                    $('.js-change-standard').html('');
                    $('.js-change-standard').html(result.data);
                    console.log(result.data);
                }
            });

        }

        function getboard(standard_id) {
            var id = standard_id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{!! route('standard.board') !!}', //the page containing php script
                type: "post", //request type,
                data: {
                    id: id,
                    _token: _token
                },
                success: function(result) {
                    $('.js-change-board').html('');
                    $('.js-change-board').html(result.data);
                    console.log(result.data);
                }
            });

        }
    </script>
    {{-- it's use for only numeric value --}}
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
