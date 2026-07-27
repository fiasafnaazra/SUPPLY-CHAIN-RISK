<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class AdminCountryController extends Controller
{
    /**
     * Menampilkan daftar negara
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $countries = Country::when($keyword, function ($query) use ($keyword) {
                $query->where('country_name', 'like', "%{$keyword}%")
                      ->orWhere('country_code', 'like', "%{$keyword}%")
                      ->orWhere('capital', 'like', "%{$keyword}%")
                      ->orWhere('continent', 'like', "%{$keyword}%");
            })
            ->orderBy('country_name', 'ASC')
            ->paginate(10);

        return view('admin.countries.index', compact('countries'));
    }

    /**
     * Form tambah negara
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Simpan negara baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_name' => 'required|max:255',
            'country_code' => 'required|max:10|unique:countries,country_code',
            'capital'      => 'nullable|max:255',
            'continent'    => 'nullable|max:255',
            'population'   => 'nullable|numeric',
            'latitude'     => 'nullable|numeric',
            'longitude'    => 'nullable|numeric',
            'currency'     => 'nullable|max:100',
            'flag'         => 'nullable',
        ]);

        Country::create([
            'country_name' => $request->country_name,
            'country_code' => $request->country_code,
            'capital'      => $request->capital,
            'continent'    => $request->continent,
            'population'   => $request->population,
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'currency'     => $request->currency,
            'flag'         => $request->flag,
        ]);

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Data negara berhasil ditambahkan.');
    }

    /**
     * Detail negara
     */
    public function show($id)
    {
        $country = Country::findOrFail($id);

        return view('admin.countries.show', compact('country'));
    }

    /**
     * Form edit negara
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);

        return view('admin.countries.edit', compact('country'));
    }

    /**
     * Update negara
     */
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $request->validate([
            'country_name' => 'required|max:255',
            'country_code' => 'required|max:10|unique:countries,country_code,' . $country->id,
            'capital'      => 'nullable|max:255',
            'continent'    => 'nullable|max:255',
            'population'   => 'nullable|numeric',
            'latitude'     => 'nullable|numeric',
            'longitude'    => 'nullable|numeric',
            'currency'     => 'nullable|max:100',
            'flag'         => 'nullable',
        ]);

        $country->update([
            'country_name' => $request->country_name,
            'country_code' => $request->country_code,
            'capital'      => $request->capital,
            'continent'    => $request->continent,
            'population'   => $request->population,
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'currency'     => $request->currency,
            'flag'         => $request->flag,
        ]);

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Data negara berhasil diperbarui.');
    }

    /**
     * Hapus negara
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);

        $country->delete();

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Data negara berhasil dihapus.');
    }
}