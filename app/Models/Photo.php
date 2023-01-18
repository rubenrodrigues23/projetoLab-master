<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
