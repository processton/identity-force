<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
