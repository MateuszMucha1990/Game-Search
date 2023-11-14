<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Faker\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EloquentController extends Controller
{
            //POBRANIE WSZYSTKICH GIER

    public function index():View
    {
        // $games = DB::table('games')
        // ->select('id','title','score','genre_id')
        // ->get();

        $games = DB::table('games')
        ->join('genres', 'games.genre_id', '=', 'genres.id')
        ->select('games.id','games.title','games.score','genres_id as genres_id','genres.name as genres_name')
        ->paginate(10);


        return View('game.builder.list',[
        'games' =>$games,]);
    }


    public function dashboard(): View
    {
        $bestGames = DB::table('games')
        ->join('genres', 'games.genre_id', '=', 'genres.id')
        ->select('games.id','games.title','games.score','genres_id as genres_id','genres.name as genres_name')
        ->where('score', '>', 9)
        ->get();


        $stat = [
            'count'=>DB::table('games')->count(),
            'countScoreGtFive'=>DB::table('games')->where('score', '>', 9)->count(),
            'max'=>DB::table('games')->max('score'),
            'min'=>DB::table('games')->min('score'),
            'avg'=>DB::table('games')->avg('score'),
        ];

        $scoreStats= DB::table('games')
            ->select(DB::raw('count(*) as count'), 'score')
            ->groupBy('score')
            ->orderBy('count','desc')
            ->get();

        return view('game.builder.dashboard', [
            'stats' =>$stat,
            'bestGames'=>$bestGames,
            'scoreStats' => $scoreStats
        ]);
    }

            //POBRANIE 1 GRY
    public function show(int $gameId): View
    {
        //$game = DB::table('games')->where('id' , $gameId) ->get();
        //$game = DB::table('games')->where('id' ,$gameId) ->first();  ZWRACA OBJ, wiec
        $game = DB::table('games')->find($gameId);  //zwraca obj, jesli chcemy arr to (array)$game

        return view('game.builder.show',[
            'game' =>$game
        ]);
    }

}
