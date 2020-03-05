@extends('layouts.app')

@section('scripts-header')

    <style>
			.w100resp{
				width: 100%;
			}

        @media (min-width: 768px){
            .w100resp{
                width: 95%;
            }
        }

        @media (min-width: 992px){
            .w100resp{
                width: 75%;
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
    {{-- {{ dd($errors) }} --}}
    <div class="col-12">
        <h3 class="mb-4">Ajouter une entreprise</h3>
        <form action="{{ route('entreprises.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Saisir le nom">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group mt-4">
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Saisir l'email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="custom-file mt-2">
                <label class="custom-file-label" for="logo">Choisir l'image</label>
                <input type="file" class="custom-file-input @error('logo') is-invalid @enderror" name="logo" id="logo" value="{{ old('logo') }}">
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group my-4">
                <div class="input-group-prepend">
                    <div class="input-group-text">www.</div>
                </div>
                <input type="text" name="site" id="site" value="{{ old('site') }}" class="form-control">
            </div>
            @error('site')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-dark w-100">Ajouter l'entreprise</button>
        </form>
    </div>
</div>
@endsection
