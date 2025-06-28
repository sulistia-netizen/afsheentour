<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\User;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UlasanController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:ulasan-list|ulasan-create|ulasan-edit|ulasan-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:ulasan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ulasan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ulasan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Ulasan::query();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                    if (Auth::user() && Auth::user()->can('ulasan-list')) {
                        $viewBtn = '<a href="' . route('ulasans.show', $row->id) . '" class="btn btn-primary btn-sm">View</a>';
                    }

                    if (Auth::user() && Auth::user()->can('ulasan-list')) {
                        $editBtn = '<a href="' . route('ulasans.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                    }
    
                    if (Auth::user() && Auth::user()->can('ulasan-list')) {
                        // Form untuk delete
                        $deleteBtn = '<form action="' . route('ulasans.destroy', $row->id) . '" method="POST" style="display:inline;">
                                        ' . csrf_field() . '
                                        ' . method_field('DELETE') . '
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                      </form>';
                    }

                        return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                    })
                    ->addColumn('user',function($row){
                        return $row->user->name;
                    })->addColumn('paket',function($row){
                        return $row->paket->nama;

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('ulasans.index',);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $pakets = Paket::all();
        return view('ulasans.create', compact('users', 'pakets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_paket' => 'required',
            'rating' => 'required',
            'komentar' => 'required',
        ]);

        $ulasan = Ulasan::create($request->all());

        return redirect()->route('ulasans.index')->with('message','buat data ulasan berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ulasan $ulasan)
    {
        return view('ulasans.show',compact('ulasan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ulasan $ulasan)
    {
        $users = User::all();
        $pembayarans = Paket::all();
        return view('ulasans.edit', compact( 'users', 'pembayarans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ulasan $ulasan)
    {
        $request->validate([
            'id_user' => 'required',
            'id_paket' => 'required',
            'rating' => 'required',
            'komentar' => 'required',
        ]);

        $ulasan->update($request->all());
        return redirect()->route('ulasans.index')->with('message','update data ulasan berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();
        return redirect()->route('ulasan.index')->with('message','delete data ulasan berhasil');
    }
}
