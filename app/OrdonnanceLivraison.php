<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class OrdonnanceLivraison extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'ordonnance_livraisons';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ordonnance_id',
        'article_id',
        'user_id',
        'quantity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function ordonnance()
    {
        return $this->belongsTo(Ordonnance::class, 'ordonnance_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
