<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public function games(){
        return $this->hasMany(
            Game::class,
           // 'genre_id',   //-dodatkowo-foreign key- ta kolumna musi znajdowac sie w tabeli GAME i byc kluczem obcym powiazanym z tabela GENRE
           // 'id'        //-dodatkowo- primary key- kolumna z kluczem glownym
            );
    }
}
