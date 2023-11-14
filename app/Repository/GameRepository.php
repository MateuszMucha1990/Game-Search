<?php

declare(strict_types=1);

namespace App\Repository;
use App\Models\Game;

class GameRepository {

    private Game $gameModel;

    public function __construct(Game $gameModel)
    {
        $this->gameModel = $gameModel;
    }




    public function get($gameId){

        //return Game::find($gameId);
        return $this->gameModel
        ->find($gameId);
    }



    public function all(){
        return $this->gameModel
        ->with('genre')
        ->orderBy('create_at')
        ->get();
    }



    public function allPaginated(int $limit){

        return $this->gameModel
        ->with('genre')
        ->orderBy('create_at')
        ->paginate($limit);
    }




    public function best(){
        return $this->gameModel
        ->best()
        ->get();
    }



    public function stats(){
        return [
            'count'=>$this->gameModel->count(),
            'countScoreGtFive'=>$this->gameModel->where('score', '>', 9)->count(),
            'max'=>$this->gameModel->max('score'),
            'min'=>$this->gameModel->min('score'),
            'avg'=>$this->gameModel->avg('score'),
        ];
    }

    public function scoreStats(){
        return $this->gameModel
        ->select($this->gameModel
            ->raw('count(*) as count'), 'score')
        ->groupBy('score')
        ->orderBy('count','desc')
        ->get();
    }


}
