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
        {{-- {{ dd($errors) }} --}}
        <div class="col-12">
            <h3 class="mb-4">Ajouter un employé</h3>
            <form action="{{ route('employes.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="firstname" id="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" placeholder="Saisir le prénom" required>
                    @error('firstname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <input type="text" name="lastname" id="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" placeholder="Saisir le nom" required>
                    @error('lastname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    {{-- {{ dd($employes) }} --}}
                    <div class="field">
                        <label class="label">Employeur</label>
                        <div class="select">
                            <select name="entreprise_id" class="custom-select">
                                @foreach($entreprises as $entreprise)
                                    <option value="{{ $entreprise->id }}">{{ $entreprise->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @error('entreprise_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Saisir l'email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-4">
                    <input type="text" name="tel" id="tel" class="form-control @error('tel') is-invalid @enderror" value="{{ old('tel') }}" placeholder="Saisir le numéro de télephone">
                    @error('tel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- {{ dd($errors) }} --}}
                <button type="submit" class="btn btn-dark w-100">Ajouter l'employé</button>
            </form>
        </div>
    </div>
</div>
@endsection
