<?php
namespace App\Models\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'key',
        'scopes',
        'status',
        'last_used',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopes()
    {
        return $this->belongsToMany(ApiScope::class);
    }
    
    public function limit()
    {
        return $this->hasOne(ApiLimit::class, 'user_id', 'user_id');
    }

}
