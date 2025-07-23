@extends('layouts.stisla')

@section('title', $title)

@section('content')
<div class="section-header">
    <h1>{{ $title }}</h1>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.data.order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="form-group col-md-4">
                        <label>Lokasi Gudang</label>
                        <select name="lok_gudang" class="form-control border border-dark">
                            <option value="">-- Pilih --</option>
                            <option value="jakarta">Jakarta</option>
                            <option value="surabaya">Surabaya</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Ekspedisi</label>
                        <select name="ekpedisi" class="form-control border border-dark">
                            <option value="">-- Pilih --</option>
                            <option value="jne">JNE</option>
                            <option value="jnt">JNT</option>
                            <option value="ninja">Ninja Express</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nama CS</label>
                        <input type="text" name="nama_cs" class="form-control border border-dark" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nama Advertiser</label>
                        <input type="text" name="nama_adv" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-4">
                        <label>SKU Produk</label>
                        <input type="text" name="sku_produk" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Qty Produk</label>
                        <input type="number" name="qty_produk" class="form-control border border-dark" min="1">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Harga Produk</label>
                        <input type="number" name="harga_produk" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-4">
                        <label>No. HP</label>
                        <input type="text" name="no_hp" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control border border-dark" rows="2"></textarea>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Kabupaten</label>
                        <input type="text" name="kabupaten" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Kelurahan</label>
                        <input type="text" name="kelurahan" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Kode Promo</label>
                        <input type="text" name="kode_promo" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Ongkir</label>
                        <input type="number" name="ongkir" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Diskon Ongkir</label>
                        <input type="number" name="diskon_ongkir" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Admin COD</label>
                        <input type="number" name="admin_cod" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Diskon Admin COD</label>
                        <input type="number" name="diskon_admin_cod" class="form-control border border-dark">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Pembayaran</label>
                        <select name="pembayaran" class="form-control border border-dark">
                            <option value="">-- Pilih --</option>
                            <option value="transfer">Transfer</option>
                            <option value="cod">COD</option>
                            <option value="qris">NON COD</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Total Pembayaran</label>
                        <input type="number" name="total_pembayaran" class="form-control border border-dark" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Bukti Transfer</label>
                        <input type="file" name="bukti_tf" class="form-control border border-dark-file">
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.data.order.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection