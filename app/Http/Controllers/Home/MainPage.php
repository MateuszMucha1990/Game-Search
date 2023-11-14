<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainPage extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        return view('home.main',[
            'user' => $user
        ]);
    }
}
