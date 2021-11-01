<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{


    const ALBUMS = [
            ['nom' => 'silence', 'lien' => 'silence', 'type' => 'albums'],
            ['nom' => 'martha', 'lien' => 'martha', 'type' => 'albums'],
            ['nom' => 'tomorrowland', 'lien' => 'coucou-magazine/tomorrowland/', 'type' => 'books'],
            ['nom' => 'premiere classe', 'lien' => 'coucou-magazine/', 'type' => 'books'],
            ['nom' => '33 midi', 'lien' => 'coucou-magazine/33-midi/', 'type' => 'books'],
        ];

    protected $table = 'albums';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'nom_route',
        'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];    

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }



}
