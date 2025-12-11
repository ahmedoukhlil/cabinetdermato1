<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Medecin extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'medecins';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'grade_id',
        'specialite_id',
        'name',
        'phone',
        'phone_2',
        'solde_soins',
        'email',
        'free_days',
        'daily_consultation',
        'daily_rdv',
        'consultation_duration',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    public function getFullNameAttribute() {
        return $this->name;
    }
    
    public function getContactAttribute() {
        return $this->phone . ' ' . $this->phone_2;
    }

    public function medecinConsultationPrices()
    {
        return $this->hasMany(ConsultationPrice::class, 'medecin_id', 'id');
    }

    public function medecinOrdonnances()
    {
        return $this->hasMany(Ordonnance::class, 'medecin_id', 'id');
    }

    public function medecinConsultations()
    {
        return $this->hasMany(Consultation::class, 'medecin_id', 'id');
    }

    public function medecinAnalysis()
    {
        return $this->hasMany(Analysi::class, 'medecin_id', 'id');
    }

    public function medecinOperationCashes()
    {
        return $this->hasMany(OperationCash::class, 'medecin_id', 'id');
    }

    public function medecinAppointments()
    {
        return $this->hasMany(Appointment::class, 'medecin_id', 'id');
    }

    public function soins()
    {
        return $this->hasMany(Soin::class, 'medecin_id', 'id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function specialite()
    {
        return $this->belongsTo(Specilalte::class, 'specialite_id');
    }
}
