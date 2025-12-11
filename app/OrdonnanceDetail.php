<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class OrdonnanceDetail extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'ordonnance_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'article_id',
        'posologie',
        'quantity',
        'duration',
        'ordonnance_id',
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
}
