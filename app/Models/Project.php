<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Project extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'projects';
     protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['user_id', 'name', 'city'];
    // protected $hidden = [];
    // protected $dates = [];
    const SOLD = 'Sold';
    const AVAILABLE = 'Available';
    const SEPARATED = 'Separated';


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */


    public function soldTotalByProperties(){
        $properties22 = $this->properties()
            ->where('status','=', self::SOLD)
            ->get();
        $add = 0;
        foreach ($properties22 as $value){
            $add = $value->price + $add;
        }

        return $add;
    }

    public function separatedTotalByProperties(){
        $properties22 = $this->properties()
            ->where('status','=', self::SEPARATED)
            ->get();


        return $properties22->count();
    }

    public function availableTotalByProperties(){
        $properties22 = $this->properties()
            ->where('status','=', self::AVAILABLE)
            ->get();

        return $properties22->count();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function properties()
    {
        return $this->hasMany('App\Models\Property');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
