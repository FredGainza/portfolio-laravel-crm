@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5"></div>
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mt-3">
            <a href="{{ route('entreprises.index') }}">ENTREPRISES</a>
        </div>
        <div class="col-md-6 text-center mt-3">
            <a href="{{ route('employes.index') }}">EMPLOYES</a>
        </div>
    </div>
</div>
@endsection
