@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Table Ulasans</h3>
            @can('ulasan-create')
                <a href="{{ route('ulasans.create') }}" class="btn btn-success">Create Ulasan</a>
            @endcan
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>ID Paket</th>
                            <th>Rating</th>
                            <th>Komentar</th>
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('ulasans.index') }}",
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
                        data: 'rating',
                        name: 'rating'
                    },
                    {
                        data: 'komentar',
                        name: 'komentar'
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
