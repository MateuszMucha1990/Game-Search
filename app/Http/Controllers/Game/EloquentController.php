<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RequestLog;
use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EloquentController extends Controller
{
            //POBRANIE WSZYSTKICH GIER

    public function index():View
    {
        $this->middleware(RequestLog::class);


            //CREATE nowej gry
        // $newGame = new Game();
        // $newGame->title = 'Tomb Rider';
        // $newGame->description = 'Przygoda itp';
        // $newGame->score =9;
        // $newGame->publisher ='Edios';
        // $newGame->genre_id =4;
       // $newGame->save();

            //UPDATE -dla jednej danej
        // $game = Game::find(101);  //szukanie po id
        // $game ->description = 'Nowy opis';
        // $game->genre_id =3; // nowy genre id
        //$game->save();


                //UPDATE -dla wielu  danych
        // $gameIds=[101]; //moze byc wiecej id
        // Game::whereIn('id', $gameIds)
        //     ->update(['description' => 'Jeszcze nowsza']);




        $games = Game::with('genre')
        ->orderBy('create_at')
        ->paginate(10);


        return View('game.eloquent.list',[
        'games' =>$games,]);
    }


    public function dashboard(): View
    {
            //SCOPE funkcja  best w Game.php
        $bestGames = Game::best() ->get();

            //SQL
        // $bestGames = DB::table('games')
        // ->join('genres', 'games.genre_id', '=', 'genres.id')
        // ->select('games.id','games.title','games.score','genres_id as genres_id','genres.name as genres_name')
        // ->where('score', '>', 9)
        // ->get();


        $stat = [
            'count'=>Game::count(),
            'countScoreGtFive'=>Game::where('score', '>', 9)->count(),
            'max'=>Game::max('score'),
            'min'=>Game::min('score'),
            'avg'=>Game::avg('score'),
        ];
        // $stat = [
        //     'count'=>DB::table('games')->count(),
        //     'countScoreGtFive'=>DB::table('games')->where('score', '>', 9)->count(),
        //     'max'=>DB::table('games')->max('score'),
        //     'min'=>DB::table('games')->min('score'),
        //     'avg'=>DB::table('games')->avg('score'),
        // ];

        $scoreStats= Game::select(Game::raw('count(*) as count'), 'score')
            ->groupBy('score')
            ->orderBy('count','desc')
            ->get();

        return view('game.eloquent.dashboard', [
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
        $game = Game::find($gameId);  //zwraca obj, jesli chcemy arr to (array)$game

        return view('game.eloquent.show',[
            'game' =>$game
        ]);
    }

}
