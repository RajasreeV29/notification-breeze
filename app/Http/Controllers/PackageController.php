<?php

namespace App\Http\Controllers;
use App\Http\Requests\PackageRequest;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view(('package.packageCreate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     return view('package.packageCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $request)
    {
    $data = $request->validated();
    if ($request->hasFile('file_path'))
    {
        $data['file_path'] = $request->file('file_path')->store('package','public');
        // dd($data['file_path']);
    }
    // dd($data);
    Package::create($data);
    
    // $path = Storage::putFile('public', $request->file('file_path'));

    return redirect()->route('package.index')
        ->with('success', 'Package created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        //
    }
}
