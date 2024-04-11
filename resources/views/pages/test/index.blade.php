@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> {{ @$title }}</h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Table {{ @$title }}</h5>
            {{-- <div>
                <a href="{{ $create_route }}" class="btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0"
                    type="button">
                    <span><i class="bx bx-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add</span></span>
                </a>
            </div> --}}
        </div>
        @include('layouts.table', ['header' => $table_header])
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#dt_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('test.datatables') }}",
                    type: 'GET'
                },
                columns: [
                    // Define your columns here
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'jumlah_soal',
                        name: 'jumlah_soal'
                    },
                    {
                        data: 'durasi_soal',
                        name: 'durasi_soal'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>
@endsection

@section('script-bottom')
@endsection
