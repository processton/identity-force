<?php

namespace App\Models;

use App\Observers\TeamObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([TeamObserver::class])]
class Team extends Model
{
    /**
     * Custom attributes appends
     *
     * @var list<string>
     */

    protected $appends = [ 'profile_picture_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name'
    ];

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
     * Team members
     *
     * return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */

    public function members(){
        return $this->hasManyThrough(User::class, UserTeam::class, 'team_id', 'id', 'id', 'user_id');
    }


}
