@extends('layout.main')

@section('title', 'Użytkownik')

@section('sidebar')
    @parent
    <div>Lista użytkowników: <a href="{{ route('get.users') }}">Link</a></div>
@endsection




@section('content')





    <div class="card">
        <h5 class="card-header">{{ $user['name'] }}</h5>
        <div class="card-body">
            <ul>
                <li>Id: {{ $user['id'] }}</li>
                <li>Imię: {{ $user['firstName'] }}</li>
                <li>Nazwisko: {{ $user['lastName'] }}</li>
                <li>Miasto: {{ $user['city'] }}</li>
                <li>Wiek: {{ $user['age'] }}</li>
            </ul>

            <a href="{{ route('get.users') }}" class="btn btn-light">Lista użytkowników</a>
        </div>
    </div>

<div>
@if ( $ba == 1)
   <div class="green"> Operacja sie udała  </div>

@else  <div class="red"> Operacja sie NIE udała  </div>

@endif
</div>
<style>
    .green{
        color: green;
    }
    .red{
        color: red;
    }

</style>




@endsection
