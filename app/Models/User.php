<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\OAuth\Client;
use Carbon\Carbon;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([UserObserver::class])]
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
        'password'
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

    protected $guarded = [];

    /**
     * Custom attributes appends
     *
     * @var list<string>
     */

    protected $appends = ['is_admin', 'profile_picture_url', 'age', 'next_birthday_in', 'joined_since'];

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
     * add attribute profile_picture_url
     *
     * @return string
     */

    public function getProfilePictureUrlAttribute(){
        if($this->profile_picture){
            return tenant_asset($this->profile_picture);
        }else{
            if(!$this->color){
                $this->color = substr(md5(rand()), 0, 6);
                $this->save();
            }
            return 'https://ui-avatars.com/api/?background='.$this->color.'&&size=128&color=fff&name='.urlencode($this->name);
        }
    }

    /**
     * add attribute age
     *
     * @return int
     */
    public function getAgeAttribute(){

        return $this->date_of_birth ? Carbon::parse($this->date_of_birth)->diffForHumans(now()) : '-- years';
    }

    /**
     * add attribute next_birthday_in
     *
     * @return string
     */
    public function getNextBirthdayInAttribute(){
        if($this->date_of_birth){
            $dob = Carbon::parse($this->date_of_birth);
            $dob->year = now()->year;
            if($dob->lt(now())){
                $dob->year = now()->year + 1;
            }
            return $dob->diffForHumans(now());
        }else{
            return '--';
        }
    }




    /**
     * add attribute isadmin
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        $whitelist = config('config.admin.in');

        if(is_string($whitelist)){
            $whitelist = explode(',', $whitelist);
        }

        if(config('config.admin.identification') == 'email'){
            return in_array($this->email, $whitelist);
        }else{
            foreach($this->teams->pluck('name') as $name){

                if(in_array($name, $whitelist)){
                    return true;
                }
            }
            return false;
        }

    }

    /**
     * add attribute joined_since
     *
     * @return string
     */
    public function getJoinedSinceAttribute(){
        return $this->created_at->diffForHumans();
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


    /**
     * Upload Profile picture
     */

    public function uploadProfilePicture($file){
        $path = $file->store('profile-pictures', 'public');
        $this->__set('profile_picture', $path);
        $this->save();
    }


    /**
     * Get the user's connected apps
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function connectedApps(){
        return $this->hasMany(Client::class);
    }

    /**
     * Check if user is allowed for a client
     *
     * @param string $client_id
     * @return bool
     */

    public function isAllowedForClient($client_id){

        $client = Client::findOrFail($client_id);

        $cap = $client->connectedApp;
        
        if(strtolower($cap->type) == 'general'){
            return true;
        }else if(strtolower($cap->type) == 'team'){
            return $this->teams->where('id', $client->team_id)->count() > 0;
        }else if(strtolower($cap->type) == 'personal'){
            return $this->id == $client->user_id;
        }

        return false;
    }

}
