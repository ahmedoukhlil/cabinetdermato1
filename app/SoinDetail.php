<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class SoinDetail extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'soin_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'soin_id',
        'type_id',
        'quantity',
        'prix_unitaire',
        'montant',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function soin()
    {
        return $this->belongsTo(Soin::class, 'soin_id');
    }

    public function type()
    {
        return $this->belongsTo(TypeSoin::class, 'type_id');
    }
}
