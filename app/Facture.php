<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Facture extends Model {

    use SoftDeletes,
        Auditable;

    public $table = 'factures';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'reference',
        'montant',
        'montant_encaisse',
        'status_id',
        'patient_id',
        'comment',
        'factureable_type',
        'factureable_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function facturePaiements() {
        return $this->hasMany(PaiementDetail::class, 'facture_id', 'id');
    }

    public function status() {
        return $this->belongsTo(FactureStatus::class, 'status_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function factureable() {
        return $this->morphTo();
    }

}
