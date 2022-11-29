@extends('Common.app')
<!-- Content Wrapper. Contains page content -->

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @elseif($errormessage = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <strong>{{ $errormessage }}</strong>
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
                        <h3 class="mb-2">Our Achievments</h3>


                    </div>
                    @if (!$achievments)
                        <div class="card-tools">
                            <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                                style="float: right">Add Achievments</button>

                        </div>
                    @endif
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
                                        <table id="" class="table mt-0 table-striped table-card table-nowrap">
                                            <thead class="text-uppercase small text-muted">
                                                <tr>

                                                    <th>Student Ratio</th>
                                                    <th>Faculty Ratio</th>
                                                    <th>Institute Ratio</th>
                                                    <th>School Ratio</th>
                                                    <th>College</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($achievments)
                                                    <tr>
                                                        <td>{{ @$achievments->student_ratio }}</td>
                                                        <td>{{ @$achievments->faculty_ratio }}</td>
                                                        <td>{{ @$achievments->institute_ratio }}</td>
                                                        <td>{{ @$achievments->school_ratio }}</td>
                                                        <td>{{ @$achievments->college_ratio }}</td>

                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$achievments->id }}"
                                                                data-student_ratio="{{ @$achievments->student_ratio }}"
                                                                data-faculty_ratio="{{ @$achievments->faculty_ratio }}"
                                                                data-institute_ratio="{{ @$achievments->institute_ratio }}"
                                                                data-school_ratio="{{ @$achievments->school_ratio }}"
                                                                data-college_ratio="{{ @$achievments->college_ratio }}">
                                                                <i class="fa fa-edit"></i></a>

                                                        </td>
                                                    </tr>
                                                @endif


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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Category Standard Videos
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.achievment') }}" method="post" class="ajaxForm"
                            enctype="multipart/form-data" id="addAchievment" onsubmit="return formsubmit(this)">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <label for="maskPhone" class="form-label">Students Ratio</label>
                                    <input class="form-control mb-2" type="text" placeholder="students"
                                        id="student_ratio" name="student_ratio" required>

                                    <label for="maskPhone" class="form-label">Faculty Ratio</label>
                                    <input class="form-control mb-2" type="text" placeholder="faculties"
                                        id="faculty_ratio" name="faculty_ratio" required>

                                    <label for="maskPhone" class="form-label">Institute Ratio</label>
                                    <input class="form-control mb-2" type="text" placeholder="institutes"
                                        id="institute_ratio" name="institute_ratio" required>

                                    <label for="maskPhone" class="form-label">School Ratio</label>
                                    <input class="form-control mb-2" type="text" placeholder="schools"
                                        id="school_ratio" name="school_ratio" required>

                                    <label for="maskPhone" class="form-label">College Ratio</label>
                                    <input class="form-control mb-2" type="text" placeholder="colleges"
                                        id="college_ratio" name="college_ratio" required>
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Category Standard Video
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.achievement') }}" class="ajaxForm" method="post"
                            id="updateAchievment" enctype="multipart/form-data">

                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <input type="hidden" name="id" id="achievment_id">
                                    <div class="modal-body">
                                        <label for="maskPhone" class="form-label">Student Ratio</label>
                                        <input class="form-control mb-2" type="text"
                                            placeholder="students" name="student_ratio" id="student_ratio" required>
                                        <label for="maskPhone" class="form-label">Faculty Ratio</label>
                                        <input class="form-control mb-2" type="text"
                                            placeholder="faculties" name="faculty_ratio" id="faculty_ratio" required>
                                        <label for="maskPhone" class="form-label">Institute Ratio</label>
                                        <input class="form-control mb-2" type="text"
                                            placeholder="institutes" name="institute_ratio" id="institute_ratio"
                                            required>
                                        <label for="maskPhone" class="form-label">College Ratio</label>

                                        <input class="form-control mb-2" type="text"
                                            placeholder="colleges" name="college_ratio" id="collge_ratio" required>

                                        <label for="maskPhone" class="form-label">School Ratio</label>

                                        <input class="form-control mb-2" type="text"
                                            placeholder="schools" name="school_ratio" id="school_ratio" required>



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
            $('#addAchievment').validate({ // initialize the plugin
                rules: {
                    student_ratio: {
                        required: true,
                    },
                    faculty_ratio: {
                        required: true,
                    },
                    institute_ratio: {
                        required: true,

                    },
                    school_ratio: {
                        required: true,
                    },
                    collge_ratio: {
                        required: true,
                    },
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#updateAchievment').validate({ // initialize the plugin
                rules: {
                    student_ratio: {
                        required: true,
                    },
                    faculty_ratio: {
                        required: true,
                    },
                    institute_ratio: {
                        required: true,

                    },
                    school_ratio: {
                        required: true,
                    },
                    collge_ratio: {
                        required: true,
                    },

                }
            });
        });
    </script>


    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var student_ratio = $(this).attr('data-student_ratio');
            var faculty_ratio = $(this).attr('data-faculty_ratio');
            var institute_ratio = $(this).attr('data-institute_ratio');
            var school_ratio = $(this).attr('data-school_ratio');
            var college_ratio = $(this).attr('data-college_ratio');


            $("#editModal .modal-dialog #achievment_id").val(id);
            $("#editModal .modal-dialog #student_ratio").val(student_ratio);
            $("#editModal .modal-dialog #faculty_ratio").val(faculty_ratio);
            $("#editModal .modal-dialog #institute_ratio").val(institute_ratio);
            $("#editModal .modal-dialog #school_ratio").val(school_ratio);
            $("#editModal .modal-dialog #collge_ratio").val(college_ratio);

        });
    </script>
@endsection
