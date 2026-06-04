<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universities =  University::with(['images', 'programs'])->latest()->paginate(20);
        return view('universities.index', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', University::class);
        $countries = Country::all();

        return view('universities.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUniversityRequest $request)
    {
        $this->authorize('create', University::class);
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('universities', 'public');
        }

        University::create($validated);

        return redirect()->route('universities.index')->with('success', 'University ' . $validated['name'] . ' Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        return view('universities.show', compact('university'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        $this->authorize('update', $university);
        $countries = Country::all();

        return view('universities.edit', compact('university', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUniversityRequest $request, University $university)
    {
        $this->authorize('update', $university);
        $validated = $request->validated();

        
        // handle update
        if (($request->hasFile('logo'))) {
            if ($university->logo) {
                Storage::disk('public')->delete($university->logo);
            }
            $validated['logo'] = $request->file('logo')->store('universities', 'public');
        }

        // handle logo removal
        if ($request->has('remove_logo')) {
            Storage::disk('public')->delete($university->logo);
            $university->logo = null;
        }

        $university->update($validated);

        return redirect()->route('universities.index')->with('warning', 'University ' . $university->name . ' Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        $this->authorize('delete', $university);

        if ($university->logo) {
            Storage::disk('public')->delete($university->logo);
        }

        $university->delete();

        return redirect()->route('universities.index')->with('danger', 'University ' . $university->name . ' Deleted Successfully');
    }
}
