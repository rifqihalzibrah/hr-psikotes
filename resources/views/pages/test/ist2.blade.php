@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <form>
        <div class="card p-3">
            <h4 class="fw-bold py-3 mb-4">{{ @$title }}</h4>
            <div>
                <h3>PETUNJUK DAN CONTOH UNTUK KELOMPOK SOAL 02 (Soal-soal 21 – 40)</h3>
                <p>
                    Ditentukan lima kata.
                    Pada 4 dari 5 kata itu terdapat suatu kesamaan.
                    Carilah kata yang kelima yang tidak memiliki kesamaan dengan keempat kata itu.
                </p>
                <h4>Contoh 02</h4>
                <ul>
                    <li>a) meja</li>
                    <li>b) kursi</li>
                    <li>c) burung</li>
                    <li>d) lemari</li>
                    <li>e) tempat tidur</li>
                </ul>
                <p>
                    a, b, d dan e ialah perabot rumah (meubel).
                    c) burung, bukan perabot rumah atau tidak memiliki kesamaan keempat kata itu.
                    Oleh karena itu, pada lembar jawaban di belakang contoh 02, huruf c harus dicoret.
                </p>
                <p>02) <span class="strike">a</span> <span class="strike">b</span> c <span class="strike">d</span> <span
                        class="strike">e</span></p>
                <h4>Contoh berikutnya:</h4>
                <ul>
                    <li>a) duduk</li>
                    <li>b) berbaring</li>
                    <li>c) berdiri</li>
                    <li>d) berjalan</li>
                    <li>e) berjongkok</li>
                </ul>
                <p>
                    Pada a, b, c dan e orang berada dalam keadaan tidak bergerak, sedangkan d orang dalam keadaan bergerak.
                    Maka jawaban yang benar adalah: <span class="strike">d) berjalan</span>
                    Oleh karena itu huruf d seharusnya yang dicoret.
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
