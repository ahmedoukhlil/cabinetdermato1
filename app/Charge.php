<?php

namespace App;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model
{
    use SoftDeletes;

    public $table = 'charges';

    protected $dates = [
        'dt_charge',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'amount',
        'dt_charge',
        'description',
        'motif_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDtChargeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDtChargeAttribute($value)
    {
        $this->attributes['dt_charge'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function motif()
    {
        return $this->belongsTo(MotifCharge::class, 'motif_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
