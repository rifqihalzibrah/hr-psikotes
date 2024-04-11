@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <form>
        <div class="card p-3">
            <h4 class="fw-bold py-3 mb-4">{{ @$title }}</h4>
            @foreach ($questions as $number => $question)
                <fieldset class="border p-2 rounded">
                    <legend>Soal {{ $number }}</legend>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                            id="{{ strtolower(str_replace(' ', '_', 'soal_' . $number . '_pilihan_satu')) }}"
                            name="soal_{{ $number }}" value="1">
                        <label class="form-check-label"
                            for="{{ strtolower(str_replace(' ', '_', 'soal_' . $number . '_pilihan_satu')) }}">{{ $question['text'] }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                            id="{{ strtolower(str_replace(' ', '_', 'soal_' . $number . '_pilihan_dua')) }}"
                            name="soal_{{ $number }}" value="2">
                        <label class="form-check-label"
                            for="{{ strtolower(str_replace(' ', '_', 'soal_' . $number . '_pilihan_dua')) }}">{{ $question['alternative'] }}</label>
                    </div>
                </fieldset>
                <br>
            @endforeach
        </div>
    </form>
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection
