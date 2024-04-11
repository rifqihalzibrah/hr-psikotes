@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <form class="card mb-4" action="{{ @$action_route }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ @$title }}</h5>
        </div>
        <div class="card-body">
            <div>
                <label class="col-sm-2 col-form-label">Identitas</label>
            </div>
            <input type="hidden" name="user_id" value="{{ $data_user->id }}">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ $data_user->name !== null ? $data_user->name : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="nik">NIK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nik" id="nik"
                        value="{{ $data_pengajuan->nik !== null ? $data_pengajuan->nik : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="email">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" id="email"
                        value="{{ $data_user->email !== null ? $data_user->email : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="tanggal_lahir" class="col-md-2 col-form-label">Tanggal Lahir</label>
                <div class="col-md-10">
                    <input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir"
                        value="{{ $data_pengajuan->tanggal_lahir !== null ? $data_pengajuan->tanggal_lahir : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="pendidikan">Pendidikan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pendidikan" id="pendidikan"
                        value="{{ $data_pengajuan->pendidikan !== null ? $data_pengajuan->pendidikan : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="posisi">Posisi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="posisi" id="posisi"
                        value="{{ $data_pengajuan->posisi !== null ? $data_pengajuan->posisi : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="unit_divisi">Unit/Divisi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="unit_divisi" id="unit_divisi"
                        value="{{ $data_pengajuan->unit_divisi !== null ? $data_pengajuan->unit_divisi : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="departemen">Departemen</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="departemen" id="departemen"
                        value="{{ $data_pengajuan->departemen !== null ? $data_pengajuan->departemen : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="tanggal_join" class="col-md-2 col-form-label">Tanggal Join</label>
                <div class="col-md-10">
                    <input class="form-control" type="date" name="tanggal_join" id="tanggal_join"
                        value="{{ $data_pengajuan->tanggal_join !== null ? $data_pengajuan->tanggal_join : '' }}">
                </div>
            </div>
            <div>
                <label class="col-sm-2 col-form-label">Usulan</label>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="jabatan_saat_ini">Jabatan saat ini</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="jabatan_saat_ini" id="jabatan_saat_ini"
                        value="{{ $data_pengajuan->jabatan_saat_ini !== null ? $data_pengajuan->jabatan_saat_ini : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="jabatan_tujuan">Jabatan yang dituju</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="jabatan_tujuan" id="jabatan_tujuan"
                        value="{{ $data_pengajuan->jabatan_tujuan !== null ? $data_pengajuan->jabatan_tujuan : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="golongan_saat_ini">Golongan saat ini</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="golongan_saat_ini" id="golongan_saat_ini"
                        value="{{ $data_pengajuan->golongan_saat_ini !== null ? $data_pengajuan->golongan_saat_ini : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="golongan_tujuan">Golongan yang dituju</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="golongan_tujuan" id="golongan_tujuan"
                        value="{{ $data_pengajuan->golongan_tujuan !== null ? $data_pengajuan->golongan_tujuan : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="gaji_saat_ini">Gaji (upah gross) saat ini</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="gaji_saat_ini" id="gaji_saat_ini"
                        value="{{ $data_pengajuan->gaji_saat_ini !== null ? $data_pengajuan->gaji_saat_ini : '' }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="gaji_tujuan">Gaji (upah gross) yang dituju</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="gaji_tujuan" id="gaji_tujuan"
                        value="{{ $data_pengajuan->gaji_tujuan !== null ? $data_pengajuan->gaji_tujuan : '' }}">
                </div>
            </div>
            <div>
                <label class="col-sm-2 col-form-label">Informasi Pendukung</label>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="alasan_promosi">Alasan promosi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alasan_promosi" name="alasan_promosi" rows="3">{{ $data_pengajuan->alasan_promosi !== null ? $data_pengajuan->alasan_promosi : '' }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="evaluasi_atasan">Evaluasi atasan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="evaluasi_atasan" name="evaluasi_atasan" rows="3">{{ $data_pengajuan->evaluasi_atasan !== null ? $data_pengajuan->evaluasi_atasan : '' }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="rewards_prestasi">Rewards/prestasi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="rewards_prestasi" name="rewards_prestasi" rows="3">{{ $data_pengajuan->rewards_prestasi !== null ? $data_pengajuan->rewards_prestasi : '' }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="punishment_sanksi">Punishment/sanksi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="punishment_sanksi" name="punishment_sanksi" rows="3">{{ $data_pengajuan->punishment_sanksi !== null ? $data_pengajuan->punishment_sanksi : '' }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="riwayat_performance">Riwayat performance</label>
                <div class="col-sm-10 d-flex">
                    <input type="text" class="form-control me-2" name="riwayat_performance_tahun_pertama"
                        id="riwayat_performance_tahun_pertama" placeholder="Tahun pertama"
                        value="{{ $data_pengajuan->riwayat_performance_tahun_pertama !== null ? $data_pengajuan->riwayat_performance_tahun_pertama : '' }}">
                    <input type="text" class="form-control me-2" name="riwayat_performance_tahun_kedua"
                        id="riwayat_performance_tahun_kedua" placeholder="Tahun kedua"
                        value="{{ $data_pengajuan->riwayat_performance_tahun_kedua !== null ? $data_pengajuan->riwayat_performance_tahun_kedua : '' }}">
                    <input type="text" class="form-control" name="riwayat_performance_tahun_ketiga"
                        id="riwayat_performance_tahun_ketiga" placeholder="Tahun ketiga"
                        value="{{ $data_pengajuan->riwayat_performance_tahun_ketiga !== null ? $data_pengajuan->riwayat_performance_tahun_ketiga : '' }}">
                </div>
            </div>
            <div>
                <label class="col-sm-2 col-form-label">Disetujui oleh</label>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">User Pengusul</label>
                <div class="col-sm-10 d-flex">
                    <select class="form-select" aria-label="Default select example" name="user_pengusul">
                        <option value="0" {{ $data_pengajuan->user_pengusul == 0 ? 'selected' : '' }}>Tidak Setuju
                        </option>
                        <option value="1" {{ $data_pengajuan->user_pengusul == 1 ? 'selected' : '' }}>Setuju</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Atasan Pengusul</label>
                <div class="col-sm-10 d-flex">
                    <select class="form-select" aria-label="Default select example" name="atasan_pengusul">
                        <option value="0" {{ $data_pengajuan->atasan_pengusul == 0 ? 'selected' : '' }}>Tidak Setuju
                        </option>
                        <option value="1" {{ $data_pengajuan->atasan_pengusul == 1 ? 'selected' : '' }}>Setuju
                        </option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Direktur Unit</label>
                <div class="col-sm-10 d-flex">
                    <select class="form-select" aria-label="Default select example" name="direktur_unit">
                        <option value="0" {{ $data_pengajuan->direktur_unit == 0 ? 'selected' : '' }}>Tidak Setuju
                        </option>
                        <option value="1" {{ $data_pengajuan->direktur_unit == 1 ? 'selected' : '' }}>Setuju</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">HRD</label>
                <div class="col-sm-10 d-flex">
                    <select class="form-select" aria-label="Default select example" name="hrd">
                        <option value="0" {{ $data_pengajuan->hrd == 0 ? 'selected' : '' }}>Tidak Setuju
                        </option>
                        <option value="1" {{ $data_pengajuan->hrd == 1 ? 'selected' : '' }}>Setuju</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">PM</label>
                <div class="col-sm-10 d-flex">
                    <select class="form-select" aria-label="Default select example" name="pm">
                        <option value="0" {{ $data_pengajuan->pm == 0 ? 'selected' : '' }}>Tidak Setuju
                        </option>
                        <option value="1" {{ $data_pengajuan->pm == 1 ? 'selected' : '' }}>Setuju</option>
                    </select>
                </div>
            </div>
            <div class="mt-5 d-flex justify-content-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Back</a>
                <button class="btn btn-primary" type="submit">
                    <span>Post</span>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection
