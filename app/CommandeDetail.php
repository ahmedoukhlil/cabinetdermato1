<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class CommandeDetail extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'commande_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'commande_id',
        'article_id',
        'quantity',
        'prix_unitaire',
        'montant_total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
