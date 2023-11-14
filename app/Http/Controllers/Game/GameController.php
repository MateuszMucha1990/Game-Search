<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Repository\GameRepository ;
use Illuminate\Contracts\View\View;

class GameController extends Controller
{
    private GameRepository $gameRepository;

    public function __construct(GameRepository $repository) {
        $this->gameRepository = $repository;
    }

            //POBRANIE WSZYSTKICH GIER
    public function index():View
    {
            // $games = Game::with('genre')
            // ->orderBy('create_at')
            // ->paginate(10);
        $games=$this->gameRepository->allPaginated(10);

        return View('game.list',[
        'games' =>$games,]);
    }


    public function dashboard(): View
    {

            // $bestGames = Game::best() ->get();
       $bestGames= $this->gameRepository->best();

                //SQL-pobieranie z bazy
            // $bestGames = DB::table('games')
            // ->join('genres', 'games.genre_id', '=', 'genres.id')
            // ->select('games.id','games.title','games.score','genres_id as genres_id','genres.name as genres_name')
            // ->where('score', '>', 9)
            // ->get();


            // $stat = [
            //     'count'=>Game::count(),
            //     'countScoreGtFive'=>Game::where('score', '>', 9)->count(),
            //     'max'=>Game::max('score'),
            //     'min'=>Game::min('score'),
            //     'avg'=>Game::avg('score'),
            // ];
            // $stat = [
            //     'count'=>DB::table('games')->count(),
            //     'countScoreGtFive'=>DB::table('games')->where('score', '>', 9)->count(),
            //     'max'=>DB::table('games')->max('score'),
            //     'min'=>DB::table('games')->min('score'),
            //     'avg'=>DB::table('games')->avg('score'),
            // ];
        $stat = $this->gameRepository->stats();

            // $scoreStats= Game::select(Game::raw('count(*) as count'), 'score')
            //     ->groupBy('score')
            //     ->orderBy('count','desc')
            //     ->get();
        $scoreStats=  $this->gameRepository->scoreStats();

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
            // $game = Game::find($gameId);  //zwraca obj, jesli chcemy arr to (array)$game
        $game = $this->gameRepository->get($gameId);

        return view('game.show',[
            'game' =>$game
        ]);
    }

}
