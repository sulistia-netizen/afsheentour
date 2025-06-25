<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HotelController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:hotel-list|hotel-create|hotel-edit|hotel-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:hotel-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:hotel-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:hotel-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Hotel::query();
            // dd($data);

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $viewBtn = '<a href="' . route('hotels.show', $row->id) . '" class="btn btn-primary btn-sm">View</a>';
                        $editBtn = '<a href="' . route('hotels.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>';
    
                        // Form untuk delete
                        $deleteBtn = '<form action="' . route('hotels.destroy', $row->id) . '" method="POST" style="display:inline;">
                                        ' . csrf_field() . '
                                        ' . method_field('DELETE') . '
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                      </form>';
    
                        return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        // dd($data);
        return view('hotels.index',);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_hotel' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
        ]);

        $hotel = Hotel::create($request->all());

        return redirect()->route('hotels.index')->with('message','buat data hotel berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return view('hotels.show',compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        return view('hotels.edit',compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'nama_hotel' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
        ]);

        $hotel->update($request->all());
        return redirect()->route('hotels.index')->with('message','update data hotel berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotels.index')->with('message','delete data hotel berhasil');
    }
}
