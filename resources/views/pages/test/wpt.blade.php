@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <form>
        <div class="card p-3">
            <h4 class="fw-bold py-3 mb-4">{{ @$title }}</h4>
            @foreach ($questions as $number => $question)
                <fieldset class="border p-2 rounded">
                    <legend>Soal {{ $number + 1 }}</legend>
                    <div>
                        {!! $question['text'] !!}
                    </div>
                    <div>
                        {!! $question['img'] !!}
                    </div>
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
                        @if ($question['input'])
                            <input class="form-control w-25" type="text" name="soal_{{ $number + 1 }}" value="">
                        @endif
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
