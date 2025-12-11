<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Sale extends Model {

    use SoftDeletes,
        Auditable;

    public $table = 'sales';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'reference',
        'patient_id',
        'montant',
        'montant_encaisse',
        'user_id',
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

    public function saleDetails() {
        return $this->hasMany(SaleDetail::class, 'sale_id', 'id');
    }

    public function details() {
        return $this->hasMany(SaleDetail::class, 'sale_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    
    public function getFactureTypeAttribute(){
        return 'cruds.sale.title';
    }

}
