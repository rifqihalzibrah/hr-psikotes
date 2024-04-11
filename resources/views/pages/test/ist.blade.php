@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <div class="card p-3">
        <h4 class="fw-bold py-3 mb-4">{{ @$title }}</h4>
        <div class="row mb-5">
            @foreach ($ist as $number => $i)
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $i['title'] }}</h5>
                            <p class="card-text">{{ $i['subtitle'] }}.</p>
                            <a href="{{ $i['route'] }}" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection
