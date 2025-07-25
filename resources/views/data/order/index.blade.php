@extends('layouts.stisla')

@section('title', $title)

@section('content')
    @include('components.breadcrumbs', [
        'title' => $title,
        'breadcrumbs' => [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard.index')],
            ['label' => 'Order']
        ]
    ])

<div class="section-body">
    <a href="{{ route('admin.data.order.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Data</a>
    <a href="{{ route('admin.data.order.export') }}" class="btn btn-success mb-3">
        <i class="fas fa-file-excel"></i> Export Excel
    </a>
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
                        <th>Pembayaran</th>
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
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        let btn = this;
        Swal.fire({
            title: 'Yakin ingin menghapus data ini?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteData(btn);
            }
        });
    });

    function deleteData(button) {
        const url = $(button).data('url');

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _method: 'DELETE',
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    $('#table').DataTable().ajax.reload();

                    Swal.fire(
                        'Berhasil!',
                        'Data berhasil dihapus.',
                        'success'
                    );
                } else {
                    Swal.fire('Gagal', 'Gagal menghapus data.', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Terjadi kesalahan saat menghapus data.', 'error');
            }
        });
    }

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
        order: [[0, 'desc']],
        ajax: '{{ route('admin.data.order.index') }}',
        columns: [
            { data: 'tanggal', name: 'tanggal', orderable: false, searchable: false },
            { data: 'customer', name: 'customer'},
            { data: 'nama_produk', name: 'nama_produk' },
            { data: 'qty_produk', name: 'qty_produk' },
            { data: 'no_hp', name: 'no_hp' },
            { data: 'nama_cs', name: 'nama_cs' },
            { data: 'pembayaran', name: 'pembayaran' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush
