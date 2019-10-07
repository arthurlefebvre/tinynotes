@extends('layouts.app')

@section('content')
<div class="container text-center">
            <h3 class="display-4">
                {{ config('app.name', 'TinyNotes') }}
            </h3>

            <div class="alert alert-warning" style="display:inline-block; background-color: #ffff88!important;" role="alert">
                <h5>TinyNotes est un site qui vous permet d'échanger avec un proche grâce à des Post-Its ! <br>
                Faites vous des bisous papiers !
                </h5>
                <br>
                <a class="btn btn-primary" href="{{ route('conversation.index') }}">{{ __('Démarrer une conversation') }}</a>
            </div>


</div>
@endsection
