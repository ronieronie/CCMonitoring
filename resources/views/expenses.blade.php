@extends('layouts.app') {{-- Extends the main layout --}}

@section('title', 'Dashboard') {{-- Optional: sets the page title --}}

@section('content') {{-- Everything inside this section goes into the layout's content area --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <div class="container-fluid">
        <h5 style="font-weight: normal;">Expenses</h5>
    </div>

    <div class="container-fluid">
        <div class="card p-3">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col">
                        <label class="form-label"><i class="bi bi-credit-card"></i> Card</label>
                        <select class="form-select" id="card">
                            <option value="Select Card" selected>Select Card</option>
                            @foreach($credit_cards as $card)
                                <option value="{{ $card->Name }}">{{ $card->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label"><i class="bi bi-calendar2-date"></i> Date</label>
                        <input type="date" class="form-control" id="date" required>
                    </div>

                    <div class="col">
                        <label class="form-label"><i class="bi bi-shop"></i> Merchant</label>
                        <input type="text" class="form-control" id="merchant" placeholder="Enter merchant" required>
                    </div>

                    <div class="col">
                        <label class="form-label"><i class="bi bi-tags"></i> Category</label>
                        <select class="form-select" id="category" required>
                            <option value="" selected disabled>Select category</option>

                            <!-- Food & Dining -->
                            <optgroup label="Food & Dining">
                                <option value="Groceries">Groceries</option>
                                <option value="Restaurants">Restaurants</option>
                                <option value="Coffee / Cafe">Coffee / Cafe</option>
                                <option value="Fast Food">Fast Food</option>
                            </optgroup>

                            <!-- Transportation -->
                            <optgroup label="Transportation">
                                <option value="Fuel / Gas">Fuel / Gas</option>
                                <option value="Public Transport">Public Transport</option>
                                <option value="Ride Hailing">Ride Hailing</option>
                                <option value="Car Maintenance / Parking / Tolls">Car Maintenance / Parking / Tolls</option>
                            </optgroup>

                            <!-- Shopping -->
                            <optgroup label="Shopping">
                                <option value="Online Shopping">Online Shopping</option>
                                <option value="Clothing / Fashion">Clothing / Fashion</option>
                                <option value="Electronics / Gadgets">Electronics / Gadgets</option>
                                <option value="Home / Furniture">Home / Furniture</option>
                            </optgroup>

                            <!-- Bills & Utilities -->
                            <optgroup label="Bills & Utilities">
                                <option value="Electricity">Electricity</option>
                                <option value="Water">Water</option>
                                <option value="Internet / Mobile / Cable">Internet / Mobile / Cable</option>
                                <option value="Rent / Mortgage">Rent / Mortgage</option>
                            </optgroup>

                            <!-- Travel & Leisure -->
                            <optgroup label="Travel & Leisure">
                                <option value="Flights / Airlines">Flights / Airlines</option>
                                <option value="Hotels / Accommodation">Hotels / Accommodation</option>
                                <option value="Entertainment / Movies / Shows">Entertainment / Movies / Shows</option>
                                <option value="Hobbies / Sports">Hobbies / Sports</option>
                            </optgroup>

                            <!-- Financial -->
                            <optgroup label="Financial">
                                <option value="Bank Fees">Bank Fees</option>
                                <option value="Loan Payments">Loan Payments</option>
                                <option value="Credit Card Payments">Credit Card Payments</option>
                                <option value="Insurance">Insurance</option>
                            </optgroup>

                            <!-- Healthcare -->
                            <optgroup label="Healthcare">
                                <option value="Doctor / Hospital">Doctor / Hospital</option>
                                <option value="Medicine / Pharmacy">Medicine / Pharmacy</option>
                                <option value="Fitness / Gym">Fitness / Gym</option>
                            </optgroup>

                            <!-- Others / Miscellaneous -->
                            <optgroup label="Others / Miscellaneous">
                                <option value="Gifts / Donations">Gifts / Donations</option>
                                <option value="Education / Books">Education / Books</option>
                                <option value="Subscriptions">Subscriptions</option>
                                <option value="Miscellaneous">Miscellaneous</option>
                            </optgroup>

                        </select>
                    </div>

                    <div class="col">
                        <label class="form-label"><i class="bi bi-coin"></i> Amount</label>
                        <input type="text" id="amount" class="form-control" placeholder="Enter amount">
                    </div>

                    <div class="col-auto d-grid">
                        <button class="btn btn-primary px-4" id="add_expenses_btn">
                            <i class="bi bi-plus-lg"></i> Add
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-body">
                <div class="table-responsive">
                    <i class="bi bi-funnel"></i>&nbspFilter by:
                    <div class="d-flex gap-2 w-100">
                        <div class="input-group flex-fill">
                            <span class="input-group-text bg-primary text-light">
                                <i class="bi bi-calendar"></i>&nbsp Year
                            </span>
                            <select id="year_filter" class="form-select">
                                <option value="">All Years</option>
                                <option value="2030">2030</option>
                                <option value="2029">2029</option>
                                <option value="2028">2028</option>
                                <option value="2027">2027</option>
                                <option value="2026">2026</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>

                        <!-- Month Filter -->
                        <div class="input-group flex-fill">
                            <span class="input-group-text bg-primary text-light">
                                <i class="bi bi-calendar"></i>&nbsp Month
                            </span>
                            <select id="month_filter" class="form-select">
                                <option value="">All Months</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>

                        <!-- Card Filter -->
                        <div class="input-group flex-fill">
                            <span class="input-group-text bg-primary text-light">
                                <i class="bi bi-credit-card"></i>&nbsp Cards
                            </span>
                            <select id="card_filter" class="form-select">
                                <option value="">All Cards</option>
                                @foreach($credit_cards as $card)
                                    <option value="{{ $card->Name }}">{{ $card->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <br>
                    <table class="table table-bordered align-middle mb-0" id="expenses_table">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width:5%">No.</th>
                                <th class="text-center">Card</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Merchant</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center" style="width:15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="update_expenses_modal" tabindex="-1" aria-labelledby="addCardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"><!-- vertically centered -->
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center" id="addCardModalLabel">
                        <!-- Icon -->
                        <i class="bi bi-cash-coin me-2"></i> <!-- Bootstrap Icons -->
                        <center>Update Expenses</center>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body (Form) -->
                <div class="modal-body">
                    <form id="addCardForm" method="POST" action="">
                        <input type="text" id="update_id" hidden>
                        <input type="text" id="card_id" hidden>
                        <!-- Card Name -->
                        <div class="mb-3">
                            <label for="cardName" class="form-label">Card</label>
                            <select id="update_card" class="form-select">
                                <option value="">Select Card</option>
                                @foreach($credit_cards as $card)
                                    <option value="{{ $card->Name }}">{{ $card->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Card Type -->
                        <div class="mb-3">
                            <label for="cardType" class="form-label">Date</label>
                            <input type="date" class="form-control" id="update_date">
                        </div>

                        <!-- Credit Limit -->
                        <div class="mb-3">
                            <label for="cardLimit" class="form-label">Merchant</label>
                            <input type="text" class="form-control" id="update_merchant" name="limit"
                                placeholder="Enter merchant">
                        </div>

                        <div class="mb-3">
                            <label for="cardLimit" class="form-label">Category</label>
                            <select class="form-select" id="update_category" required>
                                <option value="" selected disabled>Select category</option>

                                <!-- Food & Dining -->
                                <optgroup label="Food & Dining">
                                    <option value="Groceries">Groceries</option>
                                    <option value="Restaurants">Restaurants</option>
                                    <option value="Coffee / Cafe">Coffee / Cafe</option>
                                    <option value="Fast Food">Fast Food</option>
                                </optgroup>

                                <!-- Transportation -->
                                <optgroup label="Transportation">
                                    <option value="Fuel / Gas">Fuel / Gas</option>
                                    <option value="Public Transport">Public Transport</option>
                                    <option value="Ride Hailing">Ride Hailing</option>
                                    <option value="Car Maintenance / Parking / Tolls">Car Maintenance / Parking / Tolls
                                    </option>
                                </optgroup>

                                <!-- Shopping -->
                                <optgroup label="Shopping">
                                    <option value="Online Shopping">Online Shopping</option>
                                    <option value="Clothing / Fashion">Clothing / Fashion</option>
                                    <option value="Electronics / Gadgets">Electronics / Gadgets</option>
                                    <option value="Home / Furniture">Home / Furniture</option>
                                </optgroup>

                                <!-- Bills & Utilities -->
                                <optgroup label="Bills & Utilities">
                                    <option value="Electricity">Electricity</option>
                                    <option value="Water">Water</option>
                                    <option value="Internet / Mobile / Cable">Internet / Mobile / Cable</option>
                                    <option value="Rent / Mortgage">Rent / Mortgage</option>
                                </optgroup>

                                <!-- Travel & Leisure -->
                                <optgroup label="Travel & Leisure">
                                    <option value="Flights / Airlines">Flights / Airlines</option>
                                    <option value="Hotels / Accommodation">Hotels / Accommodation</option>
                                    <option value="Entertainment / Movies / Shows">Entertainment / Movies / Shows</option>
                                    <option value="Hobbies / Sports">Hobbies / Sports</option>
                                </optgroup>

                                <!-- Financial -->
                                <optgroup label="Financial">
                                    <option value="Bank Fees">Bank Fees</option>
                                    <option value="Loan Payments">Loan Payments</option>
                                    <option value="Credit Card Payments">Credit Card Payments</option>
                                    <option value="Insurance">Insurance</option>
                                </optgroup>

                                <!-- Healthcare -->
                                <optgroup label="Healthcare">
                                    <option value="Doctor / Hospital">Doctor / Hospital</option>
                                    <option value="Medicine / Pharmacy">Medicine / Pharmacy</option>
                                    <option value="Fitness / Gym">Fitness / Gym</option>
                                </optgroup>

                                <!-- Others / Miscellaneous -->
                                <optgroup label="Others / Miscellaneous">
                                    <option value="Gifts / Donations">Gifts / Donations</option>
                                    <option value="Education / Books">Education / Books</option>
                                    <option value="Subscriptions">Subscriptions</option>
                                    <option value="Miscellaneous">Miscellaneous</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cardLimit" class="form-label">Amount</label>
                            <input type="text" class="form-control" id="update_amount" name="limit"
                                placeholder="Enter amount">
                        </div>


                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit_update_expenses_btn">Save</button>
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
        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {

            var selectedMonth = $('#month_filter').val();
            var selectedCard = $('#card_filter').val();
            var selectedYear = $('#year_filter').val();

            var date = data[2]; // date column
            var card = data[1]; // card column

            var rowDate = new Date(date);
            var rowMonth = rowDate.getMonth() + 1;
            var rowYear = rowDate.getFullYear();

            rowMonth = rowMonth < 10 ? '0' + rowMonth : rowMonth;

            // Month filter
            if (selectedMonth && rowMonth !== selectedMonth) return false;

            // Year filter
            if (selectedYear && rowYear != selectedYear) return false;

            // Card filter
            if (selectedCard && card !== selectedCard) return false;

            return true;
        });

        $('#month_filter, #card_filter, #year_filter').change(function () {
            $('#expenses_table').DataTable().draw();
        });

        let now = new Date();
        $('#month_filter').val(String(now.getMonth() + 1).padStart(2, '0'));
        $('#year_filter').val(now.getFullYear());

        $('#expenses_table').DataTable().draw();


        $(document).ready(function () {
            $('#expenses_table').DataTable({
                destroy: true,
                serverSide: false,
                processing: false,
                order: [[0, 'desc']],
                ajax: {
                    url: '{{ route('display_expenses') }}',
                    type: 'GET', //if GET, no need for csrf token
                    // data: {_token:''} 

                },
                columns: [{
                    data: 'id'
                },
                {
                    data: 'card'
                },
                {
                    data: 'date'
                },
                {
                    data: 'merchant'
                },
                {
                    data: 'category'
                },
                {
                    data: 'amount'
                },
                {
                    data: 'action'
                }]
            });
        });
        $(document).on('click', '#add_expenses_btn', function () {
            var card = $('#card').val();
            var date = $('#date').val();
            var merchant = $('#merchant').val();
            var category = $('#category').val();
            var amount = $('#amount').val();

            let check = true; // assume all fields are valid initially

            if (
                card === "Select Card" ||
                date === "Select Date" ||
                merchant === "Enter merchant" ||
                merchant === "" ||
                merchant === null ||
                category === "Enter category" ||
                amount === "Enter amount" ||
                amount === null ||
                amount === "" ||
                isNaN(Number(amount)) // check if amount is not a valid number
            ) {
                check = false; // at least one field is empty, unselected, or invalid
            }


            if (check == true) {
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
                    url: "{{ route('add_expenses') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        card, date, merchant, category, amount
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
                        $('#card').val("Select Card");
                        $('#date').val("");
                        $('#merchant').val("");
                        $('#category').val("");
                        $('#amount').val("");

                        $('#expenses_table').DataTable().ajax.reload();
                    }
                });
            }
            else {
                Swal.fire({
                    title: "Oops!",
                    text: "Fiels incomplete or invalid data",
                    icon: "warning",
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
            }
        });

        $(document).on('click', '.btn_update', function () {
            $('#update_expenses_modal').modal('show');
            $('#update_id').val($(this).data('id'));
            $('#update_card').val($(this).data('card'));
            $('#update_date').val($(this).data('date'));
            $('#update_merchant').val($(this).data('merchant'));
            $('#update_category').val($(this).data('category'));
            $('#update_amount').val($(this).data('amount'));
        });

        $(document).on('click', '#submit_update_expenses_btn', function () {
            $('#update_expenses_modal').modal('hide');
            var update_id = $('#update_id').val();
            var update_card = $('#update_card').val();
            var update_date = $('#update_date').val();
            var update_merchant = $('#update_merchant').val();
            var update_category = $('#update_category').val();
            var update_amount = $('#update_amount').val();

            let update_check = true;

            // Card
            if (update_card === "Select Card" || update_card === null || update_card === "") {
                update_check = false;
            }

            // Date
            if (update_date === "Select Date" || update_date === null || update_date === "") {
                update_check = false;
            }

            // Merchant
            if (update_merchant === "Enter merchant" || update_merchant === null || update_merchant === "") {
                update_check = false;
            }

            // Category
            if (update_category === "Select category" || update_category === null || update_category === "") {
                update_check = false;
            }

            // Amount
            if (update_amount === "Enter amount" || update_amount === null || update_amount === "" || isNaN(Number(update_amount))) {
                update_check = false;
            }

            if (update_check == true) {
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
                    url: "{{ route('update_expenses') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        update_id, update_card, update_date, update_merchant, update_category, update_amount
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
                        $('#expenses_table').DataTable().ajax.reload();
                    }
                });
            }
            else {
                Swal.fire({
                    title: "Oops!",
                    text: "Fiels incomplete or invalid data",
                    icon: "warning",
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        // This code runs **when user clicks OK**
                        $('#update_expenses_modal').modal('show');
                        // You can reset the form, focus a field, or perform any action here
                    }
                });
            }
        });

        $(document).on('click', '.btn_delete', function () {
            var delete_id = $(this).data('id');
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
                        url: '{{ route("delete_expenses") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            delete_id
                        },
                        success: function (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Record has been deleted.",
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
                            $('#expenses_table').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection