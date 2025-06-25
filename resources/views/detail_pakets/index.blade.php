@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Table Detail Paket</h3>
                <a href="{{ route('detail_pakets.create') }}" class="btn btn-success btn-sm">+ Create Detail Paket</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Paket</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>ID Destinasi</th>
                            <th>ID Transportasi</th>
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
    <!-- DataTables Bootstrap 4 Support -->
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('detail_pakets.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'paket',
                        name: 'paket'
                    },
                    {
                        data: 'jam_mulai',
                        name: 'jam_mulai'
                    },
                    {
                        data: 'jam_selesai',
                        name: 'jam_selesai'
                    },
                    {
                        data: 'destinasi',
                        name: 'destinasi'
                    },
                    {
                        data: 'transportasi',
                        name: 'transportasi'
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
