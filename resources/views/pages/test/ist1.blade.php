@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <form>
        <div class="card p-3">
            <h4 class="fw-bold py-3 mb-4">{{ @$title }}</h4>
            <div>
                <h3>PETUNJUK DAN CONTOH UNTUK KELOMPOK SOAL 01 (Soal-soal 01 – 20)</h3>
                <p>Soal-soal 01 – 20 terdiri atas kalimat-kalimat. Pada setiap kalimat satu kata hilang dan disediakan 5
                    (lima) kata
                    pilihan sebagai penggantinya. Pilihlah kata yang tepat yang dapat menyempurnakan kalimat itu!</p>

                <h4>Contoh 01</h4>
                <p>Seekor kuda mempunyai kesamaan terbanyak dengan seekor . . . . . . . . . . . .</p>
                <ul>
                    <li>a) kucing</li>
                    <li>b) bajing</li>
                    <li>c) keledai</li>
                    <li>d) lembu</li>
                    <li>e) anjing</li>
                </ul>
                <p>Jawaban yang benar ialah: c) keledai. Oleh karena itu, pada lembar jawaban di belakang contoh 01, huruf c
                    harus
                    dicoret.</p>
                <p>01) a b <strike>c</strike> d e</p>

                <h4>Contoh berikutnya:</h4>
                <p>Lawannya “harapan” ialah . . . . . . . . . . . .</p>
                <ul>
                    <li>a) duka</li>
                    <li>b) putus asa</li>
                    <li>c) sengsara</li>
                    <li>d) cinta</li>
                    <li>e) benci</li>
                </ul>
                <p>Jawaban yang benar ialah: b) putus asa. Maka huruf b seharusnya yang dicoret.</p>
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
