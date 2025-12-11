<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Consultation extends Model {

    use SoftDeletes,
        Auditable;

    public $table = 'consultations';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'appointment_id',
        'patient_id',
        'medecin_id',
        'user_id',
        'motif',
        'hdm',
        'atcd',
        'diagnostic',
        'comment',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function consultationOrdonnances() {
        return $this->hasMany(Ordonnance::class, 'consultation_id', 'id');
    }

    public function consultationAnalysis() {
        return $this->hasMany(Analysi::class, 'consultation_id', 'id');
    }

    public function rdv() {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function medecin() {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status() {
        return $this->belongsTo(ConsultationStatus::class, 'status_id');
    }

}
