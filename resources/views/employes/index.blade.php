@extends('layouts.app')

@section('scripts-header')
    <style>
    tr {
        line-height: 40px;
    }

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
		td{line-height: 1.5rem;}
		.table > tbody > tr > td {
     vertical-align: middle;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row mb-3">
        <h1>Liste des employés <a href="{{ route('employes.export') }}"><button class="btn btn-outline-dark btn-sm ml-3">dl csv</button></a></h1>
    </div>
    <div class="row mb-3">
        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <a href="{{ route('employes.create') }}"><button class="btn btn-dark">Ajouter un employé</button></a>
        </div>
        <div class="col-sm-12 col-md-5 offset-md-1 col-lg-4 offset-lg-5 mb-3 text-right">
            <div class="select">
                <select onchange="window.location.href = this.value" class="custom-select">
                    <option class="w-100" value="{{ route('employes.index') }}" @unless($name) selected @endunless>-- Tous les employés --</option>
                    @foreach($entreprises as $entreprise)
                        <option value="{{ route('employes.entreprise', $entreprise->name) }}" {{ $name == $entreprise->name ? 'selected' : '' }}>{{ $entreprise->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    {{-- <th>Id</th> --}}
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Employeur</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th></th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @if(!empty($employes))
                    @foreach($employes as $employe)
                        {{-- {{$ent->entreprise_id}} --}}
                        <tr id="{{ $employe->id }}">
                            {{-- <td>{{ $employe->id }}</td> --}}
                            <td>{{ $employe->lastname }}</td>
                            <td>{{ $employe->firstname }}</td>

                            <td><a href="{{ route('entreprises.show', $employe->entreprise->id) }}" class="text-link">{{$employe->entreprise->name .' (ID. '.$employe->entreprise->id.')'}}</a></td>
                            {{-- <td>{{ $ent->nom . '( entreprise ID : '. $employe->entreprise_id. ')' }}</td> --}}
                            <td>{{ $employe->email }}</td>
                            <td>{{ $employe->tel }}</td>
                            <td> <a href="{{ route('employes.show', $employe->id) }}"><i class="far fa-eye text-info"></i></a></td>
                            <td> <a href="{{ route('employes.edit', $employe->id) }}"><i class="fas fa-pen text-success"></i></a></td>
                            <td>
                                <form action="{{ route('employes.destroy', $employe->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_id" id="_id" value="{{$employe->id}}">
                                <button type="submit" class="fas fa-times text-danger border-0 bg-body" onclick="return confirm('Confirmez la suppression de cet élément')"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
       {{ $employes->links() }}
    </div>
</div>
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
                url: "employes/"+$id,
                type: "POST",
                dataType: "json",
                // contentType: "application/json",
                data: {
                    id: $id,
                    _method: 'DELETE',
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
