<?php

namespace App\Models;

use App\Constants\Lead\SourceConstants;
use App\Constants\Lead\StatusConstants;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'client_name',
        'lead_source',
        'lead_date',
        'job_title',
        'description',
        'status',
        'priority',
        'email'
    ];
    protected $appends = ['lead_source_type','status_type'];



    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    protected function leadDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->toDateString(),
        );
    }

    public function getLeadSourceTypeAttribute()
    {
        return SourceConstants::getSourceType($this->attributes['lead_source']);
    }

    public function getStatusTypeAttribute()
    {
        return StatusConstants::getStatusType($this->attributes['status']);
    }
}