@extends('errors::minimal')

@section('title', 'Requêtes trop nombreuses')
@section('code', '429')
@section('message', 'Le client a émis trop de requêtes dans un délai donné')
