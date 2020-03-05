@extends('layouts.app')

@section('scripts-header')
    <style>
        table th, table td{
            vertical-align: middle !important;
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
            background-color: inherit;
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
    </div>

    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    {{-- <th>Id</th> --}}
                    <th>Raison sociale</th>
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
                            <td><img src="{{ asset('storage/compagnies/'. $entreprise->logo) }}" alt=""></td>
                            <td>{{ $entreprise->site }}</td>
                            <td> <a href="{{ route('entreprises.show', $entreprise->id) }}"><i class="far fa-eye text-info"></i></a></td>
                            <td> <a href="{{ route('entreprises.edit', $entreprise->id) }}"><i class="fas fa-pen text-success"></i></a></td>
                            <td>
                                <form action="{{ route('entreprises.destroy', $entreprise->id) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_id" id="_id" value="{{$entreprise->id}}">
                                    <button class="border-0 bg-body px-0 mx-0" type="submit" onclick="return confirm('Confirmez la suppression de cet élément')"><i class="fas fa-times text-danger"></i></button>
                                </form>
                            </td>
                        </tr>

                    @endforeach
                @endif
            </tbody>
        </table>
        {{ $entreprises->links() }}
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
