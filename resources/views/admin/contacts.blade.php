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
                        <h3 class="mb-2">Contact Us</h3>
                    </div>
                    @if (!$contact)
                        <div class="card-tools">
                            <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                                style="float: right">Add Contacts</button>

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
                                                    <th>Robomate Enquiry</th>
                                                    <th>Product Enquiry</th>
                                                    <th>Franchise Enquiry</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($contact)
                                                    <tr>
                                                        <td>{{ $contact->robomate_enquiry }}
                                                        </td>
                                                        <td>{{ $contact->product_enquiry }}
                                                        </td>
                                                        <td>{{ $contact->franchise_enquiry }}
                                                        </td>

                                                        <td> <a class="js-edit-logo" data-bs-toggle="modal"
                                                                href="#editModal" style="cursor:pointer" title="edit state"
                                                                data-id="{{ @$contact->id }}"
                                                                data-robomate_enquiry="{{ @$contact->robomate_enquiry }}"
                                                                data-product_enquiry="{{ @$contact->product_enquiry }}"
                                                                data-franchise_enquiry="{{ @$contact->franchise_enquiry }}"><i
                                                                    class="fa fa-edit"></i></a>

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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Contact
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.add.contact') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <div class="modal-body">
                                <label for="maskPhone" class="form-label">Robomate Enquiry Number</label>
                                <input class="form-control mb-2 allow_numeric" type="text"
                                    placeholder="Robomate Enquiry Number" name="robomate_enquiry" required>

                                <label for="maskPhone" class="form-label">Product Enquiry Number</label>
                                <input class="form-control mb-2 allow_numeric" type="text"
                                    placeholder="Product Enquiry Number" name="product_enquiry" required>

                                <label for="maskPhone" class="form-label">Franchise Enquiry Number</label>
                                <input class="form-control mb-2 allow_numeric" type="text"
                                    placeholder="Franchise Enquiry Number" name="franchise_enquiry" required>

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
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit Contact
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.update.contact') }}" method="post" enctype="multipart/form-data"
                            class="ajaxForm">

                            @csrf
                            <input type="hidden" name="id" id="contactid">
                            <div class="modal-body">
                                <label for="maskPhone" class="form-label">Robomate Enquiry Number</label>
                                <input class="form-control mb-2 allow_numeric" type="text"
                                    @error('phone') is-invalid @enderror" placeholder="Robomate Enquiry Number"
                                    name="robomate_enquiry" id="robomate_enquiry" required>

                                <label for="maskPhone" class="form-label">Product Enquiry Number</label>
                                <input class="form-control mb-2 allow_numeric" type="text"
                                    placeholder="Product Enquiry Number" name="product_enquiry" id="product_enquiry"
                                    required>

                                <label for="maskPhone" class="form-label">Franchise Enquiry Number</label>
                                <input class="form-control mb-2 allow_numeric" type="text" placeholder="title"
                                    name="franchise_enquiry" id="franchise_enquiry" required>

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
            var robomate_enquiry = $(this).attr('data-robomate_enquiry');
            var product_enquiry = $(this).attr('data-product_enquiry');
            var franchise_enquiry = $(this).attr('data-franchise_enquiry');

            $("#editModal .modal-dialog #contactid").val(id);
            $("#editModal .modal-dialog #robomate_enquiry").val(robomate_enquiry);
            $("#editModal .modal-dialog #product_enquiry").val(product_enquiry);
            $("#editModal .modal-dialog #franchise_enquiry").val(franchise_enquiry);




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
