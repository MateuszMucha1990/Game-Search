<?php

namespace App\Models;

use App\Models\Scope\LastWeekScope;
use Illuminate\Database\Eloquent\Builder ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';  // odnosi sie do nazwy bazy danych, domyslnie liczba mnoga od TEJ klasy, czyli 'Games'
    protected $primatyKey = 'id'; // klucz głowny, domyslnie jest id
   // protected $timestamps = true;  // jesli w DB w tab nie ma create_at i update_up, to trzeba dac false
    protected $attributes = [      //domyslne wartosci dla danych kolumn
        //score => 5     //po utworzeniu wartosc bedzie miec 5
    ];


    //         //GLOBAL SCOPE
    // protected static function booted()
    // {
    //     static::addGlobalScope(new LastWeekScope());  //tu dodajemu nasz Global SCOPE
    // }



    public function genre(){
        return $this->belongsTo(
            Genre::class,
           // 'genre_id',  //-dodatkowo-foreign key
           // 'id'       //-dodatkowo- primary key
            );
    }


              //Local SCOPE
    public function scopeBest(Builder $query): Builder {
        return $query
         ->with('genre')
         ->where('score', '>=', 9)
         ->orderBy('score','desc');
    }

    public function scopeGenre(Builder $query, int  $genreId): Builder {
        return $query ->where('genre_id', $genreId);
    }

    public function scopePublisher(Builder $query, string  $name): Builder {
        return $query ->where('publisher', $name);
    }
}
