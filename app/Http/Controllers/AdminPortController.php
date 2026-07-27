<?php

namespace App\Http\Controllers;

use App\Models\Port;
use Illuminate\Http\Request;

class AdminPortController extends Controller
{
    /**
     * Menampilkan semua data pelabuhan
     */
    public function index()
    {
        $ports = Port::orderBy('id', 'desc')->paginate(10);

        return view('admin.ports.index', compact('ports'));
    }

    /**
     * Menampilkan form tambah pelabuhan
     */
    public function create()
    {
        return view('admin.ports.create');
    }

    /**
     * Menyimpan data pelabuhan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'port_name'      => 'required|string|max:255',
            'alternate_name' => 'nullable|string|max:255',
            'country_code'   => 'required|string|max:100',
            'region'         => 'nullable|string|max:255',
            'water_body'     => 'nullable|string|max:255',
            'latitude'       => 'required|numeric',
            'longitude'      => 'required|numeric',
            'harbor_type'    => 'nullable|string|max:255',
            'harbor_size'    => 'nullable|string|max:255',
            'harbor_use'     => 'nullable|string|max:255',
        ]);

        Port::create($validated);

        return redirect()
            ->route('admin.ports.index')
            ->with('success', 'Data pelabuhan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit pelabuhan
     */
    public function edit(Port $port)
    {
        return view('admin.ports.edit', compact('port'));
    }

    /**
     * Mengupdate data pelabuhan
     */
    public function update(Request $request, Port $port)
    {
        $validated = $request->validate([
            'port_name'      => 'required|string|max:255',
            'alternate_name' => 'nullable|string|max:255',
            'country_code'   => 'required|string|max:100',
            'region'         => 'nullable|string|max:255',
            'water_body'     => 'nullable|string|max:255',
            'latitude'       => 'required|numeric',
            'longitude'      => 'required|numeric',
            'harbor_type'    => 'nullable|string|max:255',
            'harbor_size'    => 'nullable|string|max:255',
            'harbor_use'     => 'nullable|string|max:255',
        ]);

        $port->update($validated);

        return redirect()
            ->route('admin.ports.index')
            ->with('success', 'Data pelabuhan berhasil diperbarui.');
    }

    /**
     * Menghapus data pelabuhan
     */
    public function destroy(Port $port)
    {
        $port->delete();

        return redirect()
            ->route('admin.ports.index')
            ->with('success', 'Data pelabuhan berhasil dihapus.');
    }
}