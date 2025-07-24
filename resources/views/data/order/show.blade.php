@extends('layouts.stisla')

@section('title', $title)

@section('content')
<div class="section-header">
    <h1>{{ $title }}</h1>
</div>
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Data Order #{{ $order->id }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Lokasi Gudang</th>
                    <td>{{ $order->lok_gudang }}</td>
                </tr>
                <tr>
                    <th>Nama CS</th>
                    <td>{{ $order->nama_cs }}</td>
                </tr>
                <tr>
                    <th>Nama Advertiser</th>
                    <td>{{ $order->nama_adv }}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{ $order->customer }}</td>
                </tr>
                <tr>
                    <th>SKU Produk</th>
                    <td>{{ $order->sku ? $order->sku->kode . ' - ' . $order->sku->deskripsi : '-' }}</td>
                </tr>
                <tr>
                    <th>Produk</th>
                    <td>{{ $order->nama_produk }}</td>
                </tr>
                <tr>
                    <th>Qty</th>
                    <td>{{ $order->qty_produk }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>{{ number_format($order->harga_produk, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>No HP</th>
                    <td>{{ $order->no_hp }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $order->alamat }}</td>
                </tr>
                <tr>
                    <th>Provinsi</th>
                    <td>{{ $order->provinsi }}</td>
                </tr>
                <tr>
                    <th>Kabupaten</th>
                    <td>{{ $order->kabupaten }}</td>
                </tr>
                <tr>
                    <th>Kecamatan</th>
                    <td>{{ $order->kecamatan }}</td>
                </tr>
                <tr>
                    <th>Kelurahan</th>
                    <td>{{ $order->kelurahan }}</td>
                </tr>
                <tr>
                    <th>Kode Pos</th>
                    <td>{{ $order->kode_pos }}</td>
                </tr>
                <tr>
                    <th>Kode Promo</th>
                    <td>{{ $order->promo ? $order->promo->kode . ' - ' . $order->promo->deskripsi : '-' }}</td>
                </tr>
                <tr>
                    <th>Pembayaran</th>
                    <td>{{ $order->pembayaran }}</td>
                </tr>
                <tr>
                    <th>Ongkir</th>
                    <td>{{ number_format($order->ongkir, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Diskon Ongkir</th>
                    <td>{{ number_format($order->diskon_ongkir, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Admin COD</th>
                    <td>{{ number_format($order->admin_cod, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Diskon Admin COD</th>
                    <td>{{ number_format($order->diskon_admin_cod, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Ekspedisi</th>
                    <td>{{ $order->ekpedisi }}</td>
                </tr>
                <tr>
                    <th>Total Pemabayaran</th>
                    <td>{{ number_format($order->total_pembayaran, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Bukti Transfer</th>
                    <td>
                        @if ($order->bukti_tf)
                            <a 
                                href="{{ asset('storage/' . $order->bukti_tf) }}" 
                                target="_blank" 
                                class="btn btn-sm btn-info"
                            >
                                <i class="fas fa-eye"></i> Lihat Bukti Transfer
                            </a>
                        @else
                            <span class="text-danger">Tidak ada file</span>
                        @endif
                    </td>
                </tr>
            </table>
            <a href="{{ route('admin.data.order.index') }}" class="btn btn-secondary mt-2">Kembali</a>
        </div>
    </div>
</div>
@endsection