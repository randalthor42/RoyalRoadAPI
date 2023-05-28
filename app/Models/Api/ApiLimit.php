<?php
namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class ApiLimit extends Model
{
    protected $fillable = [
        'user_id',
        'rate_limit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
