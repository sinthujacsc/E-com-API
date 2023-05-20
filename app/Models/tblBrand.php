<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tblProduct;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class tblBrand extends Model
{
    use HasFactory, Notifiable,LogsActivity;

    protected $table="tbl_brands";

    protected static $logAttributes = ['nameOf'];

    protected static $ignoreChangedAttributes = ['password','updates_at'];

    protected static $recordEvents = ['Created' ,'Updated'];

    protected static $logOnDirty = true;

    protected static $logName = 'brand';


    public function getDescriptionForEvent(string $eventName):string
    {
        return "You have {$eventName} Brand";
    }

    protected $primaryKey = 'custId';


    protected $fillable = [

        'code',
        'nameOf',
        'isActive'
    ];

    public function tbl_products()
    {
        return $this->belongsTo(tblProduct::class,  'brand_id');
    }
    
}
