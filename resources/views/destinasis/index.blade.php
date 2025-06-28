@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Table Destinasis</h3>
            @can('destinasi-create')
                <a href="{{ route('destinasis.create') }}" class="btn btn-success">Create Destinasi</a>
            @endcan

            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Jumlah Jam</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>is_hotel</th>
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
                ajax: "{{ route('destinasis.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
                        orderable: false,
                        searchable: false
                    }, // Tambah ini
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'jumlah_jam',
                        name: 'jumlah_jam'
                    },
                    {
                        data: 'latitude',
                        name: 'latitude'
                    },
                    {
                        data: 'longitude',
                        name: 'longitude'
                    },
                    {
                        data: 'is_hotel',
                        name: 'is_hotel'
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
