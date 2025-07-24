@extends('layouts.stisla')

@section('title', $title)

@section('content')
    @include('components.breadcrumbs', [
        'title' => $title,
        'breadcrumbs' => [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard.index')],
            ['label' => 'User', 'url' => route('admin.personil.user.index')],
            ['label' => 'Tambah']
        ]
    ])

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.personil.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="form-group col-md-4">
                        <label>Role</label>
                        <select name="role" class="form-control border border-dark" required>
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $id => $name)
                                <option value="{{ $id }}">{{ ucfirst($name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control border border-dark" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control border border-dark" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control border border-dark" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>No Hp</label>
                        <input type="text" name="no_hp" class="form-control border border-dark" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control border border-dark" rows="2"></textarea>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Password</label>
                        <input type="text" name="provinsi" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control-file border border-dark">
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.personil.user.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function () {
        function formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }

        function unformatNumber(str) {
            return parseInt(str.replace(/[^\d]/g, '')) || 0;
        }

        function updateTotal() {
            let qty = unformatNumber($('#qty_produk').val());
            let harga = unformatNumber($('#harga_produk').val());
            let ongkir = unformatNumber($('#ongkir').val());
            let diskonOngkir = unformatNumber($('#diskon_ongkir').val());
            let adminCOD = unformatNumber($('#admin_cod').val());
            let diskonAdminCOD = unformatNumber($('#diskon_admin_cod').val());
            let pembayaran = $('#pembayaran').val();

            let total = 0;

            if (pembayaran === 'transfer') {
                $('#admin_cod').val(0);
                $('#diskon_admin_cod').val(0);
                adminCOD = 0;
                diskonAdminCOD = 0;
                total = (qty * harga) + ongkir - diskonOngkir;
            } else if (pembayaran === 'cod') {
                $('#ongkir').val(0);
                $('#diskon_ongkir').val(0);
                ongkir = 0;
                diskonOngkir = 0;
                total = (qty * harga) + adminCOD - diskonAdminCOD;
            }

            $('#total_pembayaran').val(formatNumber(total));
        }

        // Format input saat user mengetik
        function addNumberFormatting() {
            let fields = ['#harga_produk', '#ongkir', '#diskon_ongkir', '#admin_cod', '#diskon_admin_cod'];

            fields.forEach(function (selector) {
                $(selector).on('input', function () {
                    let cursorPos = this.selectionStart;
                    let rawValue = unformatNumber($(this).val());
                    $(this).val(formatNumber(rawValue));
                    this.setSelectionRange(cursorPos, cursorPos); // jaga posisi kursor
                });
            });
        }

    $(function () {
        $('#tanggalPicker').datetimepicker({ format: 'DD-MM-YYYY' });

        $('#qty_produk, #harga_produk, #ongkir, #diskon_ongkir, #admin_cod, #diskon_admin_cod, #pembayaran')
            .on('input change', updateTotal);

        addNumberFormatting();
    });

    });
</script>
@endpush