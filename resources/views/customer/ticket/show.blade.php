@extends('layouts/layout')

@section('title', 'Customer Dashboard')

@section('page-style')
    @vite([])
@endsection

@section('page-script')
    @vite([])
@endsection

@section('content')
<style>
    main {
        margin: 0 auto; /* Center the main content */
        min-height: 100vh; /* Ensure it takes at least the full height of the viewport */
        display: flex;
        flex-direction: column;
    }

    .section {
        flex: 1; /* Allows the section to grow and fill available space */
    }

    .ticket-detail {
        margin-bottom: 20px;
    }

    .response-form {
        margin-top: 20px;
    }
</style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Ticket Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ticket.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Ticket</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ticket Information</h5>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="ticket-detail">
                    <h6>Subject: {{ $data->subject }}</h6>
                    <p><strong>Description:</strong> {{ $data->description }}</p>
                    <p><strong>Status:</strong>
                        @if ($data->status == \App\Models\Ticket::STATUS_OPEN)
                            <span class="badge bg-success">{{ \App\Enums\TicketEnum::STATUS_OPEN }}</span>
                        @else
                            <span class="badge bg-danger">{{ \App\Enums\TicketEnum::STATUS_CLOSED }}</span>
                        @endif
                    </p>

                        @csrf
                        @if ($data->response)
                            <div class="mb-3">
                                <label for="response" class="form-label">Admin Response</label>
                                <textarea name="response" id="response" rows="4" class="form-control" required disabled>{{$data->response?->response}}</textarea>
                            </div>
                        @else
                            <div>Awaiting for Admin response</div>
                        @endif
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
