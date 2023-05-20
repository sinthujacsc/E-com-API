<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tblProduct;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;



class tblSubCategory extends Model
{
    use HasFactory, Notifiable,LogsActivity;

    protected $table="tbl_sub_categories";

    protected static $logAttributes = ['nameOf'];

    protected static $ignoreChangedAttributes = ['password','updates_at'];

    protected static $recordEvents = ['Created' ,'Updated'];

    protected static $logOnDirty = true;

    protected static $logName = 'subCategory';


    public function getDescriptionForEvent(string $eventName):string
    {
        return "You have {$eventName} Sub Category";
    }

    protected $primaryKey = 'custId';


    protected $fillable = [

        'code',
        'nameOf',
        'imgPath',
        'isActive'
    ];
    public function tbl_products()
    {
        return $this->belongsTo(tblProduct::class,  'subCategory_id');
    }
}
