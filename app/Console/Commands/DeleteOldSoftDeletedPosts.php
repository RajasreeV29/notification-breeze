<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DeleteOldSoftDeletedPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-soft-deleted-posts';
   
    

    /**
     * The console command description.
     *
     * @var string
     */
 

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $thresholdDate = Carbon::now()->subDays(3);
    //    Log::info($thresholdDate);
        Post::whereNull('deleted_at') // Only active (not soft-deleted) posts
        ->where('created_at', '<', $thresholdDate)
        ->each(function ($post) {
            $post->delete(); // Soft delete
        });

       Log::info('Delete command ran at ' . now());

    }
}
