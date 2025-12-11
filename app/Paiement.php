<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Paiement extends Model {

    use SoftDeletes,
        Auditable;

    public $table = 'paiements';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'reference',
        'montant',
        'comment',
        'status_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function caisse() {
        return $this->belongsTo(CashRegister::class, 'caisse_id');
    }

    public function status() {
        return $this->belongsTo(PaiementStatus::class, 'status_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details() {
        return $this->hasMany(PaiementDetail::class, 'paiement_id');
    }

}
