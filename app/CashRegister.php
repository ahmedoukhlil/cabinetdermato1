<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class CashRegister extends Model
{
    use SoftDeletes,
        Auditable;

    public $table = 'cash_registers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'solde',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function caisseSoins()
    {
        return $this->hasMany(TypeSoin::class, 'caisse_id', 'id');
    }

    public function caisseOperationCashes()
    {
        return $this->hasMany(OperationCash::class, 'caisse_id', 'id');
    }
}
