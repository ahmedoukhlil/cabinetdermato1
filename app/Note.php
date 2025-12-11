<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Note extends Model {

    use SoftDeletes,
        Auditable;

    public $table = 'notes';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'medecin_id',
        'patient_id',
        'objet',
        'content',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function medecin() {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }

    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

}
