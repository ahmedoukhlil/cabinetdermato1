<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class PaiementDetail extends Model {

    use SoftDeletes,
        Auditable;

    public $table = 'paiement_details';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'montant',
        'paiement_id',
        'facture_id',
        'caisse_id',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function facture() {
        return $this->belongsTo(Facture::class, 'facture_id');
    }

    public function paiement() {
        return $this->belongsTo(Paiement::class, 'paiement_id');
    }

    public function caisse() {
        return $this->belongsTo(CashRegister::class, 'caisse_id');
    }

    public function status() {
        return $this->belongsTo(PaiementStatus::class, 'status_id');
    }

}
