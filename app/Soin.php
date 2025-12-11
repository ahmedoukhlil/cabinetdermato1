<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Soin extends Model {

    use SoftDeletes,
        Auditable;

    public $table = 'soins';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'reference',
        'montant',
        'user_id',
        'patient_id',
        'medecin_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $appends  = [
        'facture_type'
    ];

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function details() {
        return $this->hasMany(SoinDetail::class, 'soin_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function medecin() {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }

    
    public function getFactureTypeAttribute(){
        return 'cruds.soin.title';
    }

}
