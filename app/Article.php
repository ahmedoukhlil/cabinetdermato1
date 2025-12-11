<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Article extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'articles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'category_id',
        'name',
        'quantity',
        'forme_id',
        'autorised_quantity',
        'prix_aquisition',
        'prix',
        'user_id',
        'seuil',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function articleCommandeDetails()
    {
        return $this->hasMany(CommandeDetail::class, 'article_id', 'id');
    }

    public function forme()
    {
        return $this->belongsTo(FormeMedicament::class, 'forme_id');
    }

    public function ventes()
    {
        return $this->hasMany(SaleDetail::class, 'article_id', 'id');
    }

    public function livraisons()
    {
        return $this->hasMany(OrdonnanceLivraison::class, 'article_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
