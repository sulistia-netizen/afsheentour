<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PenggunaController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:pengguna-list|pengguna-create|pengguna-edit|pengguna-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:pengguna-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pengguna-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pengguna-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data = User::with('pengguna')->get();

        // foreach ($data as $user) {
        //     dd($user->getRoleNames()->implode(', '));
        // }

        if ($request->ajax()) {

            $data = User::with('pengguna');
            // dd($data);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $viewBtn = '<a href="' . route('penggunas.show', $row->id) . '" class="btn btn-primary btn-sm">View</a>';
                    $editBtn = '<a href="' . route('penggunas.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>';

                    // Form untuk delete
                    $deleteBtn = '<form action="' . route('penggunas.destroy', $row->id) . '" method="POST" style="display:inline;">
                                        ' . csrf_field() . '
                                        ' . method_field('DELETE') . '
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                      </form>';

                    return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                })
                ->addColumn('roles', function ($row) {
                    return $row->getRoleNames()->implode(', ');
                })
                ->addColumn('nama', function ($row) {
                    return $row->pengguna->nama;
                })
                ->addColumn('jenis_kelamin', function ($row) {
                    return $row->pengguna->jenis_kelamin;
                })
                ->addColumn('nomor_hp', function ($row) {
                    return $row->pengguna->nomor_hp;
                })
                ->addColumn('alamat_email', function ($row) {
                    return $row->pengguna->alamat_email;
                })
                ->rawColumns(['action', 'roles'])
                ->make(true);
        }

        // dd($data);
        return view('penggunas.index',);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('penggunas.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nomor_hp' => 'required',
            'alamat_email' => 'required',
            'password' => 'required|same:confirm-password',

        ]);

        $input = $request->all();
        // $input['password'] = Hash::make($input['password']);

        $pengguna = Pengguna::create([
            'nama' => $input['nama'],
            'jenis_kelamin' => $input['jenis_kelamin'],
            'nomor_hp' => $input['nomor_hp'],
            'alamat_email' => $input['alamat_email'],

        ]);

        // dd($pengguna);

        $user = User::create([
            'pengguna_id' => $pengguna->id,
            'name' => $pengguna->nama,
            'email' => $pengguna->alamat_email,
            'password' => Hash::make($input['password'])
        ]);

        $user->assignRole($request->input('roles'));

        return redirect()->route('penggunas.index')->with('message', 'buat data pengguna berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::with('pengguna')->findOrFail($id);
        return view('penggunas.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengguna $pengguna)
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('penggunas.edit', compact('pengguna', compact('roles')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengguna $pengguna)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nomor_hp' => 'required',
            'alamat_email' => 'required',
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $pengguna->update($input);
        $pengguna->assignRole($request->input('roles'));

        return redirect()->route('penggunas.index')->with('message', 'update data pengguna berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $pengguna = $user->pengguna; 
        
        $user->delete();
        $pengguna->delete();

        return redirect()->route('penggunas.index')->with('message', 'delete data pengguna berhasil');
    }
}
