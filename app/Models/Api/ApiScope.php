<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiScope extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'allowed_endpoints',
        'allowed_websites',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'allowed_endpoints' => 'array',
        'allowed_websites' => 'array',
    ];

    /**
     * Get the API keys associated with this scope.
     */
    public function keys()
    {
        return $this->belongsToMany(ApiKey::class);
    }
}
