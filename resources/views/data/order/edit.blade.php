@extends('layouts.stisla')

@section('title', $title)

@section('content')
    @include('components.breadcrumbs', [
        'title' => $title,
        'breadcrumbs' => [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard.index')],
            ['label' => 'Order', 'url' => route('admin.data.order.index')],
            ['label' => 'Edit']
        ]
    ])

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.data.order.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Tanggal Order</label>
                        <div class="input-group date" id="tanggalPicker" data-target-input="nearest">
                            <input type="text" name="tanggal" class="form-control datetimepicker-input border border-dark" value="{{ old('tanggal', $order->tanggal) }}" data-target="#tanggalPicker"/>
                            <div class="input-group-append" data-target="#tanggalPicker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Lokasi Gudang</label>
                        <select name="lok_gudang" class="form-control border border-dark">
                            <option value="">-- Pilih --</option>
                            <option value="jakarta" {{ old('lok_gudang', $order->lok_gudang) == 'jakarta' ? 'selected' : '' }}>Jakarta</option>
                            <option value="surabaya" {{ old('lok_gudang', $order->lok_gudang) == 'surabaya' ? 'selected' : '' }}>Surabaya</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nama CS</label>
                        <input type="text" name="nama_cs" class="form-control border border-dark" 
                            value="{{ old('nama_cs', $order->nama_cs) }}" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nama Advertiser</label>
                        <input type="text" name="nama_adv" class="form-control border border-dark"
                            value="{{ old('nama_adv', $order->nama_adv) }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Customer</label>
                        <input type="text" name="customer" class="form-control border border-dark"
                            value="{{ old('customer', $order->customer) }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label>SKU Produk</label>
                        <select name="sku_produk_id" class="form-control border border-dark">
                            <option value="">-- Pilih --</option>
                            @foreach ($sku as $skup)
                                <option value="{{ $skup->id }}" {{ old('sku_produk_id', $order->sku_produk_id ?? '') == $skup->id ? 'selected' : '' }}>
                                    {{ $skup->kode ? $skup->kode . ' - ' : '' }}{{ $skup->deskripsi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control border border-dark"
                            value="{{ old('nama_produk', $order->nama_produk)}}">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Qty Produk</label>
                        <input type="text" id="qty_produk" name="qty_produk" class="form-control border border-dark"
                            value="{{ old('qty_produk', $order->qty_produk) }}" min="1">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Harga Produk</label>
                        <input type="text" name="harga_produk" id="harga_produk" class="form-control border border-dark"
                            value="{{ old('harga_produk', number_format($order->harga_produk, 0, ',', '.')) }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label>No. HP</label>
                        <input type="text" name="no_hp" class="form-control border border-dark" value="{{ old('no_hp', $order->no_hp) }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control border border-dark" rows="2">{{ old('alamat', $order->alamat) }}</textarea>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi" class="form-control border border-dark"
                            value="{{ old('provinsi', $order->provinsi) }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Kabupaten</label>
                        <input type="text" name="kabupaten" class="form-control border border-dark"
                            value="{{ old('kabupaten', $order->kabupaten) }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control border border-dark"
                            value="{{ old('kecamatan', $order->kecamatan) }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Kelurahan</label>
                        <input type="text" name="kelurahan" class="form-control border border-dark"
                            value="{{ old('kelurahan', $order->kelurahan) }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" class="form-control border border-dark"
                            value="{{ old('kode_pos', $order->kode_pos) }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Kode Promo</label>
                        <select name="kode_promo_id" class="form-control border border-dark">
                            <option value="">-- Pilih --</option>
                            @foreach ($kodePromo as $promo)
                                <option value="{{ $promo->id }}" {{ old('kode_promo_id', $order->kode_promo_id ?? '') == $promo->id ? 'selected' : '' }}>
                                    {{ $promo->kode ? $promo->kode . ' - ' : '' }}{{ $promo->deskripsi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Pembayaran</label>
                        <select name="pembayaran" id="pembayaran" class="form-control border border-dark">
                            <option value="">-- Pilih --</option>
                            <option value="transfer" {{ old('pembayaran', $order->pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                            <option value="cod" {{ old('pembayaran', $order->pembayaran) == 'cod' ? 'selected' : '' }}>COD</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Ongkir</label>
                        <input type="text" name="ongkir" id="ongkir" class="form-control border border-dark"
                            value="{{ old('ongkir', number_format($order->ongkir, 0, ',', '.')) }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Diskon Ongkir</label>
                        <input type="text" name="diskon_ongkir" id="diskon_ongkir" class="form-control border border-dark"
                            value="{{ old('diskon_ongkir', number_format($order->diskon_ongkir, 0, ',', '.')) }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Admin COD</label>
                        <input type="text" name="admin_cod" id="admin_cod" class="form-control border border-dark"
                            value="{{ old('admin_cod', number_format($order->admin_cod, 0, ',', '.')) }}">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Diskon Admin COD</label>
                        <input type="text" name="diskon_admin_cod" id="diskon_admin_cod" class="form-control border border-dark"
                            value="{{ old('diskon_admin_cod', number_format($order->diskon_admin_cod, 0, ',', '.')) }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Ekspedisi</label>
                        <select name="ekpedisi" class="form-control border border-dark">
                            <option value="">-- Pilih --</option>
                            <option value="jne" {{ old('ekpedisi', $order->ekpedisi) == 'jne' ? 'selected' : '' }}>JNE</option>
                            <option value="jne" {{ old('ekpedisi', $order->ekpedisi) == 'jnt' ? 'selected' : '' }}>JNT</option>
                            <option value="ninja" {{ old('ekpedisi', $order->ekpedisi) == 'ninja' ? 'selected' : '' }}>Ninja Express</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Total Pembayaran</label>
                        <input type="text" name="total_pembayaran" id="total_pembayaran" class="form-control border border-dark"
                            value="{{ old('total_pembayaran', number_format($order->total_pembayaran, 0, ',', '.')) }}" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Bukti Transfer</label>
                        @if ($order->bukti_tf)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $order->bukti_tf) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Lihat Bukti Transfer
                                </a>
                            </div>
                        @endif
                        <input type="file" name="bukti_tf" class="form-control-file border border-dark">
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.data.order.index') }}" class="btn btn-secondary">Batal</a>
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