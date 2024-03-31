@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <form class="card mb-4" action="{{ @$action_route }}" method="POST">
        @csrf
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ @$title }} Form</h5>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>
                <button class="btn btn-primary" type="submit">
                    <span>Save</span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="John Doe">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="username">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" id="username" placeholder="johndoe">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="email">Email</label>
                <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                        <input type="text" name="email" id="email" class="form-control"
                            placeholder="test@example.com">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="password">Password</label>
                <div class="col-sm-10">
                    <input type="password" id="password" class="form-control" name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" />
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection
