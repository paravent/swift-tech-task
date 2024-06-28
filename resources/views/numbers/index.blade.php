@extends('layouts.app')

@section('content')

    <div class="container mt-5 text-light">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Convert to Roman Numerals</h2>
                @if(Session::has('error')))
                <div class="alert alert-error">{{ Session::get('error')}}</div>
             @endif
                <form action="{{ route('convertToRoman') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="number" class="form-label">Enter a number (1 to 100,000)</label>
                        <input type="number" class="form-control" id="number" name="number" min="1" max="100000" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Convert</button>
                </form>
                @if(session('romanNumeral'))
                    <div class="mt-4">
                        <h4>Result:</h4>
                        <p class="lead">{{ session('romanNumeral') }}</p>
                    </div>
                @endif
            </div>
             <div class="col-md-6">
            
                <h2 class="text-center mb-4">Convert From Roman Numerals</h2>
                 @if(Session::has('error')))
                <div class="alert alert-error">{{ Session::get('error')}}</div>
             @endif
                <form action="{{ route('convertFromRoman') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="roman" class="form-label">Enter a Roman numeral (I to C̅)</label>
                        <input type="text" class="form-control" id="roman" name="roman" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Convert</button>
                </form>
                @if(session('integerValue'))
                    <div class="mt-4">
                        <h4>Result:</h4>
                        <p class="lead">
                        {{ session('integerValue') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- <div class="container mt-5">
        <h1>Latest Conversions</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Roman Numeral</th>
                </tr>
            </thead>
            <tbody>
                @forelse($conversions as $conversion)
                    <tr>
                        <td>{{ $conversion['number'] }}</td>
                        <td>{{ $conversion['romanNumeral'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No conversions yet!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> --}}


@endsection