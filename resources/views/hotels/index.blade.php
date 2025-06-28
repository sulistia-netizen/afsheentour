@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Table Hotel</h3>
            @can('hotel-create')
                <a href="{{ route('hotels.create') }}" class="btn btn-success">Create Hotel</a>
            @endcan
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Hotel</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
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
                ajax: "{{ route('hotels.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_hotel',
                        name: 'nama_hotel'
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
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
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
