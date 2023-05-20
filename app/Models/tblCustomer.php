<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class tblCustomer extends Model
{
    use HasFactory, Notifiable,LogsActivity;

    protected $table="tbl_customers";

    protected static $logAttributes = [ 'firstName','lastName','email'];

    protected static $ignoreChangedAttributes = ['password','updates_at'];

    protected static $recordEvents = ['Created' ,'Updated'];

    protected static $logOnDirty = true;

    protected static $logName = 'customer';


    public function getDescriptionForEvent(string $eventName):string
    {
        return "You have {$eventName} Customer";
    }

    protected $primaryKey = 'custId';


    protected $fillable = [

        'code',
        'title',
        'firstName',
        'lastName',
        'email',
        'password',
        'dateOfBirth',
        'mobileNum',
        'billingAdd1',
        'billingAdd2',
        'billingCity',
        'billingPostcode',
        'billingCountry',
        'imagePath',
        'cusIP',
        'lastVisit',
        'isActive',
        'isBlocked',
        'shippingAdd1',
        'shippingAdd2',
        'shippingCity',
        'shippingPostcode',
        'shippingCountry',
        'coverImagePath'
      
    ];
}
