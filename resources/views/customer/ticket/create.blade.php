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
    /* Add shadow to input box */
    .form-control {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ccc;
        transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .form-control:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 8px rgba(76, 175, 80, 0.3);
        outline: none;
    }

    /* Disabled input styling */
    .form-control[disabled] {
        background-color: #f5f5f5;
        color: #6c757d;
        border: 1px solid #ced4da;
    }

    /* Button styling */
    .btn-primary {
        background-color: #4CAF50;
        border-color: #4CAF50;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #45a049;
    }

    /* Card shadow */
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    main {
        max-width: 1200px;
        margin: 0 auto;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .section {
        flex: 1;
    }

    .invalid-feedback {
        display: block;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Create Ticket</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Ticket</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-title"></div>
            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
            <div class="card-body">
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

                <form method="POST" action="{{ route('ticket.store') }}">
                    @csrf

                    <!-- Ticket Subject -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="subject" class="form-label">Ticket Subject</label>
                            <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" id="subject" value="{{ old('subject') }}">
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Ticket Description -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Ticket Status (Hidden Input with default value) -->
                    <input type="hidden" name="status" value="1"> <!-- 1 = Open -->

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-md-12 text-end"> 
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

@endsection