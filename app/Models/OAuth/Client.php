<?php

namespace App\Models\OAuth;

use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    public function connectedApp()
    {
        return $this->belongsTo(\App\Models\ConnectedApp::class);
    }
}
