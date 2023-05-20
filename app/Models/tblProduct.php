<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tblMajorCategory;
use App\Models\tblSubCategory;
use App\Models\tblScale;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;



class tblProduct extends Model
{
    use HasFactory, Notifiable,LogsActivity;

    protected $table="tbl_products";

    protected static $logAttributes = ['name','email'];

    protected static $ignoreChangedAttributes = ['password','updates_at'];

    protected static $recordEvents = ['Created' ,'Updated'];

    protected static $logOnDirty = true;

    protected static $logName = 'product';


    public function getDescriptionForEvent(string $eventName):string
    {
        return "You have {$eventName} Product";
    }
    protected $primaryKey = 'custId';


    protected $fillable = [

        'code',
        'nameOf',
        'imgPath',
        'isActive',
        'description',
        'price',
        'mainCategory_id',
        'subCategory_id',
        'scale_id',
        'sku',
        'discountRate',
        'discountAmount',
        'vatRate',
        'vatAmount',
        'qty',
        'isNew',
        'brand_id'

        
    ];

    public function tbl_major_categories()
    {
        return $this->hasMany(tblMajorCategory::class, 'custId');
    }
    public function tbl_sub_categories()
    {
        return $this->hasMany(tblSubCategory::class, 'custId');
    }
    public function tbl_scales()
    {
        return $this->hasMany(tblScale::class, 'custId');
    }
    public function tbl_brands()
    {
        return $this->hasMany(tblBrand::class, 'custId');
    }
   
    public function tbl_product_images()
    {
        return $this->hasMany(tblProductImage::class, 'product_id');
    }
}
