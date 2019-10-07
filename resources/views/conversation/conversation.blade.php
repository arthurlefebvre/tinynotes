@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
                <h1>{{ $conversation->name }}</h1>

                <div class="card-body text-center">
                    @if($message == null)
                        <p>Pas de message à afficher. Ecrivez-en un !</p>
                    @else
                        <div class="postit" style="background-color: {{$message->color->color_code}}">{{ $message->message }}</div>
                    @endif
                </div>

        </div>

    </div>
</div>
<a class="btn btn-primary fab text-white"  data-toggle="modal" data-target="#messageModal" title="Ecrire un nouveau message">
    <i class="material-icons fab-icon">
        add
    </i>
</a>


@include('conversation.partials.new_message_modal')
@endsection
