<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::with(['universities'])->latest()->get();

        return view('countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Country::class);
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Country::class);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('countries', 'name')],
            'iso_code' => ['required', 'string', 'max:10'],
            'flag' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2040'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('flag')) {
            $validated['flag'] = $request->file('flag')->store('countries', 'public');
        }

        Country::create($validated);

        return redirect()->route('countries.index')->with('success', 'Country Created Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $this->authorize('update', $country);
        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $this->authorize('update', $country);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('countries', 'name')->ignore($country->id)],
            'iso_code' => ['required', 'string', 'max:10'],
            'flag' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2040'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('flag')) {
            if ($country->flag) {
                Storage::disk('public')->delete($country->flag);
            }
            
            $validated['flag'] = $request->file('flag')->store('countries', 'public');
        }

        $country->update($validated);

        return redirect()->route('countries.index')->with('success', 'Country Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $this->authorize('delete', $country);
        if ($country->flag) {
            Storage::disk('public')->delete($country->flag);
        }
        $country->delete();

        return redirect()->route('countries.index')->with('danger', 'Country Deleted Succesfully');
    }
}
