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
<div class="row w100resp mx-auto">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            Fiche de l'entreprise
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mt-1"><b>Nom</b> :  {{ $entreprise->name }}</li>
                    <hr>
                    <li class="mt-3 text-center"><img src="{{ asset('storage/compagnies/'. $entreprise->logo) }}" class="col-view img-fluid w-100" alt=""></li>
                    <hr>
                    <li class="mt-3"><b>Adresse mail</b> :  {{ $entreprise->email }}</li>
                    <hr>
                    <li class="mt-3 mb-0"><b>Site internet</b> :  {{ $entreprise->site }}</li>
                    <hr>
                    <li class="mt-3 mb-0"><b>Liste des employés</b> : </li>
                    <ul class="list-unstyled">
                        {{-- {{ dd($employes) }} --}}
                        @if(!empty($employes))
                            @foreach($employes as $employe)
                            <li><a href="{{route('employes.show', $employe)}}" class="text-link">{{ $employe->firstname . ' ' . $employe->lastname}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
