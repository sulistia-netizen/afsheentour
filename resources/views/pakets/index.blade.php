@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Table Pakets</h3>
            <div class="card-body">
                @can('paket-create')
                    <a href="{{ route('pakets.create') }}" class="btn btn-success mb-3">Create Paket</a>
                @endcan
                <!-- Wrapper untuk scroll horizontal -->
                <div class="table-responsive">
                    <table class="table table-bordered data-table nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Jumlah Orang</th>
                                <th>Harga</th>
                                <th>Durasi</th>
                                <th>Gambar</th>
                                <th>is_ai</th>
                                <th>ID Hotel</th>
                                <th>ID Transportasi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('.data-table').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('pakets.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                        render: function(data, type, row) {
                            if (type === 'display' && data.length > 50) {
                                return data.substr(0, 50) + '...';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'jumlah_orang',
                        name: 'jumlah_orang'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'durasi',
                        name: 'durasi'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_ai',
                        name: 'is_ai'
                    },
                    {
                        data: 'id_hotel',
                        name: 'id_hotel'
                    },
                    {
                        data: 'id_transportasi',
                        name: 'id_transportasi'
                    },
                    {
                        data: 'tanggal_mulai',
                        name: 'tanggal_mulai'
                    },
                    {
                        data: 'tanggal_selesai',
                        name: 'tanggal_selesai'
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
