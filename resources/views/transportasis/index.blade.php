@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Table Transportasi</h3>
            @can('transportasi-create')
                <a href="{{ route('transportasis.create') }}" class="btn btn-success">Create Transportasi</a>
            @endcan
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah Penumpang</th>
                            <th>Menit per KM Luar Kota</th>
                            <th>Menit per KM Dalam Kota</th>
                            <th>Biaya per KM</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('transportasis.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jumlah_penumpang',
                        name: 'jumlah_penumpang'
                    },
                    {
                        data: 'menit_per_km_luar_kota',
                        name: 'menit_per_km_luar_kota'
                    },
                    {
                        data: 'menit_per_km_dalam_kota',
                        name: 'menit_per_km_dalam_kota'
                    },
                    {
                        data: 'biaya_per_km',
                        name: 'biaya_per_km'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endpush
