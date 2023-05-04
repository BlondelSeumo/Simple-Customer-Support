<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CannedResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
    ];
    
    protected $casts = [
        'shortcuts' => 'array',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
