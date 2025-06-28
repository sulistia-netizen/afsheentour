<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;
use App\Models\DetailPaket;
use App\Models\User;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class BookingController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:booking-list|booking-create|booking-edit|booking-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:booking-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:booking-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:booking-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function summary($id)
    {
        // $id = 1;
        // $booking = Booking::findOrFail($id);
        // // dd($booking);
        $paket = DetailPaket::where('id_paket', '=', $id)->with('paket')->first();
        // dd($paket);
        return view('detail_pakets.summary', compact('paket'));
        // dd('HALO');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Booking::select('*'); // Pilih kolom yang dibutuhkan

            $data = Booking::with('user', 'paket')->select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $buttons = '<div class="btn-group" role="group" style="flex-wrap: wrap;">';

                    if (Auth::user() && Auth::user()->can('booking-list')) {
                        $buttons .= '<a href="' . route('bookings.show', $row->id) . '" class="btn btn-sm btn-primary me-1 mb-1">View</a>';
                    }

                    if (Auth::user() && Auth::user()->can('booking-edit')) {
                        $buttons .= '<a href="' . route('bookings.edit', $row->id) . '" class="btn btn-sm btn-warning me-1 mb-1">Edit</a>';
                    }

                    if (Auth::user() && Auth::user()->can('booking-delete')) {
                        $buttons .= '<form action="' . route('bookings.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger me-1 mb-1" onclick="return confirm(\'Yakin hapus?\')">Delete</button>
                            </form>';
                    }

                    if (Auth::user() && Auth::user()->can('booking-edit')) {
                        if ($row->status !== 'berhasil') {
                            $buttons .= '<form action="' . route('konfirmasi.booking', $row->id) . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    <button type="submit" class="btn btn-sm btn-success mb-1" onclick="return confirm(\'Konfirmasi pesanan ini?\')">Konfirmasi</button>
                                </form>';
                        }
                    }

                    $buttons .= '</div>';

                    return $buttons;
                })
                ->addColumn('user', function ($row) {
                    return $row->user->name ?? 'Null';
                })
                ->addColumn('paket', function ($row) {
                    return $row->paket->nama ?? 'Null';
                })
                ->editColumn('status', function ($row) {
                    $badgeColor = [
                        'pending' => 'warning',
                        'proses' => 'primary',
                        'berhasil' => 'success',
                        'gagal' => 'danger',
                    ];
                    return '<span class="badge bg-' . ($badgeColor[$row->status] ?? 'secondary') . '">' . ucfirst($row->status) . '</span>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        // ✅ Ini harus ditambahkan agar index() tetap mengembalikan view kalau bukan AJAX
        return view('bookings.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $pakets = Paket::all();
        return view('bookings.create', compact('users', 'pakets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_paket' => 'required',
            'jumlah_orang' => 'required',
            'tanggal_mulai' => 'required',
            'jumlah_biaya' => 'required',
            'status' => 'required',
        ]);
        // dd($request->all());

        $booking = Booking::create($request->all());

        return redirect()->route('bookings.index')->with('message', 'buat data booking berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $users = User::all();
        $pakets = Paket::all();
        return view('bookings.edit', compact('booking', 'users', 'pakets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'id_user' => 'required',
            'id_paket' => 'required',
            'jumlah_orang' => 'required',
            'tanggal_mulai' => 'required',
            'jumlah_biaya' => 'required',
            'status' => 'required',
        ]);

        $booking->update($request->all());
        return redirect()->route('bookings.index')->with('message', 'update data booking berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('message', 'delete data booking berhasil');
    }

    public function confirm($id)
    {
        $booking = Booking::with('user')->findOrFail($id);
        // dd($booking);

        // Kirim email ke user
        if ($booking->user && $booking->user->email) {
            Mail::to($booking->user->email)->send(new BookingConfirmationMail($booking));
        }

        $booking->update([
            'status' => 'berhasil',
        ]);

        return redirect()->route('bookings.index')->with('message', 'Booking berhasil dikonfirmasi!');
    }
}
