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

    public function getExistStore($store) {
        $object = $this->where('name', $store)->first();
        return $object ?? false;
    }

    public function saveToken($params) {
//        $object = $this->where('name', $params['name'])->first();
//        if ($object) {
//            return $object->update($params);
//        }
        return $this->create($params);
    }

    public function remove($store) {
        return $this->where('name', $store)->delete();
    }
}
