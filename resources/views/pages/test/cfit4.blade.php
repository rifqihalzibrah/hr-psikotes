@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <form>
        <div class="card p-3">
            <h4 class="fw-bold py-3 mb-4">{{ @$title }}</h4>
            <h4 class="fw-bold">Contoh</h4>
            <div class="my-2">
                <img src="{{ asset('storage/img/img_cfit/cfit_4/contoh1.png') }}">
            </div>
            <div class="my-2">
                <img src="{{ asset('storage/img/img_cfit/cfit_4/contoh2.png') }}">
            </div>
            <div class="my-2">
                <img src="{{ asset('storage/img/img_cfit/cfit_4/contoh3.png') }}">
            </div>
            <h4 class="fw-bold mt-4">Soal</h4>
            @foreach ($questions as $number => $question)
                <fieldset class="border p-2 rounded">
                    <legend>Soal {{ $number + 1 }}</legend>
                    {!! $question['text'] !!}
                    <div class="d-flex flex-wrap my-3">
                        @foreach ($question['options'] as $optionNumber => $option)
                            <div class="form-check mx-2">
                                <input class="form-check-input" type="radio"
                                    id="{{ strtolower(str_replace(' ', '_', 'soal_' . ($number + 1) . '_pilihan_' . ($optionNumber + 1))) }}"
                                    name="soal_{{ $number + 1 }}" value="{{ $optionNumber + 1 }}">
                                <label class="form-check-label"
                                    for="{{ strtolower(str_replace(' ', '_', 'soal_' . ($number + 1) . '_pilihan_' . ($optionNumber + 1))) }}">{!! $option !!}</label>
                            </div>
                        @endforeach
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