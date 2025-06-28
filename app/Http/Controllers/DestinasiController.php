<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class DestinasiController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:destinasi-list|destinasi-create|destinasi-edit|destinasi-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:destinasi-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:destinasi-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destinasi-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Destinasi::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('gambar', function ($row) {
                    if ($row->gambar) {
                        return '<img src="' . asset('storage/' . $row->gambar) . '" width="100" />';
                    }
                    return 'No Image';
                })
                ->addColumn('action', function ($row) {
                    $viewBtn = $editBtn = $deleteBtn = '';
                    
                    if (Auth::user() && Auth::user()->can('destinasi-list')) {
                        $viewBtn = '<a href="' . route('destinasis.show', $row->id) . '" class="btn btn-primary btn-sm">View</a>';
                    }
                    if (Auth::user() && Auth::user()->can('destinasi-edit')) {
                        $editBtn = '<a href="' . route('destinasis.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                    }

                    if (Auth::user() && Auth::user()->can('destinasi-delete')) {
                        $deleteBtn = '<form action="' . route('destinasis.destroy', $row->id) . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                  </form>';
                    }
                    return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['gambar', 'action']) // Tambahkan 'gambar' agar bisa dirender
                ->make(true);
        }

        return view('destinasis.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('destinasis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|mimes:jpg,png|max:2048',
            'harga' => 'required',
            'jumlah_jam' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'is_hotel' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();

            // Membuat nama file custom: nama-destinasi-timestamp.ext
            $customName = Str::slug($request->nama) . '-' . time() . '.' . $extension;

            // Simpan file ke storage/app/public/destinasi dengan nama custom
            $file->storeAs('destinasi', $customName);

            // Simpan nama file ke database (tanpa 'public/')
            $input['gambar'] = 'destinasi/' . $customName;
        }

        // Simpan data ke database
        Destinasi::create($input);

        return redirect()->route('destinasis.index')->with('message', 'Data destinasi berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destinasi $destinasi)
    {
        return view('destinasis.show', compact('destinasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destinasi $destinasi)
    {
        return view('destinasis.edit', compact('destinasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destinasi $destinasi)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'jumlah_jam' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'is_hotel' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($destinasi->gambar && Storage::exists('/' . $destinasi->gambar)) {
                Storage::delete('/' . $destinasi->gambar);
            }

            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();

            // Custom nama file: nama-destinasi-timestamp.ext
            $customName = Str::slug($request->nama) . '-' . time() . '.' . $extension;

            // Simpan file ke folder 'public/destinasi' dengan nama custom
            $file->storeAs('/destinasi', $customName);

            // Simpan nama file ke database (tanpa 'public/')
            $input['gambar'] = 'destinasi/' . $customName;
        } else {
            // Kalau tidak upload gambar baru, jangan ubah field gambar
            unset($input['gambar']);
        }

        $destinasi->update($input);

        return redirect()->route('destinasis.index')->with('message', 'Update data destinasi berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destinasi $destinasi)
    {
        // Hapus gambar jika ada
        if ($destinasi->gambar) {
            Storage::delete('public/' . $destinasi->gambar);
        }

        // Hapus data dari database
        $destinasi->delete();

        return redirect()->route('destinasis.index')->with('message', 'Delete data destinasi berhasil');
    }
}
