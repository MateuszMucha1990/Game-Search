@extends('layout.main')

@section('content')
<div class="row mt-3">
    <div class="col-x col-xl-3 col-md-6 mb-4">
        <div class="card border-left shadow-sm py-2 h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-cs text-primary text-uppercase mb-1">Liczba gier</div>
                        <div class="h5 mb-0 text-gray-800">{{ $stats['count'] }}</div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-gamepad fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="col-x col-xl-3 col-md-6 mb-4">
        <div class="card border-left shadow-sm py-2 h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-cs text-primary text-uppercase mb-1">Liczba gier wieksza od 9</div>
                        <div class="h5 mb-0 text-gray-800">{{ $stats['countScoreGtFive'] }}</div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-gamepad fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-x col-xl-3 col-md-6 mb-4">
        <div class="card border-left shadow-sm py-2 h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-cs text-primary text-uppercase mb-1">Max ocena</div>
                        <div class="h5 mb-0 text-gray-800">{{ $stats['max'] }}</div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-gamepad fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="col-x col-xl-3 col-md-6 mb-4">
        <div class="card border-left shadow-sm py-2 h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-cs text-primary text-uppercase mb-1">min ocena</div>
                        <div class="h5 mb-0 text-gray-800">{{ $stats['min'] }}</div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-gamepad fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="row mt-3">
    <div class="card">
        <div class="card-header"> <i class="fas fa-table mr-1">Oceny</i></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                    <thead>
                    <tr>
                        <th>ocena</th>
                        <th>Liczba gier z oceną</th>
                    </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>
                        <!-- jesli $games nie jest tablica, to przyjmiemy ze jest  pustą tab -->
                        @foreach ($scoreStats ?? [] as $scoreStat)
                            <tr>
                                <td>{{ $scoreStat->score }}</td>
                                <td>{{ $scoreStat->count }}</td>

                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header"> <i class="fas fa-table mr-1">Gry Best of the best</i></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                    <thead>
                    <tr><th>Lp</th>
                        <th>Tytuł</th>
                        <th>ocena</th>
                        <th>Kategoria</th>
                    </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>
                        <!-- jesli $games nie jest tablica, to przyjmiemy ze jest  pustą tab -->
                        @foreach ($bestGames ?? [] as $bestGame)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                                <td>{{ $bestGame->title }}</td>
                                <td>{{ $bestGame->score }}</td>
                                <td>{{ $bestGame->genre->name }}</td>

                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
