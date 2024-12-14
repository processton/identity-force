<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Custom attributes appends
     *
     * @var list<string>
     */

    protected $appends = ['is_admin'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    /**
     * add attribute isadmin
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        if(config('config.admin.identification') == 'email'){
            return in_array($this->email, config('config.admin.in'));
        }else{
            foreach($this->teams->pluck('name') as $name){
                if(in_array($name, config('config.admin.in'))){
                    return true;
                }
            }
            return false;
        }

    }

    /**
     * Get teams related to users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function teams()
    {
        return $this->hasManyThrough(Team::class, UserTeam::class, 'user_id', 'id', 'id', 'team_id');
    }

}
