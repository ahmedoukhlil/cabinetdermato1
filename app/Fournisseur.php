<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Fournisseur extends Model {

    use SoftDeletes,
        Auditable;

    public $table = 'fournisseurs';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'name',
        'phone',
        'solde',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function commandes() {
        return $this->hasMany(Commande::class, 'fournisseur_id', 'id');
    }


    public function paiements() {
        return $this->hasMany(CommandePaiement::class, 'fournisseur_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
