<hr>
<table class="table table-bordered">
    <thead>
        <tr>
        <th>Avatar</th>
        <th>Email</th>
        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if($user == null)
            <tr >
                <td colspan="3">Aucun élement ne correspond à la recherche</td>
            </tr>
        @else
            <tr >
                @if($user->avatar)
                    <td>
                        <img src="{{ $user->avatar }}" class="rounded-circle" alt="avatar" width="32" height="32" style="margin-right: 8px;">
                    </td>
                @else
                    <td>
                        <i class="material-icons md-48" style="margin-right: 8px;">
                            account_circle
                        </i>
                    </td>
                @endif
                <td>{{ $user->email }}</td>
                <td>
                    <button name="addUserToConversationButton" type="button" class="btn btn-success" data-id="{{$user->id}}" data-toggle="modal" data-target="#conversationNameModal" title="Démarrer une discussion">
                        <i class="material-icons">
                            edit
                        </i>
                    </button>
                </td>
            </tr>
        @endif
    </tbody>
</table>


@include('conversation.partials.new_conversation_modal')
