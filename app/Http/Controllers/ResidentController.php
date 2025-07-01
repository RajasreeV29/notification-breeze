<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;

use App\Models\Resident;
use Illuminate\Http\Request;
use App\Models\Package; 
use App\Notifications\PackageAsign;
use App\Models\User;
use App\Http\Requests\ResidentEditPackage;
use App\Http\Requests\EditResident;
use Carbon\Carbon;
use App\Notifications\PackageExpiryNotification;
use App\Jobs\SendPackageExpiryNotification;
use App\Mail\PackageExpiry;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Facades\LoggerFacade;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (Cache::has('cachekey')) {
        // $residents = Cache::get('cachekey');
        // }
        // else{
        // $residents = Resident::with('package')->get();
        // Cache::put('cachekey',$residents);

        // }
        // dd($value);
        LoggerFacade::log('User visited index page');
        $residents = Resident::with('package')->get();
        // SendPackageExpiryNotification::dispatch($residents);
       return view('resident.residentView', compact('residents'));

        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $packages = Package::all();
        return view('resident.residentAdd',compact('packages'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
{ 
 $validated = $request->validate([
        'res_name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'gender' => 'required',
        'status' => 'required',
        'package_id' => 'required'

    ]);
    $resident = Resident::create($validated);
    
    $package = Package::find($resident->package_id);
  

    $users = \App\Models\User::all();
    foreach ($users as $user) {
        $user->notify(new PackageAsign($package));
    }
    // Cache::forget('cachekey');
 

    return redirect()->route('resident.index')->with('success', 'updated');
}

    /**
     * Display the specified resource.
     */
    public function show(Resident $resident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $packages = Package::all();
        $resident = Resident::findOrFail($id);
        
        return view('resident.residentEdit',compact('resident','packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditResident $request, string $id)
    {
         Resident::findOrFail($id)->update($request->validated());
        return redirect()->route('resident.index')->with('success','updated');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $resident = Resident::findOrFail($id);
        $resident->delete();
        return redirect()->route('resident.index')->with('success','deleted!');
    }
}
