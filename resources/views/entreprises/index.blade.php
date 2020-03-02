@extends('layouts.app')

@section('scripts-header')
    <style>
    tr td img{
        width: 75px;
    }

    img.col-perso{
        width: 60px;
    }

    img.col-view{
        width: 400px;
        height: auto;
    }

    .bg-body{
        background-color: #f8fafc;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row mb-3">
        <h1>Liste des entreprises <a href="{{ route('entreprises.export') }}"><button class="btn btn-outline-dark btn-sm ml-3">dl csv</button></a></h1>
    </div>
    <div class="row mb-3">
        <div class="col-sm-12 col-md-6 col-lg-3">
            <a href="{{ route('entreprises.create') }}"><button class="btn btn-dark">Ajouter une entreprise</button></a>
        </div>
        {{-- <div class="col-4 offset-5 text-right">
            <div class="select">
                <select onchange="window.location.href = this.value" class="custom-select">
                    <option class="w-100" value="{{ route('entreprises.index') }}" @unless($name) selected @endunless>-- Toutes les entreprises --</option>
                    @foreach($entreprises as $entreprise)
                        <option value="{{ route('entreprises.entreprise', $employe->lastname) }}" {{ $lastname == $employe->lastname ? 'selected' : '' }}>{{ $employe->lastname }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <table class="table center" id="tab_ent">
            <thead>
                <tr>
                    {{-- <th>Id</th> --}}
                    <th>Raison sociale</th>
                    {{-- <th>Raison sociale
                        <div class="btn-group" role="group" aria-label="Menu déroulant">
                          <button id="affichageName" type="button" class="btn white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                          <div class="dropdown-menu" aria-labelledby="affichageName">
                            <a class="dropdown-item" href="{{ route('entreprises.index', $entNameCrt) }}">Affichage par ordre croissant</a>
                            <a class="dropdown-item" href="{{ route('entreprises.index', $entNameDct) }}">Affichage par ordre decroissant</a>
                          </div>
                        </div>
                    </th> --}}
                    <th>Adresse E-mail</th>
                    <th class="col-perso">Logo</th>
                    <th>Site Web</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($entreprises))
                    @foreach($entreprises as $entreprise)
                        <tr id="{{ $entreprise->id }}">
                            {{-- <td>{{ $entreprise->id }}</td> --}}
                            <td>{{ $entreprise->name }}</td>
                            <td>{{ $entreprise->email }}</td>
                            {{-- <td><img src="http://crm.test/storage/compagnies/Aguirre_logo.png" alt=""></td> --}}
                            <td><img src="{{ asset('storage/compagnies/'. $entreprise->logo) }}" alt=""></td>
                            {{-- <td>{{ $entreprise->logo }}</td> --}}
                            <td>{{ $entreprise->site }}</td>
                            <td> <a href="{{ route('entreprises.show', $entreprise->id) }}"><i class="far fa-eye text-info"></i></a></td>
                            <td> <a href="{{ route('entreprises.edit', $entreprise->id) }}"><i class="fas fa-pen text-success"></i></a></td>
                            <td>
                                <form action="{{ route('entreprises.destroy', $entreprise->id) }}" method="post">
                                    @csrf
                                <input type="hidden" name="_id" id="_id" value="{{$entreprise->id}}">
                                <button type="submit" class="fas fa-times text-danger border-0 bg-body" onclick="return confirm('Confirmez la suppression de cet élément')"></button>
                                </form>
                            </td>
                            {{-- <td> <a href="{{ route('entreprises.destroy', $entreprise->id) }}" onclick="return confirm('Confirmez la suppression de cet élément')"><i class="fas fa-times text-danger"></i></a></td> --}}
                        </tr>

                    @endforeach
                @endif
            </tbody>
        </table>
        {{ $entreprises->links() }}
    </div>
</div>
{{-- </div>
<div id="toastDelete" aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;" class="invisible">
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast"
        style="position: absolute; bottom: 0; right: 50px;" data-autohide="false">
        <div class="toast-header">
            <i class="far fa-comment mr-2 info"></i>
            <strong class="mr-auto">Information :</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body bg-pers">
            {{ 'L\'entreprise' .$entreprise->name. ' a été supprimée' }}
        </div>
    </div>
</div> --}}
@endsection

@section('scripts-footer')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })

        $('form').submit(function(e){
            // console.log($('form'));
            e.preventDefault();
            // console.log('tete');
            // console.log( $(this) );debugger;
            let token = $('meta[name="crsf_token"]');

            let $id = $('#_id', $(this)).val();
            console.log($id);

            $.ajax({
                url: "entreprises/"+$id,
                type: "POST",
                dataType: "json",
                // contentType: "application/json",
                data: {
                    id:$id,
                    _method:'DELETE',
                },
                success: function(code, statut){
                    console.log($id);
                    var row = document.getElementById($id);
                    row.parentNode.removeChild(row);
                    // $('#toastDelete').removeClass('invisible').addClass('visible');
                },

                error: function(resultat, statut, erreur){
                    console.log(erreur);
                }
            });

        });
    });
    </script>
@endsection
