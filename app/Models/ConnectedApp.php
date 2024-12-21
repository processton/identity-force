<?php

namespace App\Models;

use App\Models\OAuth\Client;
use Illuminate\Database\Eloquent\Model;

class ConnectedApp extends Model
{
    protected $fillable = ['name', 'type'];


    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function oAuthClients()
    {
        return $this->hasMany(Client::class);
    }
}
