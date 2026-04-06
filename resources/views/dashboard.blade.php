@extends('layouts.app') {{-- Extends the main layout --}}

@section('title', 'Dashboard') {{-- Optional: sets the page title --}}

@section('content') {{-- Everything inside this section goes into the layout's content area --}}
    <div class="container-fluid">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-normal mb-0">Outstanding / Due</h5>
        </div>

        <!-- Summary Card -->
        <div class="row g-3">

            @foreach($totals as $total)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex align-items-center gap-3 flex-wrap">
                            <!-- Icon -->
                            <div class="rounded d-flex align-items-center justify-content-center bg-primary"
                                style="width: 45px; height: 45px;">
                                <i class="bi bi-credit-card fs-5 text-white"></i>
                            </div>
                            <!-- Text -->
                            <div class="flex-grow-1">
                                <small class="text-uppercase fw-bold">{{ $total->name }}</small>
                                <div class="d-flex flex-column gap-1">
                                    <h6 class="mb-0 fw-normal">₱ {{ number_format($total->total_amount, 2) }}</h6>
                                    <small class="d-block text-muted">Due date: <span class="text-danger">{{ $year }}-{{ $month }}-{{ $total->due_day }}</span></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Card 1 -->

        </div>
        <!-- Table -->
    </div>
@endsection