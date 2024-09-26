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
</style>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Ticket List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Ticket</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="card">
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
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Ticket List</h5>
                        <a href="{{ route('ticket.create') }}" class="btn btn-primary mb-3 mt-2">Create Ticket</a>
                    </div>
                    
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        @if ($item->status == \App\Models\Ticket::STATUS_OPEN)
                                            <span class="badge bg-success">{{ \App\Enums\TicketEnum::STATUS_OPEN }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ \App\Enums\TicketEnum::STATUS_CLOSED }}</span>
                                        @endif
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection