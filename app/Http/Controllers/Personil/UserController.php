<?php

namespace App\Http\Controllers\Personil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = User::with('roles')->select('users.*');
            
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('role',function($item){
                return $item->roles->pluck('name')[0];
            })
            ->addColumn('aksi', function (User $item) {
                $button = '<a href="'.route('admin.personil.user.edit',['user' => $item->id]).'" class="btn btn-xs btn-warning mr-1"><i class="far fa-edit"></i></a>';
                $button .= '<button 
                    data-id="'.$item->id.'"  
                    data-url="'.route('admin.personil.user.index').'"  
                    class="btn btn-xs btn-danger confirm_delete"><i class="fas fa-trash-alt"></i></button>';
                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }

        $title = 'Data User';

        return view('personil.user.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Data Personil';

        return view('personil.user.create',compact('title'));
    }
}