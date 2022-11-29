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
                        <h3 class="mb-2">Jobs</h3>
                    </div>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Job</button>

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
                                                    <th>Requirnments</th>
                                                    <th>Location</th>
                                                    <th>Candidate Profile</th>
                                                    <th>Description</th>
                                                    <th>Job Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jobs as $job)
                                                    <tr>
                                                        <td>{{ $job->title }}
                                                        </td>
                                                        <td>{{ substr($job->requirement, 0, 100) }}
                                                        </td>
                                                        <td>{{ $job->location }}
                                                        </td>
                                                        <td>{{ substr($job->candidate_profile, 0, 100) }}
                                                        </td>
                                                        <td>{{ substr($job->description, 0, 100) }}
                                                        </td>
                                                        <td>{{ $job->status ? 'Open' : 'Close' }}
                                                        </td>
                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$job->id }}"
                                                                data-title="{{ @$job->title }}"
                                                                data-requirement="{{ @$job->requirement }}"
                                                                data-location="{{ @$job->location }}"
                                                                data-candidate_profile="{{ @$job->candidate_profile }}"
                                                                data-description="{{ @$job->description }}"
                                                                data-status="{{ @$job->status }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.job', @$job->id) }}"
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
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Job
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.job') }}" id="addJob" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <label for="maskPhone" class="form-label">Title</label>
                                <input class="form-control mb-2" type="text" placeholder="title" name="title"
                                    id="title" required>

                                <label for="maskPhone" class="form-label">Requirnments of Candidate</label>
                                <textarea class="form-control mb-2" placeholder="Experience and CTC" name="requirement" id="requirement" required></textarea>

                                <label for="maskPhone" class="form-label">Location</label>
                                <input class="form-control mb-2" type="text" placeholder="location" name="location"
                                    id="location" required>

                                <label for="maskPhone" class="form-label">Candidate and Profile</label>
                                <textarea class="form-control mb-2" name="candidate_profile" placeholder="candidate profile" id="candidate_profile"
                                    required>
                                </textarea>

                                <label for="maskPhone" class="form-label">Description</label>
                                <textarea class="form-control mb-2" placeholder="description" name="description" id="description" required> </textarea>

                                <label for="maskPhone" class="form-label">Status</label>
                                <select class="form-control mb-2" id="status" name="status" required>
                                    <option value="1">Open</option>
                                    <option value="0">Close</option>
                                </select>
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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Job
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.edit.job') }}" id="updateJob" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <input type="hidden" name="id" id="job_id">
                            <div class="modal-body">
                                <label for="maskPhone" class="form-label">Title</label>
                                <input class="form-control mb-2" type="text" placeholder="title" name="title"
                                    id="title" required>

                                <label for="maskPhone" class="form-label">Requirnments of Candidate</label>
                                <textarea class="form-control mb-2" placeholder="Experience and CTC" name="requirement" id="requirement" required> </textarea>

                                <label for="maskPhone" class="form-label">Location</label>
                                <input class="form-control mb-2" type="text" placeholder="location" name="location"
                                    id="location" required>

                                <label for="maskPhone" class="form-label">Candidate Profile</label>
                                <textarea class="form-control mb-2" name="candidate_profile" id="candidate_profile" required>

                                </textarea>

                                <label for="maskPhone" class="form-label">Description</label>
                                <textarea class="form-control mb-2" placeholder="description" name="description" id="description"> </textarea>

                                <label for="maskPhone" class="form-label">Status</label>
                                <select class="form-control mb-2" name="status" id="status" required>
                                    <option value="1">Open</option>
                                    <option value="0">Close</option>
                                </select>


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
            $('#addJob').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    },
                    requirement: {
                        required: true,

                    },
                    location: {
                        required: true,
                    },

                    description: any {
                        required: true,
                    }

                    candidate_profile: {
                        required: true,
                    },
                    status: {
                        required: true,

                    },

                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#updateJob').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    },
                    requirement: {
                        required: true,
                        number: true
                    },
                    location: {
                        required: true,

                    },

                    description: any {
                        required: true,
                    }

                    candidate_profile: {
                        required: true,
                    },
                    status: {
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
            var requirement = $(this).attr('data-requirement');
            var location = $(this).attr('data-location');
            var candidate_profile = $(this).attr('data-candidate_profile');
            var description = $(this).attr('data-description');
            var status = $(this).attr('data-status');


            $("#editModal .modal-dialog #job_id").val(id);
            $("#editModal .modal-dialog #title").val(title);
            $("#editModal .modal-dialog #requirement").text(requirement);
            $("#editModal .modal-dialog #location").val(location);
            $("#editModal .modal-dialog #description").val(description);
            $('#editModal .modal-dialog #candidate_profile').text(candidate_profile);
            $('#editModal .modal-dialog #status option[value="' + status + '"]').attr("selected",
                "selected");



        });
    </script>
@endsection
