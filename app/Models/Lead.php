<?php

namespace App\Models;

use App\Enums\SourcesEnum;
use App\Enums\StatusesEnum;
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

    const SOURCE1 = 0;
    const SOURCE2 = 1;
    const SOURCE3 = 2;
    const SOURCE4 = 3;


    const STATUS_NEW = 0;
    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;


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

    public function getLeadSourcesAttribute(): array
    {
        return array_combine(
            array_column(SourcesEnum::cases(), 'value'),
            array_column(SourcesEnum::cases(), 'name')
        );
    }

    public function getStatusesAttribute()
    {
        return array_combine(
            array_column(SourcesEnum::cases(), 'value'),
            array_column(SourcesEnum::cases(), 'name')
        );
    }
}
