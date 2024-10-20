<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyTarget extends Model
{
    use HasFactory;
    protected $table = 'surveytarget'; // This must match your migration table name


    protected $fillable = [
        'survey_id',
        'name',
        'age',
        'gender',
        'education_level',
        'city',
        'country',
        'region',
        'telecom1',
        'telecom2',
        'mobile_money1',
        'mobile_money2',
        'nationality1',
        'bank1',
        'bank2',
        'employment_status',
        'salary_range'
    ];
}
