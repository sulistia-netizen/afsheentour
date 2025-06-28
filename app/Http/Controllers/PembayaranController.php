<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Booking;
use App\Models\DetailPaket;
use App\Models\Paket;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PembayaranController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:pembayaran-list|pembayaran-create|pembayaran-edit|pembayaran-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:pembayaran-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pembayaran-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pembayaran-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Pembayaran::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $viewBtn = $editBtn = $deleteBtn = '';

                if (Auth::user() && Auth::user()->can('pembayaran-list')) {
                    $viewBtn = '<a href="' . route('pembayarans.show', $row->id) . '" class="btn btn-primary btn-sm">View</a>';
                }

                if (Auth::user() && Auth::user()->can('pembayaran-list')) {
                    $editBtn = '<a href="' . route('pembayarans.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                }

                if (Auth::user() && Auth::user()->can('pembayaran-list')) {
                    // Form untuk delete
                    $deleteBtn = '<form action="' . route('pembayarans.destroy', $row->id) . '" method="POST" style="display:inline;">
                                        ' . csrf_field() . '
                                        ' . method_field('DELETE') . '
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                      </form>';
                }
                
                    return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                })->addColumn('user', function ($row) {
                    return $row->booking->user->name ?? 'NULL';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pembayarans.index',);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookings = Booking::all();
        $pakets = Paket::all();
        return view('pembayarans.create', compact('bookings', 'pakets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_booking' => 'required',
            'metode_pembayaran' => 'required',
            'nilai' => 'required',
        ]);

        $paket = Pembayaran::create($request->all());

        return redirect()->route('pembayarans.index')->with('message', 'buat data pembayaran berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        return view('pembayarans.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        $bookings = Booking::all();
        return view('pembayarans.edit', compact('pembayaran', 'bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'id_booking' => 'required',
            'metode_pembayaran' => 'required',
            'nilai' => 'required',
        ]);

        $pembayaran->update($request->all());
        return redirect()->route('pembayarans.index')->with('message', 'update data pembayaran berhasil');
    }

    public function upload(Request $request)
    {

        $request->validate([
            'id_booking' => 'required',
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Upload file
        $file = $request->file('bukti_pembayaran');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('bukti_pembayaran', $fileName, 'public');

        // Ambil harga dari paket terkait booking
        $booking = Booking::with('paket')->findOrFail($request->id_booking);
        $harga = $booking->paket->harga ?? 0;

        // Simpan ke database
        Pembayaran::create([
            'id_booking' => $request->id_booking,
            'metode_pembayaran' => $request->metode_pembayaran, // bisa diubah sesuai kebutuhan
            'nilai' => $harga, // otomatis ambil harga paket
            'bukti_pembayaran' => $filePath,
            'status' => 'menunggu', // misal status default
        ]);

        return view('pembayarans.sukses');

        // return redirect()->back()->with('success', 'Bukti pembayaran berhasil dikirim!');
    }

    public function transfer(Request $request)
    {
        $id = $request->id_paket;
        $nama = $request->nama;
        $jenis_kelamin = $request->jenis_kelamin;
        $nomor_hp = $request->nomor_hp;
        $alamat_email = $request->alamat_email;
        // dd($request->all());
        $pengguna = Pengguna::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nomor_hp' => $request->nomor_hp,
            'alamat_email' => $request->alamat_email,

        ]);

        $paket = Paket::find($id);
        //dd($paket);

        $destinasiList = DetailPaket::where('id_paket', '=', $id)->with(['destinasi', 'paket'])->get();
        $booking = Booking::create([
            'id_user' => $pengguna->id,
            'id_paket' => $id,
            'jumlah_orang' => $paket->jumlah_orang,
            'jumlah_biaya' => $paket->harga,
            'status' => 'pending',
            'tanggal_mulai' => $paket->tanggal_mulai ?? now(),
            'tanggal_selesai' => $paket->tanggal_selesai,

        ]);
        // dd($paket);
        // return response()->json($destinasiList);
        // $pembayaran = Pembayaran::findOrFail($id); // ← sudah benar sekarang
        return view('pembayarans.transfer', compact('destinasiList', 'booking', 'paket'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayarans.index')->with('message', 'delete data pembayaran berhasil');
    }
}
