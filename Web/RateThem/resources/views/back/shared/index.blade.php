@extends('back.layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('main')
    {{ $dataTable->table(['class' => 'table table-bordered table-hover table-sm'], true) }}
    @if(Route::currentRouteName() === 'days.index')
        <a class="btn btn-primary" style="background-color: #304393 !important;" href="{{ route('days.create') }}" role="button">Ajouter un jour</a>
    @elseif(Route::currentRouteName() === 'users.index')
        <a class="btn btn-primary" style="background-color: #304393 !important;" href="{{ route('users.create') }}" role="button">Ajouter un utilisateur</a>
    @endif
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{ $dataTable->scripts() }}

@endsection
