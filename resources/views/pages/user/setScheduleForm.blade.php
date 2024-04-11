@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <form class="card mb-4" action="{{ $action_route }}" method="POST">
        @csrf
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ @$title }}</h5>
        </div>
        <div class="card-body">
            <div class="info-container">
                <ul class="list-unstyled">
                    <input type="hidden" name="user_id" value="{{ $data_user->id }}">
                    <li class="mb-3">
                        <span class="fw-medium me-2">Username:</span>
                        <span>{{ $data_user->username }}</span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium me-2">Name:</span>
                        <span>{{ $data_user->name }}</span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium me-2">Email:</span>
                        <span>{{ $data_user->email }}</span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium me-2">Status:</span>
                        <span class="badge bg-label-success">Eligible</span>
                    </li>
                </ul>
            </div>
            @foreach ($tests as $data => $test)
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="test_ids[]" id="{{ $test->key }}Checkbox"
                        value="{{ $test->id }}">
                    <label class="form-check-label" for="{{ $test->key }}Checkbox">{{ $test->name }}</label>
                </div>
                <div id="{{ $test->key }}ChildInputs" class="px-3" style="display: none;">
                </div>
            @endforeach
            <div class="mt-3 d-flex justify-content-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>
                <button class="btn btn-primary" type="submit">
                    <span>Submit</span>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        const istCheckbox = document.getElementById('istCheckbox');
        const istChildInputs = document.getElementById('istChildInputs');

        const cfitCheckbox = document.getElementById('cfitCheckbox');
        const cfitChildInputs = document.getElementById('cfitChildInputs');

        istCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // Append child or sub inputs for IST
                istChildInputs.innerHTML = `
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="istCheckbox">
                    <label class="form-check-label" for="istCheckbox">IST 1</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="istCheckbox">
                    <label class="form-check-label" for="istCheckbox">IST 2</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="istCheckbox">
                    <label class="form-check-label" for="istCheckbox">IST 3</label>
                </div>
                `;
                istChildInputs.style.display = 'block';
            } else {
                // Remove child or sub inputs for IST
                istChildInputs.innerHTML = '';
                istChildInputs.style.display = 'none';
            }
        });

        cfitCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // Append child or sub inputs for IST
                cfitChildInputs.innerHTML = `
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="cfitCheckbox">
                    <label class="form-check-label" for="cfitCheckbox">CFIT 1</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="cfitCheckbox">
                    <label class="form-check-label" for="cfitCheckbox">CFIT 2</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="cfitCheckbox">
                    <label class="form-check-label" for="cfitCheckbox">CFIT 3</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="cfitCheckbox">
                    <label class="form-check-label" for="cfitCheckbox">CFIT 4</label>
                </div>
                `;
                cfitChildInputs.style.display = 'block';
            } else {
                // Remove child or sub inputs for IST
                cfitChildInputs.innerHTML = '';
                cfitChildInputs.style.display = 'none';
            }
        });
    </script>
@endsection

@section('script-bottom')
@endsection
