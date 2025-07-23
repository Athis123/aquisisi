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
                    if (auth()->user()->hasRole('admin')) {
                        $button .= '<a href="' . route('admin.data.order.edit', $item->id) . '" title="Edit" class="btn btn-xs btn-warning mr-1"><i class="far fa-edit"></i></a>';
                        $button .= '<button 
                            title="Hapus"
                            data-id="' . $item->id . '"  
                            data-url="' . route('admin.data.order.index') . '"  
                            class="btn btn-xs btn-danger confirm_delete"><i class="fas fa-trash-alt"></i></button>';
                    }

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

}