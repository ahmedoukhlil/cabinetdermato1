<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

    use SoftDeletes;

    public $table = 'employees';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'name',
        'email',
        'phone',
        'phone_2',
        'salary',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFullNameAttribute() {
        return $this->name;
    }
}
