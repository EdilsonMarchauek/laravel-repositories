<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $table = 'product';

    protected $fillable = ['name', 'price', 'description', 'image'];

    public function search($filter = null)
    {

        $results = $this->where(function ($query) use($filter){
            if ($filter){
                $query->where('name', 'LIKE', "%{$filter}%")
                      ->orWhere('price', 'LIKE', "%{$filter}%");
            }
            if ($filter){
                $query->where('price', 'LIKE', "%{$filter}%");
            }
        })//->toSql();
        ->paginate();

        return $results;           
    }
    
}
