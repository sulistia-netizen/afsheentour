<?php

namespace App\Http\Controllers;

use App\Models\kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:kunjungan-list|kunjungan-create|kunjungan-edit|kunjungan-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:kunjungan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kunjungan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kunjungan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(kunjungan $kunjungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kunjungan $kunjungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kunjungan $kunjungan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kunjungan $kunjungan)
    {
        //
    }
}
