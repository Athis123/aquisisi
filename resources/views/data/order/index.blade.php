@extends('layouts.stisla')

@section('title', $title)

@section('content')
<div class="section-header">
    <h1>{{ $title }}</h1>
</div>

<div class="section-body">
    <a href="{{ route('admin.data.order.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Data</a>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="table" width="100%">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>no_hp</th>
                        <th>Nama CS</th>
                        <th>Pemabayaran</th>
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
        ajax: '{{ route('admin.data.order.index') }}',
        columns: [
            { data: 'tanggal', name: 'tanggal', orderable: false, searchable: false },
            { data: 'customer', name: 'customer'},
            { data: 'nama_produk', name: 'nama_produk' },
            { data: 'qty_produk', qty_produk: 'name' },
            { data: 'no_hp', name: 'no_hp' },
            { data: 'nama_cs', name: 'nama_cs' },
            { data: 'pembayaran', name: 'pembayaran' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush
