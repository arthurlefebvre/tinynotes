@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h1>{{ decrypt($conversation->name) }}</h1>
        </div>
    </div>
        @if($messages->isEmpty())
            <p>Pas de message à afficher. Ecrivez-en un !</p>
        @else
            @foreach ($messages as $message)
                <div data-id="{{$message->id}}" data-conversation="{{ $conversation->id }}" class="postit draggable resizable ui-widget-content"
                style="position:absolute;
                        background-color: {{$message->color->color_code}};
                        left: {{$message->left}};
                        top: {{$message->top}};
                        width:{{$message->width}};
                        height:{{$message->height}};
                        z-index: {{$message->zIndex}};">{{ decrypt($message->message) }}</div>
            @endforeach
        @endif
</div>

<div id="trash-can" class="ui-widget-header">
    <img src="/trash.svg" width="100" height="100" class="mr-3" alt="logo"/>
</div>
<a class="btn btn-primary fab text-white"  data-toggle="modal" data-target="#messageModal" title="Ecrire un nouveau message">
    <i class="material-icons fab-icon">
        add
    </i>
</a>



@include('conversation.partials.new_message_modal')
@endsection
