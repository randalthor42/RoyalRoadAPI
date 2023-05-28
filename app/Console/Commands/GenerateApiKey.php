<?php

namespace App\Console\Commands;

use App\Models\Api\ApiKey;
use App\Models\Api\ApiScope;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class GenerateApiKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:generate-key {userId} {rateLimit=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new API key for a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('userId');
        $rateLimit = $this->argument('rateLimit');

        //Generate the API Key
        $apiKey = new ApiKey();
        $apiKey->user_id = $userId;
        $apiKey->key = Str::random(32);
        $apiKey->save();
    
        //Set the scopes
        $scopes = \App\Models\Api\ApiScope::all();
        $scopeIds = $scopes->pluck('id')->all();
        
        $apiKey->scopes()->attach($scopeIds);

        // Set the limit
        $apiLimit = new \App\Models\Api\ApiLimit;
        $apiLimit->user_id = $userId;
        $apiLimit->rate_limit = $rateLimit;
        $apiLimit->save();
            
        $this->info('API Key generated: ' . $apiKey->key);
    }
    
}
