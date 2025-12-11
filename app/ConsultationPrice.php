<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ConsultationPrice extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'consultation_prices';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type_id',
        'medecin_id',
        'tarif',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function type()
    {
        return $this->belongsTo(TypeConsultation::class, 'type_id');
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
