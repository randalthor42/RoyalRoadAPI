<?php

namespace Database\Seeders;

use App\Models\Api\ApiScope;
use Illuminate\Database\Seeder;

class ApiScopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scopeData = [
            [
                'name' => 'read:fictions',
                'allowed_endpoints' => ['/api/{website}/fiction/{fiction}', '/api/{website}/fiction/{fiction}/chapters', '/api/{website}/fiction/{fiction}/chapters/{chapter}'],
                'allowed_websites' => ['royalroad'],
            ],
        ];

        foreach ($scopeData as $scope) {
            ApiScope::create($scope);
        }
    }
}
