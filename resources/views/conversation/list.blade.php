@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">

                <h4 class="card-header">Mes conversations</h4>

                <div class="card-body table-responsive text-center">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th>Nom</th>
                                <th>Participants</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($conversations->isEmpty())
                                <tr>
                                    <td colspan="3">Vous ne participez encore à aucune discussion.</td>
                                </tr>
                                @else
                                    @foreach($conversations as $conversation)
                                        <tr>
                                            <td>{{ decrypt($conversation->name) }}</td>

                                            <td>
                                                @foreach( $conversation->users as $user )
                                                    {{ $user->email.' ' }}
                                                @endforeach
                                            </td>
                                            <td><a href="{{ route('conversation.findConversationById', ['id' => $conversation->id]) }}" class="btn btn-success text-white" title="Entrer">
                                                <i class="material-icons">
                                                    forward
                                                </i></a>
                                                <form action={{ route('conversation.delete', ['id' => $conversation->id]) }} method="post" style="display: inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="material-icons">
                                                            close
                                                        </i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                </div>
            </div>

        </div>

    </div>

</div>
<a href="{{ route('conversation.index') }}" class="btn btn-success text-white fab" title="Démarrer une nouvelle conversation"><i class="material-icons fab-icon">
        add
    </i></a>
@endsection
