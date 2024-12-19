<?php

use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@processton.com',
            'password' => bcrypt('password'),
        ]);

        $team = Team::create([
            'name' => 'Admin',
        ]);

        UserTeam::create([
            'user_id' => $user->id,
            'team_id' => $team->id,
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
