<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data\Order;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = Order::query();

            return Datatables::of($data)
                ->addColumn('aksi', function ($item) {
                    $button = '<a href="' . route('admin.data.order.show', $item->id) . '" title="Detail" class="btn btn-xs btn-info mr-1"><i class="fas fa-eye"></i></a>';
                    // if (auth()->user()->hasRole('admin')) {
                        $button .= '<a href="' . route('admin.data.order.edit', $item->id) . '" title="Edit" class="btn btn-xs btn-warning mr-1"><i class="far fa-edit"></i></a>';
                        $button .= '<button 
                                class="btn btn-xs btn-danger btn-delete"
                                data-id="' . $item->id . '"
                                data-url="' . route('admin.data.order.destroy', $item->id) . '"
                                title="Hapus"><i class="fas fa-trash-alt"></i>
                            </button>';
                    // }

                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make();
        }

        $title = 'Data Order';
        return view('data.order.index', compact('title'));
    }

    public function create()
    {
        $title = 'Create Data Order';

        return view('data.order.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'       => 'required|date_format:d-m-Y',
            'lok_gudang'    => 'required|string',
            'nama_cs'       => 'required|string',
            'nama_adv'      => 'required',
            'sku_produk'    => 'required',
            'nama_produk'   => 'required',
            'qty_produk'    => 'required',
            'harga_produk'  => 'required',
            'customer'      => 'required',
            'no_hp'         => 'nullable',
            'alamat'        => 'nullable',
            'provinsi'      => 'required',
            'kabupaten'     => 'required',
            'kecamatan'     => 'required',
            'kelurahan'     => 'required',
            'kode_pos'      => 'required',
            'kode_promo'    => 'nullable',
            'pembayaran'    => 'required',
            'ongkir'        => 'nullable',
            'diskon_ongkir' => 'nullable',
            'admin_cod'     => 'nullable',
            'diskon_admin_cod' => 'nullable',
            'ekpedisi'         => 'required',
            'total_pembayaran' => 'required',
            'bukti_tf'         => 'nullable'
        ]);

        // Bersihkan format angka dari titik
        $harga_produk = str_replace('.', '', $request->harga_produk);
        $ongkir = str_replace('.', '', $request->ongkir);
        $diskon_ongkir = str_replace('.', '', $request->diskon_ongkir);
        $admin_cod = str_replace('.', '', $request->admin_cod);
        $diskon_admin_cod = str_replace('.', '', $request->diskon_admin_cod);
        $total_pembayaran = str_replace('.', '', $request->total_pembayaran);

        // Simpan ke DB
        Order::create([
            'tanggal' => \Carbon\Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d'),
            'lok_gudang' => $request->lok_gudang,
            'nama_cs' => $request->nama_cs,
            'nama_adv' => $request->nama_adv,
            'sku_produk' => $request->sku_produk,
            'nama_produk' => $request->nama_produk,
            'qty_produk' => $request->qty_produk,
            'harga_produk' => $request->harga_produk,
            'customer' => $request->customer,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'kode_pos' => $request->kode_pos,
            'kode_promo' => $request->kode_promo,
            'pembayaran' => $request->pembayaran,
            'ongkir' => $ongkir,
            'diskon_ongkir' => $diskon_ongkir,
            'admin_cod' => $admin_cod,
            'diskon_admin_cod' => $diskon_admin_cod,
            'ekpedisi' => $request->ekpedisi,
            'total_pembayaran' => $total_pembayaran,
            'bukti_tf' => $request->hasFile('bukti_tf') 
                ? $request->file('bukti_tf')->store('bukti_tf', 'public') 
                : null,
        ]);

        Alert::success('Berhasil', 'Data Order berhasil disimpan');
        return redirect()->route('admin.data.order.index');
    }

    public function edit($id)
    {
        $title = 'Edit Data Order';
        $order = Order::findOrFail($id);
        return view('data.order.edit', compact('title', 'order'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date_format:d-m-Y',
            'lok_gudang' => 'required',
            'nama_cs' => 'required',
            'nama_adv' => 'nullable',
            'sku_produk' => 'required',
            'nama_produk' => 'required',
            'qty_produk' => 'required|numeric',
            'harga_produk' => 'required',
            'customer' => 'required',
            'no_hp' => 'nullable',
            'alamat' => 'nullable',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kode_pos' => 'required',
            'kode_promo' => 'nullable',
            'pembayaran' => 'required',
            'ongkir' => 'nullable',
            'diskon_ongkir' => 'nullable',
            'admin_cod' => 'nullable',
            'diskon_admin_cod' => 'nullable',
            'ekpedisi' => 'required',
            'total_pembayaran' => 'required',
            'bukti_tf' => 'nullable|file',
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'tanggal' => \Carbon\Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d'),
            'lok_gudang' => $request->lok_gudang,
            'nama_cs' => $request->nama_cs,
            'nama_adv' => $request->nama_adv,
            'sku_produk' => $request->sku_produk,
            'nama_produk' => $request->nama_produk,
            'qty_produk' => $request->qty_produk,
            'harga_produk' => str_replace('.', '', $request->harga_produk),
            'customer' => $request->customer,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'kode_pos' => $request->kode_pos,
            'kode_promo' => $request->kode_promo,
            'pembayaran' => $request->pembayaran,
            'ongkir' => str_replace('.', '', $request->ongkir),
            'diskon_ongkir' => str_replace('.', '', $request->diskon_ongkir),
            'admin_cod' => str_replace('.', '', $request->admin_cod),
            'diskon_admin_cod' => str_replace('.', '', $request->diskon_admin_cod),
            'ekpedisi' => $request->ekpedisi,
            'total_pembayaran' => str_replace('.', '', $request->total_pembayaran),
            'bukti_tf' => $request->hasFile('bukti_tf') 
                ? $request->file('bukti_tf')->store('bukti_tf', 'public') 
                : $order->bukti_tf,
        ]);

        Alert::success('Berhasil', 'Data Order berhasil diperbarui');
        return redirect()->route('admin.data.order.index');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $title = 'Detail Order';
        return view('data.order.show', compact('order', 'title'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }


}