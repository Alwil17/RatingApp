@extends('back.layout')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <form method="POST"
                          action="@isset($user) {{ route('users.update', $user->id) }} @else {{ route('users.store') }} @endisset">
                        <div class="card-body row">
                            @isset($user) @method('PUT') @endisset
                            @csrf
                            <div class="form-group col-md-6">
                                <x-inputbs4
                                    name="lastname"
                                    type="text"
                                    label="Nom"
                                    :value="isset($user) ? $user->lastname : ''"
                                    required
                                ></x-inputbs4>
                            </div>
                            <div class="form-group col-md-6">
                                <x-inputbs4
                                    name="firstname"
                                    type="text"
                                    label="Prenoms"
                                    :value="isset($user) ? $user->firstname : ''"
                                    required
                                ></x-inputbs4>
                            </div>
                            <div class="form-group col-md-3">
                                <x-inputbs4
                                    name="pseudo"
                                    type="text"
                                    label="Pseudo"
                                    :value="isset($user) ? $user->pseudo : ''"
                                    required
                                ></x-inputbs4>
                            </div>
                            <div class="form-group col-md-5">
                                <x-inputbs4
                                    name="email"
                                    type="email"
                                    label="Email"
                                    :value="isset($user) ? $user->email : ''"
                                    required
                                ></x-inputbs4>
                            </div>
                                <div class="form-group col-md-4">
                                <x-inputbs4
                                    name="password"
                                    type="password"
                                    label="Mot de passe"
                                    :value="isset($user) ? $user->password : ''"
                                    required
                                ></x-inputbs4>
                            </div>
                            <div class="form-group col-md-6">
                                <x-inputbs4
                                    name="address"
                                    type="text"
                                    label="Adresse"
                                    :value="isset($user) ? $user->address : ''"
                                ></x-inputbs4>
                            </div>
                            <div class="form-group col-md-3">
                                <x-inputbs4
                                    name="phone"
                                    type="tel"
                                    label="Tel"
                                    :value="isset($user) ? $user->phone : ''"
                                ></x-inputbs4>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="type" class="text-orange">Type *</label>
                                <select id="type" name="type" class="custom-select custom-select-md form-control"
                                        required>
                                    <option value="#" selected>--- Choisir un type ---</option>
                                    <option
                                        value="user"
                                        @if(old('type', isset($user) ? $user->type : '') == "user") selected @endif>
                                        Utilisateur
                                    </option>
                                    <option
                                        value="admin" @if(old('type', isset($user) ? $user->type : '') == "admin") @endif>
                                        Administrateur
                                    </option>
                                </select>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <a class="btn btn-primary" href="{{ route('users.index') }}" role="button"><i
                                            class="fas fa-arrow-left"></i> Retour à la liste des jours</a>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
