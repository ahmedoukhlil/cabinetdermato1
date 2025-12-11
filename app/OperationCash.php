<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class OperationCash extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'operation_cashes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'caisse_id',
        'medecin_id',
        'montant',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function caisse()
    {
        return $this->belongsTo(CashRegister::class, 'caisse_id');
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
