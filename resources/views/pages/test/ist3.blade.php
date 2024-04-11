@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <form>
        <div class="card p-3">
            <h4 class="fw-bold py-3 mb-4">{{ @$title }}</h4>
            <div>
                <h3>PETUNJUK DAN CONTOH UNTUK KELOMPOK SOAL 03 (Soal-soal 41 – 60)</h3>
                <p>
                    Ditentukan tiga kata. Antara kata pertama dan kata kedua terdapat suatu hubungan yang tertentu. Antara
                    kata ketiga dan salah satu kata di antara lima kata pilihan harus pula terdapat hubungan yang sama itu.
                    Carilah kata itu.
                </p>
            </div>
            <h4 class="fw-bold mt-4">Soal</h4>
            @foreach ($questions as $number => $question)
                <fieldset class="border p-2 rounded">
                    <legend>Soal {{ $number + 1 }}</legend>
                    <div>
                        {!! $question['text'] !!}
                    </div>
                    <div class="my-3">
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
