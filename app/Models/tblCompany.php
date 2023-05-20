<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class tblCompany extends Model
{
    use HasFactory, Notifiable,LogsActivity;

    protected $table="tbl_companies";

    protected static $logAttributes = [ 'nameOf'];

    protected static $ignoreChangedAttributes = ['password','updates_at'];

    protected static $recordEvents = ['Created' ,'Updated'];

    protected static $logOnDirty = true;

    protected static $logName = 'company';


    public function getDescriptionForEvent(string $eventName):string
    {
        return "You have {$eventName} Company";
    }

    protected $primaryKey = 'custId';

    protected $fillable = [

        'code',
        'nameOf',
        'logo',
        'add1',
        'add2',
        'city',
        'state',
        'zipcode',
        'message',
        'tel1',
        'tel2',
        'tel3',
        'isActive',
        'email'
    ];
}
