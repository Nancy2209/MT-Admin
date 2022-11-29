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
                        <h3 class="mb-2">Privacy Policy</h3>


                    </div>
                    @if (!$policy)
                        <div class="card-tools">
                            <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                                style="float: right">Add Privacy Policy</button>

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
                                                    <th>Decriptions</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($policy)
                                                    <tr>
                                                        <td>{{ substr($policy->description, 0, 100) }}
                                                        </td>

                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$policy->id }}"
                                                                data-description="{{ @$policy->description }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            {{-- <a class="delete-material"
                                                        href="{{ route('delete.office', @$gallary->id) }}"
                                                        data-id="{{ @$office->id }}" title="delete logo"
                                                        onClick="return  confirm('Are you sure you want to delete ?')"><i
                                                            class="fa fa-trash-alt"></i></a> --}}
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
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Privacy Policy
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.policy') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">

                                {{-- <input class="form-control form-control-lg mb-2" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example"> --}}
                                <div class="row pb-5">
                                    <div class="col-12">
                                    </div>
                                    <div class="col-12 col-md-12 mb-5">
                                        <textarea name="description" cols="100" rows="10" required></textarea>

                                        <!--Quill editor-->

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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Privacy Policy
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.edit.policy') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <input type="hidden" name="policy_id" id="policy_id">
                            <div class="modal-body">
                                <div class="row pb-5">
                                    <div class="col-12">
                                    </div>
                                    <div class="col-12 col-md-12 mb-5">
                                        <textarea name="description" cols="100" rows="10" id="description_policy" required></textarea>

                                        <!--Quill editor-->

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

    <script>
        $(".js-edit-logo").on('click', function(e) {
            var id = $(this).attr('data-id');
            var description = $(this).attr('data-description');

            $("#editModal .modal-dialog #policy_id").val(id);
            $("#editModal .modal-dialog #description_policy").text(description);

        });
    </script>
@endsection
