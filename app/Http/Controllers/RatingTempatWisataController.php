<?php

namespace App\Http\Controllers;

use App\Models\rating_tempat_wisata;
use Illuminate\Http\Request;

class RatingTempatWisataController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:rating-tempat-wisata-delete-list|rating-tempat-wisata-delete-create|rating-tempat-wisata-delete-edit|rating-tempat-wisata-delete-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:rating-tempat-wisata-delete-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rating-tempat-wisata-delete-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rating-tempat-wisata-delete-delete', ['only' => ['destroy']]);
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
    public function show(rating_tempat_wisata $rating_tempat_wisata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rating_tempat_wisata $rating_tempat_wisata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rating_tempat_wisata $rating_tempat_wisata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rating_tempat_wisata $rating_tempat_wisata)
    {
        //
    }
}
