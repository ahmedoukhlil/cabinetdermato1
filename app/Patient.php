<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Patient extends Model {

    use SoftDeletes;

    public $table = 'patients';
    protected $dates = [
        'birth_day',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'genre_id',
        'name',
        'phone',
        'phone_2',
        'birth_day',
        'email',
        'poids',
        'solde',
        'ca',
        'albinos',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function setAlbinosAttribute($value) {
        $this->attributes['albinos'] = isset($value) ? $value : 0;
    }

    public function getFullNameAttribute() {
        return $this->name . ' ' . $this->phone . ' ' . $this->phone_2;
    }

    public function getContactAttribute() {
        return $this->phone . ' ' . $this->phone_2;
    }

    public function patientOrdonnances() {
        return $this->hasMany(Ordonnance::class, 'patient_id', 'id');
    }

    public function patientConsultations() {
        return $this->hasMany(Consultation::class, 'patient_id', 'id');
    }

    public function patientAnalysis() {
        return $this->hasMany(Analysi::class, 'patient_id', 'id');
    }

    public function patientAppointments() {
        return $this->hasMany(Appointment::class, 'patient_id', 'id');
    }

    public function factures() {
        return $this->hasMany(Facture::class, 'patient_id', 'id');
    }

    public function sales() {
        return $this->hasMany(Sale::class, 'patient_id', 'id');
    }

    public function notes() {
        return $this->hasMany(Note::class, 'patient_id', 'id');
    }

    public function facturesDues() {
        return $this->hasMany(Facture::class, 'patient_id', 'id')->whereColumn('montant', '!=', 'montant_encaisse');
    }

    public function genre() {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function getBirthDayAttribute($value) {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthDayAttribute($value) {
        $this->attributes['birth_day'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

}
