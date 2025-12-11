<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Ordonnance extends Model implements HasMedia {

    use SoftDeletes,
        HasMediaTrait,
        Auditable;

    public $table = 'ordonnances';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'medecin_id',
        'patient_id',
        'reference',
        'ordonnance_comment',
        'consultation_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null) {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function livraison() {
        return $this->hasMany(OrdonnanceLivraison::class, 'ordonnance_id', 'id');
    }

    public function getArticlesNumberAttribute() {
        return $this->hasMany(OrdonnanceLivraison::class, 'ordonnance_id', 'id')->sum('quantity');
    }

    public function ordonnanceOrdonnanceDetails() {
        return $this->hasMany(OrdonnanceDetail::class, 'ordonnance_id', 'id');
    }

    public function getMedicamentsNumberAttribute() {
        return $this->hasMany(OrdonnanceDetail::class, 'ordonnance_id', 'id')->sum('quantity');
    }

    public function medecin() {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }

    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function consultation() {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

}
