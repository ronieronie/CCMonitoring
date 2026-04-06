@extends('layouts.app') {{-- Extends the main layout --}}

@section('title', 'Dashboard') {{-- Optional: sets the page title --}}

@section('content') {{-- Everything inside this section goes into the layout's content area --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <div class="container-fluid">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-normal mb-0">Card Manager</h5>
            <button type="button" class="btn btn-primary btn-sm" id="add_card_btn">
                <i class="bi bi-plus-lg"></i> Add Card
            </button>
        </div>

        <!-- Summary Card -->
        <div class="card shadow-sm mb-3 flex-shrink-0 text-white" style="width: 25%; min-width: 290px; height: 100px; 
                                                        background: linear-gradient(135deg, #0d6efd, #0a58ca);">
            <div class="card-body d-flex align-items-center gap-3 flex-wrap">

                <!-- Icon -->
                <div class="rounded d-flex align-items-center justify-content-center bg-white bg-opacity-25"
                    style="width: 45px; height: 45px;">
                    <i class="bi bi-credit-card text-white fs-5"></i>
                </div>

                <!-- Text -->
                <div class="flex-grow-1">
                    <small class="text-uppercase fw-bold">Total Credit Cards</small>
                    <br>
                    <div class="d-flex align-items-baseline gap-2 flex-wrap">
                        <h6 class="mb-0 fw-normal">{{ $total_cards }}</h6>
                        <span>cards</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Table -->
        <div class="card p-2">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0" id="card_manager_table">
                        <thead class="table-light">
                            <tr>
                                <th style="width:5%">#</th>
                                <th>Name</th>
                                <th style="width:15%">Type</th>
                                <th style="width:15%">Limit</th>
                                <th style="width:15%">Due Day</th>
                                <th style="width:15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
    <div class="modal fade" id="add_card_modal" tabindex="-1" aria-labelledby="addCardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"><!-- vertically centered -->
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center" id="addCardModalLabel">
                        <!-- Icon -->
                        <i class="bi bi-credit-card me-2"></i> <!-- Bootstrap Icons -->
                        <center>Credit Card Information</center>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body (Form) -->
                <div class="modal-body">
                    <form id="addCardForm" method="POST" action="">
                        <!-- Card Name -->
                        <div class="mb-3">
                            <label for="cardName" class="form-label">Card Name</label>
                            <input type="text" class="form-control" id="card_name" name="name"
                                placeholder="e.g., Visa Personal" required>
                        </div>

                        <!-- Card Type -->
                        <div class="mb-3">
                            <label for="cardType" class="form-label">Card Type</label>
                            <select class="form-select" id="card_type" name="type" required>
                                <option value="" selected disabled>Select card type</option>
                                <option value="Visa">Visa</option>
                                <option value="Mastercard">Mastercard</option>
                                <option value="Amex">American Express</option>
                                <option value="Amex">JCB</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Credit Limit -->
                        <div class="mb-3">
                            <label for="cardLimit" class="form-label">Credit Limit (Optional)</label>
                            <input type="text" class="form-control" id="card_limit" name="limit" placeholder="e.g., 5000">
                        </div>

                        <div class="mb-3">
                            <label for="cardLimit" class="form-label">Due Day</label>
                            <select id="due_day" class="form-select">
                                <option value="">Select Day</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>



                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit_add_card_btn">Save Card</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit modal -->
    <div class="modal fade" id="update_card_modal" tabindex="-1" aria-labelledby="addCardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"><!-- vertically centered -->
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center" id="addCardModalLabel">
                        <!-- Icon -->
                        <i class="bi bi-credit-card me-2"></i> <!-- Bootstrap Icons -->
                        <center>Update Card Information</center>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body (Form) -->
                <div class="modal-body">
                    <form id="addCardForm" method="POST" action="">
                        <input type="text" id="card_id" hidden>
                        <!-- Card Name -->
                        <div class="mb-3">
                            <label for="cardName" class="form-label">Card Name</label>
                            <input type="text" class="form-control" id="update_card_name" name="name"
                                placeholder="e.g., Visa Personal" required>
                        </div>

                        <!-- Card Type -->
                        <div class="mb-3">
                            <label for="cardType" class="form-label">Card Type</label>
                            <select class="form-select" id="update_card_type" name="type" required>
                                <option value="" selected disabled>Select card type</option>
                                <option value="Visa">Visa</option>
                                <option value="Mastercard">Mastercard</option>
                                <option value="Amex">American Express</option>
                                <option value="Amex">JCB</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Credit Limit -->
                        <div class="mb-3">
                            <label for="cardLimit" class="form-label">Credit Limit (Optional)</label>
                            <input type="text" class="form-control" id="update_card_limit" name="limit"
                                placeholder="e.g., 5000">
                        </div>

                        <div class="mb-3">
                            <label for="cardLimit" class="form-label">Due Day</label>
                            <select id="update_due_day" class="form-select">
                                <option value="">Select Day</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>


                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit_update_card_btn">Save Card</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#card_manager_table').DataTable({
                destroy: true,
                serverSide: false,
                processing: false,
                order: [[0, 'desc']],
                ajax: {
                    url: '{{ route('display_cards') }}',
                    type: 'GET', //if GET, no need for csrf token
                    // data: {_token:''} 

                },
                columns: [{
                    data: 'id'
                },
                {
                    data: 'cc_name'
                },
                {
                    data: 'cc_type'
                },
                {
                    data: 'cc_limit'
                },
                {
                    data: 'due_day'
                },
                {
                    data: 'action'
                }]
            });
        });

        $(document).on('click', '#add_card_btn', function () {
            $('#add_card_modal').modal('show');
        });

        $(document).on('click', '#submit_add_card_btn', function () {
            $('#add_card_modal').modal('hide');
            var card_name = $('#card_name').val();
            var card_type = $('#card_type').val();
            var card_limit = $('#card_limit').val();
            var due_day = $('#due_day').val();

            Swal.fire({
                title: 'Loading',
                text: "Submitting request, please wait..",
                allowOutsideClick: false,
                allowEscapeKey: false,
                width: '400px',
                padding: '2rem',
                customClass: {
                    title: 'fs-4', // 👈
                },
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('add_card') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    card_name, card_type, card_limit, due_day
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: "Card has been added.",
                        icon: "success",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#3085d6",
                        width: '400px',
                        padding: '2rem',
                        customClass: {
                            confirmButton: 'btn btn-primary btn-sm px-4',
                            title: 'fs-4',
                            htmlContainer: 'fs-6'
                        },
                        buttonsStyling: false,
                    });
                    $('#card_manager_table').DataTable().ajax.reload();
                }
            })
        });

        $(document).on('click', ".btn_update", function () {
            $('#update_card_modal').modal('show');
            $('#card_id').val($(this).data('id'));
            $('#update_card_name').val($(this).data('name'));
            $('#update_card_type').val($(this).data('type'));
            $('#update_card_limit').val($(this).data('limit'));
            $('#update_due_day').val($(this).data('due_day'));
        });

        $(document).on('click', '#submit_update_card_btn', function () {
            $('#update_card_modal').modal('hide');
            var id = $('#card_id').val();
            var card_name = $('#update_card_name').val();
            var card_type = $('#update_card_type').val();
            var card_limit = $('#update_card_limit').val();
            var due_day = $('#update_due_day').val();

            Swal.fire({
                title: 'Loading',
                text: "Submitting request, please wait..",
                allowOutsideClick: false,
                allowEscapeKey: false,
                width: '400px',
                padding: '2rem',
                customClass: {
                    title: 'fs-4', // 👈
                },
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('update_card') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id, card_name, card_type, card_limit, due_day
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: "Card has been updated successfully",
                        icon: "success",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#3085d6",
                        width: '400px',
                        padding: '2rem',
                        customClass: {
                            confirmButton: 'btn btn-primary btn-sm px-4',
                            title: 'fs-4',
                            htmlContainer: 'fs-6'
                        },
                        buttonsStyling: false,
                    });
                    $('#card_manager_table').DataTable().ajax.reload();
                }
            })
        });

        $(document).on('click', '.btn_delete', function () {
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                width: '400px',
                padding: '2rem',
                customClass: {
                    confirmButton: 'btn btn-primary px-4',
                    cancelButton: 'btn btn-danger px-4',
                    actions: 'gap-2',
                    title: 'fs-4',
                    htmlContainer: 'fs-6'
                },
                buttonsStyling: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Loading

                    Swal.fire({
                        title: 'Loading',
                        text: "Submitting request, please wait..",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        width: '400px',
                        padding: '2rem',
                        customClass: {
                            title: 'fs-4', // 👈
                        },
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: '{{ route("delete_card") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id
                        },
                        success: function (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Card has been deleted.",
                                icon: "success",
                                confirmButtonText: "OK",
                                confirmButtonColor: "#3085d6",
                                width: '400px',
                                padding: '2rem',
                                customClass: {
                                    confirmButton: 'btn btn-primary btn-sm px-4',
                                    title: 'fs-4',
                                    htmlContainer: 'fs-6'
                                },
                                buttonsStyling: false,
                            });
                            $('#card_manager_table').DataTable().ajax.reload();
                        }
                    });
                }
            });
        })

    </script>


@endsection