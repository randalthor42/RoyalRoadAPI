<?php
namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class ApiKeyUsageLog extends Model
{
    protected $fillable = [
        'api_key_id',
        'endpoint',
        'timestamp',
    ];

    public function apiKey()
    {
        return $this->belongsTo(ApiKey::class);
    }
}
