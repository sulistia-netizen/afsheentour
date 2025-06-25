<?php

namespace App\Http\Controllers;

use App\Models\DetailPaket;
use App\Models\Paket;
use App\Models\Destinasi;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DetailPaketController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:detail_paket-list|detail_paket-create|detail_paket-edit|detail_paket-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:detail_paket-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:detail_paket-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:detail_paket-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            // Eager load relationships to avoid N+1 query problem
            $data = DetailPaket::with(['paket.transportasi', 'destinasi']);

            // Apply search filters if any
            if ($request->has('search') && $request->search['value']) {
                $search = $request->search['value'];

                // Apply search on related fields
                $data->where(function ($query) use ($search) {
                    $query->whereHas('paket', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    })
                        ->orWhereHas('destinasi', function ($q) use ($search) {
                            $q->where('nama', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('paket.transportasi', function ($q) use ($search) {
                            $q->where('nama', 'like', '%' . $search . '%');
                        });
                });
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $viewBtn = '<a href="' . route('detail_pakets.show', $row->id) . '" class="btn btn-primary btn-sm">View</a>';
                    $editBtn = '<a href="' . route('detail_pakets.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>';

                    // Form untuk delete
                    $deleteBtn = '<form action="' . route('detail_pakets.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                              </form>';

                    return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                })
                ->addColumn('paket', function ($row) {
                    return $row->paket->nama ?? 'NULL';
                })
                ->addColumn('destinasi', function ($row) {
                    return $row->destinasi->nama ?? 'NULL';
                })
                ->addColumn('transportasi', function ($row) {
                    return $row->paket->transportasi->nama ?? 'NULL';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('detail_pakets.index');
    }



    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $pakets = Paket::all();
        $destinasis = Destinasi::all();
        $transportasis = Transportasi::all();
        return view('detail_pakets.create', compact('pakets', 'destinasis', 'transportasis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi dilakukan sekali saja di awal, bukan di dalam loop
        $request->validate([
            'id_paket' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'id_destinasi' => 'required|array',         // checkbox sebagai array
            'id_destinasi.*' => 'required|integer',     // tiap elemen array harus angka
            'id_transportasi' => 'required',
        ]);

        // Loop semua id_destinasi yang dipilih
        foreach ($request->id_destinasi as $id_destinasi) {
            // Simpan satu per satu ke tabel detail_pakets
            DetailPaket::create([
                'id_paket' => $request->id_paket,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'id_destinasi' => $id_destinasi,
                'id_transportasi' => $request->id_transportasi,
            ]);
        }

        // Setelah semua data disimpan, arahkan ke halaman index
        return redirect()->route('detail_pakets.index')->with('message', 'Data detail paket berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailPaket $detail_paket)

    {
        return view('detail_pakets.show', compact('detail_paket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailPaket $detail_paket)
    {
        $pakets = Paket::all();
        $destinasis = Destinasi::all();
        $transportasis = Transportasi::all();
        return view('detail_pakets.edit', compact('pakets', 'destinasis', 'transportasis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailPaket $detailPaket)
    {
        $request->validate([
            'id_paket' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'id_destinasi' => 'id_destinasi',
            'id_transportasi' => 'required',
        ]);

        $detailPaket->update($request->all());
        return redirect()->route('detail_pakets.index')->with('message', 'update data detail_paket berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailPaket $detailPaket)
    {
        $detailPaket->delete();
        return redirect()->route('detail_pakets.index')->with('message', 'delete data detail paket berhasil');
    }
}
