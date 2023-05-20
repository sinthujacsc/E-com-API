<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable,LogsActivity;

    protected $table="users";

    // protected static $logAttributes = ['name','email'];

    // protected static $ignoreChangedAttributes = ['password','updates_at'];

    // protected static $recordEvents = ['created' ,'updated'];

    // protected static $logOnDirty = true;

    // protected static $logName = 'user';


    // public function getDescriptionForEvent(string $eventName):string
    // {
    //     return "You have {$eventName} user";
    // }

    protected $fillable = [
        'name',
        'email',
        'password',
        'isActive',
        'imagePath',
        'code',
        'lastVisit',
        'lastVisit_ip'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}