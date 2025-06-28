<?php

namespace App\Http\Controllers;

use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TransportasiController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:transportasi-list|transportasi-create|transportasi-edit|transportasi-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:transportasi-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:transportasi-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:transportasi-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Transportasi::query();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $viewBtn = $editBtn = $deleteBtn = '';

                    if (Auth::user() && Auth::user()->can('destinasi-list')) {
                        $viewBtn = '<a href="' . route('transportasis.show', $row->id) . '" class="btn btn-primary btn-sm">View</a>';
                    }

                    if (Auth::user() && Auth::user()->can('destinasi-list')) {
                        $editBtn = '<a href="' . route('transportasis.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                    }
    
                    if (Auth::user() && Auth::user()->can('destinasi-list')) {
                        // Form untuk delete
                        $deleteBtn = '<form action="' . route('transportasis.destroy', $row->id) . '" method="POST" style="display:inline;">
                                        ' . csrf_field() . '
                                        ' . method_field('DELETE') . '
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                      </form>';
                    }
                    
                        return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('transportasis.index',);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transportasis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jumlah_penumpang' => 'required',
            'menit_per_km_luar_kota' => 'required',
            'menit_per_km_dalam_kota' => 'required',
            'biaya_per_km' => 'required',
        ]);

        $transportasi = Transportasi::create($request->all());

        return redirect()->route('transportasis.index')->with('message','buat data transportasi berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transportasi $transportasi)
    {
        return view('transportasis.show',compact('transportasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transportasi $transportasi)
    {
        return view('transportasis.edit',compact('transportasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transportasi $transportasi)
    {
        $request->validate([
            'nama' => 'required',
            'jumlah_penumpang' => 'required',
            'menit_per_km_luar_kota' => 'required',
            'menit_per_km_dalam_kota' => 'required',
            'biaya_per_km' => 'required',
        ]);

        $transportasi->update($request->all());
        return redirect()->route('transportasis.index')->with('message','update data transportasi berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transportasi $transportasi)
    {
        $transportasi->delete();
        return redirect()->route('transportasis.index')->with('message','delete data transportasi berhasil');
    }
}
