<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tblProduct;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class tblMajorCategory extends Model
{
    
    use HasFactory, Notifiable,LogsActivity;

    protected $table="tbl_major_categories";

    protected static $logAttributes = ['nameOf'];

    protected static $ignoreChangedAttributes = ['password','updates_at'];

    protected static $recordEvents = ['Created' ,'Updated'];

    protected static $logOnDirty = true;

    protected static $logName = 'mainCategory';

     
    // public function tapActivity(Activity $activity, string $eventName)
    // {
    //     $activity->causer_type = "sinthu";
    // }

    public function getDescriptionForEvent(string $eventName):string
    {
        return "You have {$eventName} Main Category";
    }
    
    protected $primaryKey = 'custId';

    protected $fillable = [

        'code',
        'nameOf',
        'imgPath',
        'icon',
        'isActive'
    ];

    public function tbl_products()
    {
        return $this->belongsTo(tblProduct::class,  'mainCategory_id');
    }
}
