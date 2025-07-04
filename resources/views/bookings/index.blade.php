@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Table Bookings</h3>
            @can('booking-create')
                <a href="{{ route('bookings.create') }}" class="btn btn-success">Create Booking</a>
            @endcan
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>ID Paket</th>
                            <th>Jumlah Orang</th>
                            <th>Tanggal Mulai</th>
                            <th>Jumlah Biaya</th>
                            <th>Status</th>
                            <th class="text-nowrap" style="width: 200px;">Action</th>
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('bookings.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'paket',
                        name: 'paket'
                    },
                    {
                        data: 'jumlah_orang',
                        name: 'jumlah_orang'
                    },
                    {
                        data: 'tanggal_mulai',
                        name: 'tanggal_mulai'
                    },
                    {
                        data: 'jumlah_biaya',
                        name: 'jumlah biaya'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
