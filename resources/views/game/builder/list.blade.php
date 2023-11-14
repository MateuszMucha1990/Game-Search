@extends('layout.main')

@section('content')



<div class="row mt-3">
    <div class="card">
        <div class="card-header"> <i class="fas fa-table mr-1">Gry</i></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                    <thead>
                    <tr>
                        <th>Lp</th>
                        <th>Tytuł</th>
                        <th>ocena</th>
                        <th>Kategoria</th>
                        <th>Opcje</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Lp</th>
                        <th>Tytuł</th>
                        <th>ocena</th>
                        <th>Kategoria</th>
                        <th>Opcje</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        <!-- jesli $games nie jest tablica, to przyjmiemy ze jest  pustą tab -->
                        @foreach ($games ?? [] as $game)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $game->title }}</td>
                                <td>{{ $game->score }}</td>
                                <td>{{ $game->genres_name }}</td>
                                <td> <a href="{{ route('games.b.show', ['game'=> $game->id]) }}">Szczegóły</a></td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- paginacja -->
            {{ $games ->links('vendor.pagination.bootstrap-4')  }}
        </div>
    </div>
</div>
@endsection
