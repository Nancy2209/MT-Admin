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
                        <h3 class="mb-2">Enquiry List</h3>
                    </div>
                    {{-- <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                            style="float: right">Add Meta Tag</button>

                    </div> --}}
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
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Category</th>
                                                    <th>Board</th>
                                                    <th>Standard</th>
                                                    <th>City</th>
                                                    <th>Time Schedule</th>
                                                    {{-- <th>Action</th> --}}

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($enquires as $enquire)
                                                    <tr>
                                                        <td>{{ $enquire->name }}
                                                        </td>
                                                        <td>{{ $enquire->email }}
                                                        </td>
                                                        <td>{{ $enquire->mobile }}
                                                        </td>

                                                        <td>{{ $enquire->category }}
                                                        </td>
                                                        <td>{{ $enquire->board }}
                                                        </td>
                                                        <td>{{ $enquire->standard }}
                                                        </td>
                                                        <td>{{ $enquire->city }}
                                                        </td>
                                                        <td>{{ date('d-M-Y', strtotime($enquire->created_at)) }}
                                                            {{ $enquire->demo_time }}
                                                        </td>

                                                        {{-- <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$tag->id }}"
                                                                data-name="{{ @$tag->page_name }}"
                                                                data-mata_title="{{ @$tag->mata_title }}"
                                                                data-mata_keyboard="{{ @$tag->mata_keyboard }}"
                                                                data-canonical_tag="{{ @$tag->canonical_tag }}"
                                                                data-description="{{ @$tag->mata_description }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a class="delete-material"
                                                                href="{{ route('delete.meta.tag', @$tag->id) }}"
                                                                title="delete logo"
                                                                onClick="return  confirm('Are you sure you want to delete ?')"><i
                                                                    class="fa fa-trash-alt"></i></a>
                                                        </td> --}}
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





            {{-- <div class="modal fade" id="editModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Meta Tag
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.enquiry') }}" id="updateMedia" method="post"
                            enctype="multipart/form-data" class="ajaxForm">

                            @csrf
                            <input type="hidden" name="id" id="media_id">
                            <div class="modal-body">
                                <label for="maskPhone" class="form-label">Page Name</label>

                                <select class="form-control mb-2" name="page_name" id="page_name" required>
                                    <option disabled selected> Please select Page</option>
                                    <option value="/">Home</option>
                                    <option value="/about-Us">About</option>
                                    <option value="/category">Course</option>
                                    <option value="/our-centers">Center</option>
                                    <option value="/awards-recognition">Awards & Recognition</option>
                                    <option value="/corporate-governance">Corporate Governance</option>
                                    <option value="/investor-presentations">Investor Presentations</option>
                                    <option value="/press-release">Release</option>
                                    <option value="/reports">Report</option>
                                    <option value="/gallary">Gallary</option>
                                    <option value="/media">Media</option>
                                    <option value="/csr">CSR</option>
                                    <option value="/careers">Career</option>
                                    <option value="/privacy-policy">Privacy Policy</option>
                                    <option value="/disclaimer">Disclaimer</option>
                                    <option value="/terms-and-conditions">Tems & Conditions</option>
                                </select>
                                <label for="maskPhone" class="form-label">Meta Title</label>
                                <input class="form-control mb-2" type="text" placeholder="meta-title" name="mata_title"
                                    id="mata_title" required>



                                <label for="maskPhone" class="form-label">Meta Keywords </label>
                                <input class="form-control mb-2" type="text" placeholder="meta-Keywords"
                                    name="mata_keyboard" id="mata_keyboard" required>



                                <label for="maskPhone" class="form-label">Meta Description</label>
                                <textarea class="form-control mb-2" placeholder="meta description" name="mata_description" id="mata_description"
                                    required></textarea>

                                <label for="maskPhone" class="form-label">Canonical Tag</label>
                                <textarea class="form-control mb-2" placeholder="Canonical Tag" name="canonical_tag" id="canonical_tag" required></textarea>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}




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
            $('#addMedia').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    },
                    date: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#updateMedia').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    },
                    date: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },

                }
            });
        });
    </script>

    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var mata_title = $(this).attr('data-mata_title');
            var page_name = $(this).attr('data-name');
            var mata_keyboard = $(this).attr('data-mata_keyboard');
            var description = $(this).attr('data-description');
            var canonical_tag = $(this).attr('data-canonical_tag');

            $("#editModal .modal-dialog #media_id").val(id);
            $("#editModal .modal-dialog #mata_title").val(mata_title);
            $("#editModal .modal-dialog #mata_keyboard").val(mata_keyboard);
            $('#editModal .modal-dialog #page_name option[value="' + page_name + '"]').attr("selected",
                "selected");
            $("#editModal .modal-dialog #mata_description").val(description);
            $("#editModal .modal-dialog #canonical_tag").val(canonical_tag);

        });
    </script>
@endsection
