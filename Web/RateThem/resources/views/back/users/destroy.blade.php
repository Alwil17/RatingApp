@extends('back.layout')
@section('main')
    <div class="container-fluid">
        <form id="deleteproduct" action="{{ route('days.destroy', $day->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        <div class="row">
            <div class="col-sm-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">Vous êtes sur le point de supprimer l'utilisateur "<strong>{{ $day->pseudo }}</strong>"</h5>
                        <p class="card-text">
                            <a class="btn btn-danger btn-lg btn-block" href="#" role="button"
                               onclick="event.preventDefault();
              $('#deleteproduct').submit();"
                            >Je confirme la suppression</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
