<div class="table-responsive text-nowrap p-3">
    <table id="{{ $table_id ?? 'dt_table' }}" class="table">
        <thead>
            <tr>
                @foreach ($header as $h)
                    <th>{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
    </table>
</div>
