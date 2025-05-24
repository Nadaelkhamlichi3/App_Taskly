@extends('layouts.app')  <!-- Si vous utilisez un layout -->
@section('content')
    <div class="container">
        <div class="alert alert-danger">
            <h4 class="alert-heading">Erreur!</h4>
            <p>{{ session('error') }}</p> <!-- Affiche le message d'erreur -->
            <hr>
            <p class="mb-0">Il semble que le projet associé à cette invitation est introuvable. Veuillez vérifier l'invitation ou contacter l'administrateur.</p>
        </div>
        <a href="" class="btn btn-primary">Retourner au tableau de bord</a>
    </div>
@endsection