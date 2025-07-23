@extends('layouts.stisla')

@section('title', $title)

@section('content')
<div class="section-header">
    <h1>{{ $title }}</h1>
</div>

<div class="section-body">
    <a href="{{ route('admin.personil.user.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah User</a>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="table" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Hp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.personil.user.index') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'role', name: 'role', orderable: false, searchable: false },
            { data: 'nik', name: 'nik' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'no_hp', name: 'no_hp' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush
