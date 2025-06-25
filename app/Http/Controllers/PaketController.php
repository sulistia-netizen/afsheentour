<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Paket;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class PaketController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:paket-list|paket-create|paket-edit|paket-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:paket-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:paket-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:paket-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Paket::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('gambar', function ($row) {
                    if ($row->gambar) {
                        return '<img src="' . asset('storage/' . $row->gambar) . '" width="100" />';
                    }
                    return 'No Image';
                })
                ->addColumn('action', function ($row) {
                    $viewBtn = '<a href="' . route('pakets.show', $row->id) . '" class="btn btn-primary btn-sm">View</a>';
                    $editBtn = '<a href="' . route('pakets.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                    $deleteBtn = '<form action="' . route('pakets.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                            </form>';
    
                        return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                    })
                    ->rawColumns(['gambar', 'action'])
                    ->make(true);
        }
        return view('pakets.index',);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::all();
        $transportasis = Transportasi::all();
        return view('pakets.create',compact('hotels','transportasis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'jumlah_orang' => 'required',
            'harga' => 'required',
            'durasi' => 'required',
            'gambar' => 'required',
            'is_ai' => 'required',
            'id_hotel' =>'required',
            'id_transportasi' => 'required',
            'tanggal_mulai' => 'tanggal_mulai',
            'tanggal_selesai' => 'tanggal_selesai',
        ]);

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();

            // Membuat nama file custom: nama-destinasi-timestamp.ext
            $customName = Str::slug($request->nama) . '-' . time() . '.' . $extension;

            // Simpan file ke storage/app/public/destinasi dengan nama custom
            $file->storeAs('paket', $customName);

            // Simpan nama file ke database (tanpa 'public/')
            $input['gambar'] = 'paket/' . $customName;
        }
        // dd($input);

        // Simpan data ke database
        Paket::create($input);

        return redirect()->route('pakets.index')->with('message','buat data paket berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        return view('pakets.show',compact('paket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        return view('pakets.edit',compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paket $paket)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'durasi' => 'required',
            'gambar' => 'required',
            'is_ai' => 'required',
            'id_hotel' =>'required',
            'id_transportasi' => 'required',
            'tanggal_mulai' => 'tanggal_mulai',
            'tanggal_selesai' => 'tanggal_selesai',
        ]);
        $input = $request->all();
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();

            // Membuat nama file custom: nama-destinasi-timestamp.ext
            $customName = Str::slug($request->nama) . '-' . time() . '.' . $extension;

            // Simpan file ke storage/app/public/destinasi dengan nama custom
            $file->storeAs('paket', $customName);

            // Simpan nama file ke database (tanpa 'public/')
            $input['gambar'] = 'paket/' . $customName;
        }

        $paket->update($input);
        return redirect()->route('pakets.index')->with('message','update data paket berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        // Hapus gambar jika ada
        if ($paket->gambar) {
            Storage::delete('public/' . $paket->gambar);
        }

        // Hapus data dari database
        $paket->delete();

        return redirect()->route('pakets.index')->with('message','delete data paket berhasil');

    }
}
