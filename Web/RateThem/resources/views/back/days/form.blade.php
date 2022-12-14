@extends('back.layout')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <form method="POST" action="@isset($day) {{ route('days.update', $day->id) }} @else {{ route('days.store') }} @endisset">
                        <div class="card-body">
                            @isset($day) @method('PUT') @endisset
                            @csrf

                            <x-inputbs4
                                name="nom"
                                type="text"
                                label="Nom"
                                :value="isset($day) ? $day->nom : ''"
                            ></x-inputbs4>
                        </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <a class="btn btn-primary" href="{{ route('days.index') }}" role="button"><i class="fas fa-arrow-left"></i> Retour à la liste des jours</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
