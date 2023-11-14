<?php
declare (strict_types = 1);

use App\Http\Controllers\Game\BuilderController;
use App\Http\Controllers\Game\EloquentController;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ShowAddress;
use App\Http\Controllers\Home\MainPage;
use App\Http\Controllers\UserController;
use Doctrine\DBAL\Driver\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::middleware(['auth'])->group(function() {  --- to samo co nizej
Route::group(['middleware'=>['auth']], function(){  //Route dla AUTH
    // Route::get('/',[MainPage::class,'ss'])
    //     ->name('home.mainPage');
    Route::get('/', MainPage::class)
        ->name('home.mainPage');
        //USERS
    Route::get('users', [UserController::class,'list'])
        ->name('get.users');

    Route::get('users/{userId}', [UserController::class,'show'])
        ->name('get.users.show');

    Route::get('users/{id}/address', ShowAddress::class)  //bez nazwy akcji
        ->where(['id'=>'[0-9]+']);


             // GAMES-QueryBUILDER
    Route::group([
        'prefix' => 'b/games',  //-->   b/games/dashboard -- to samo NAZWA ROUTY
        'as' => 'games.b.',       //-->   games.b.dashboard -- to samo w NAME
        'middleware' => ['profiling']  // profiling- bo tak dalismy grupe mid w pliku KERNEL
    ], function(){
        Route::get('dashboard', [BuilderController::class,'dashboard'])
            ->name('dashboard');
            //->Middleware('profiling');

        Route::get('', [BuilderController::class,'index'])
            ->name('list');

        Route::get('{game}', [BuilderController::class,'show'])
            ->name('show');
            //->Middleware('profiling');
    });



             // GAMES-REPOZYTORIUM
    Route::group([
        'prefix' => 'games',
        'as' => 'games.',
        //'middleware' => ['profiling']
    ], function(){
        Route::get('dashboard', [GameController::class,'dashboard'])
            ->name('dashboard');

        Route::get('', [GameController::class,'index'])
            ->name('list');

        Route::get('{game}', [GameController::class,'show'])
            ->name('show');
    });






        // GAMES--ELOQUENT
    Route::group([
        'prefix' => 'e/games',  //-->   b/games/dashboard -- to samo NAZWA ROUTY
        'as' => 'games.e.' ,      //-->   games.b.dashboard -- to samo w NAME
        'middleware' => ['profiling']  // profiling- bo tak dalismy grupe mid w pliku KERNEL
    ], function(){
        Route::get('dashboard', [EloquentController::class,'dashboard'])
            ->name('dashboard');

        Route::get('', [EloquentController::class,'index'])
            ->name('list');

        Route::get('{game}', [EloquentController::class,'show'])
            ->name('show');
    });

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Auth::routes();
