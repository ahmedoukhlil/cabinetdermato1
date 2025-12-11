<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Appointment extends Model
{
    use SoftDeletes;

    public $table = 'appointments';

    protected $dates = [
        'appointment_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'patient_id',
        'medecin_id',
        'ordre',
        'visite_id',
        'consultation_id',
        'appointment_time',
        'status_id',
        'gratuite',
        'user_id',
        'comment',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $appends  = [
        'facture_type'
    ];
    

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function rdvConsultations()
    {
        return $this->hasMany(Consultation::class, 'appointment_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }

    public function visite()
    {
        return $this->belongsTo(TypeVisite::class, 'visite_id');
    }

    public function consultation()
    {
        return $this->belongsTo(TypeConsultation::class, 'consultation_id');
    }
    
    public function getFactureTypeAttribute(){
        return 'cruds.appointment.title';
    }

//    public function getAppointmentTimeAttribute($value)
//    {
//        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
//    }

    public function setAppointmentTimeAttribute($value)
    {
        $this->attributes['appointment_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function status()
    {
        return $this->belongsTo(RdvStatus::class, 'status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function factures() {
        return $this->morphMany('App\Facture', 'factureable');
    }
}
