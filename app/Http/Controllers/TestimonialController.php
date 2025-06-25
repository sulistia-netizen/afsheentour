<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:testimonial-list|testimonial-create|testimonial-edit|testimonial-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:testimonial-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:testimonial-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:testimonial-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $ulasans = Ulasan::with('user', 'paket')->latest()->get();
        $pakets = Paket::all();

        return view('testimonial.index', compact('ulasans', 'pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paket' => 'required|exists:pakets,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000',
        ]);

        Ulasan::create([
            'id_user' => Auth::id(),
            'id_paket' => $request->id_paket,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('testimonial.index')->with('success', 'Terima kasih atas ulasannya!');
    }
}
