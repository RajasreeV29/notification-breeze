<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Package; 
use Carbon\Carbon;
use App\Notifications\PackageExpiryNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckPackageExpiry
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            try {
                $tomorrow = Carbon::tomorrow();
                
                $expiringPackages = Package::whereDate('expiry_date', $tomorrow)
                    ->whereHas('resident')  // Only get packages with residents
                    ->where('status', 'active')  // Only check active packages
                    ->whereNull('notification_sent')  // Simplified notification check
                    ->with('resident')
                    ->get();

                foreach($expiringPackages as $package) {
                    $package->resident->notify(new PackageExpiryNotification($package));
                    $package->update(['notification_sent' => true]);
                }
            } catch (\Exception $e) {
                Log::error('Package expiry notification failed: ' . $e->getMessage());
            }
        }

        return $next($request);
    }
}