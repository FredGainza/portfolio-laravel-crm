@extends('layouts.app')

@section('scripts-header')
    <style>
    tr td img{
        width: 75px;
    }

    img.col-perso{
        width: 60%;
    }

    img.col-view{
        width: 400px;
        height: auto;
    }

	.w100resp{
		width: 100%;
	}

	@media (min-width: 768px){
		img.col-perso {
			width: 50%;
		}
		 .w100resp{
			width: 90%;
		}
	}


	@media (min-width: 992px){
		img.col-perso {
			width: 45%;
		}
		.w100resp{
			width: 70%;
		}
	}

	@media (min-width: 1200px){
		img.col-perso {
			width: 40%;
		}
		.w100resp{
			width: 50%;
		}
	}
</style>
@endsection

@section('content')

<div class="row w100resp mx-auto">
    <div class="col-12">
        <h3 class="mb-4">Editer une entreprise</h3>
        <form action="{{ route('entreprises.update', $entreprise->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $entreprise->name) }}" placeholder="Saisir le nom">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group mt-4">
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $entreprise->email) }}" placeholder="Saisir l'email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <span>Logo actuel:</span><br>
                <img class="col-perso" src="https://crm.fgainza.fr/storage/compagnies/{{ $entreprise->logo }}" alt="{{ $entreprise->logo }}">
            </div>
            <div class="custom-file mt-2">
                <label class="custom-file-label" for="logo">Modifier l'image</label>
                <input type="file" class="custom-file-input" name="logo" id="logo">
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group my-4">
                <div class="input-group-prepend">
                    <div class="input-group-text">www.</div>
                </div>
                <input type="text" name="site" id="site" value="{{ old('site', $entreprise->site) }}" class="form-control">
            </div>
            @error('site')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-dark w-100">Editer l'entreprise</button>

        </form>
    </div>
</div>
@endsection
