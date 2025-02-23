<?php

namespace App\Models\OAuth;

use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    public function connectedApp()
    {
        return $this->belongsTo(\App\Models\ConnectedApp::class);
    }


    /**
     * Determine if the client should skip the authorization prompt.
     */
    public function skipsAuthorization(): bool
    {
        return $this->firstParty();
    }
}
