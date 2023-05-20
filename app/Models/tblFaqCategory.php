<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tblFaq;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;


class tblFaqCategory extends Model
{
    use HasFactory, Notifiable,LogsActivity;


    protected static $logAttributes = ['nameOf'];

    protected static $ignoreChangedAttributes = ['password','updates_at'];

    protected static $recordEvents = ['Created' ,'Updated'];

    protected static $logOnDirty = true;

    protected static $logName = 'FaqCategory';

    

    public function getDescriptionForEvent(string $eventName):string
    {
        return "You have {$eventName} Faq Category";
    }
    protected $table="tbl_faq_categories";

    protected $primaryKey = 'custId';

    protected $fillable = [

        'code',
        'nameOf',
        'isActive'
    ];

    public function tbl_faqs()
    {
        return $this->belongsTo(tblFaq::class,  'faqcategory_id');
    }
}
