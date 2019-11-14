@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="text-center">
            <h3 class="display-4">
                {{ config('app.name', 'TinyNotes') }}
            </h3>

            <div class="alert alert-warning" style="display:inline-block; background-color: #ffff88!important;margin-bottom: 70px;" role="alert">
                <h5>TinyNotes est un site qui vous permet d'échanger avec un proche grâce à des Post-Its ! <br>
                Faites vous des bisous papiers !
                </h5>
                <br>
                <a class="btn btn-primary" href="{{ route('conversation.index') }}">{{ __('Démarrer une conversation') }}</a>
            </div>
            <h2>Etape par étape : </h2>
        </div>


        <div class="alert" style="display:inline-block; background-color: lightblue!important; width: 40%;
                border-bottom-right-radius: 60px 10px;
                box-shadow: 5px 5px 7px rgba(33, 33, 33, 0.7);" role="alert">
            <h3>Inscrivez-vous :</h3>
            <img src="/signuppic.png" style="transform: rotate(-5deg);float:left; width:50%; height: 70%"/>
            <h5 style="text-align: justify;">Pour vous inscrire, remplissez simplement le formulaire ! Vous pouvez aussi vous connecter directement grâce à votre compte Gmail.
            </h5>
        </div>
        <br>
        <div class="alert" style="display:inline-block; background-color: lightgreen!important; 
                width: 40%; margin-left: 60%;border-bottom-right-radius: 60px 10px;
                box-shadow: 5px 5px 7px rgba(33, 33, 33, 0.7);" role="alert">
            <h3>Créez une conversation : </h3>
            <br>
            <img src="/userspic.png" style="transform: rotate(5deg);float:right; width:70%; height: 30%">
            <h5 style="text-align: justify;">Recherchez une personne par son adresse emaill, puis lancer la conversation.
            </h5>
        </div>
        <br>
        <br>
        <div class="text-center">
    
            <div class="alert" style="display:inline-block; background-color: lightcoral!important; width:40%;
                    border-bottom-right-radius: 60px 10px;
                    box-shadow: 5px 5px 7px rgba(33, 33, 33, 0.7);" role="alert">
                <h3>Discutez !</h3>
                <img src="/tinynotes.png" style="width:80%; height: 80%">
                <br>
                <h5>Maintenant votre conversation créée, vous n'avez plus qu'à discuter par Post-its !
                </h5>
            </div>
        </div>


</div>
@endsection
