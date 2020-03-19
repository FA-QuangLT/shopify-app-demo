<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'access_token', 'domain'
    ];

    public $timestamps = false;


    public function saveToken($params) {
        $object = $this->where('name', $params['name'])->first();
        if ($object) {
            return $object->update($params);
        }
        return $this->create($params);
    }

}
