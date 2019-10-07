@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <h4 class="card-header">Démarrer une conversation</h4>

                <div class="card-body text-center">
                        <p id="emailHelp" class="form-text text-muted">Rechercher un utilisateur avec lequel discuter</p>
                        <div style="width:70%;margin:auto;">
                        <div class="form-group">
                          <input type="email" style="text-align: center;" class="form-control" id="email" required name="email" aria-describedby="emailHelp" placeholder="Entrez une adresse email" autocomplete="true">
                        </div>
                        <button id="checkUsersButton" type="button" class="btn btn-primary">Rechercher</button>
                    </div>

                      <div id="errorMessage" class="alert alert-danger" role="alert" style="width:50%;margin:10px auto;display:none">
                            Il est nécessaire d'entrer un email
                          </div>
                    <div id="userResultTable">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
