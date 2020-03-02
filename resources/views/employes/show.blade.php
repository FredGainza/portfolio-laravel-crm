@extends('layouts.app')

@section('scripts-header')

    <style>
			.w100resp{
				width: 100%;
			}
		
        @media (min-width: 768px){
            .w100resp{
                width: 90%;
            }
        }

        @media (min-width: 992px){
            .w100resp{
                width: 70%;
            }
        }

        @media (min-width: 1200px){
            .w100resp{
                width: 50%;
            }
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row w100resp mx-auto">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                Fiche de l'employé
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        {{-- {{ dd($ent) }} --}}
                        <li class="mt-1"><b>Nom</b> :  {{ $employe->firstname }}</li>
                        <hr>
                        <li class="mt-3"><b>Prénom</b> :  {{ $employe->lastname }}</li>
                        <hr>
                        <li class="mt-3"><b>Employeur</b> :  {{ $entreprise }}</li>
                        <hr>
                        <li class="mt-3"><b>Adresse mail</b> :  {{ $employe->email }}</li>
                        <hr>
                        <li class="mt-3 mb-0"><b>Numéro de télephone</b> :  {{ $employe->tel }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
