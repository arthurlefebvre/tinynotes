
<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert-primary">
                <h5 class="modal-title" id="messageModalLabel">Ecrivez un nouveau message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="width:70%;margin:auto;">
                <form action="{{ route('conversation.addMessage', ['id' => $conversation->id]) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea id="message" style="text-align: center;" rows="10" cols="70" class="form-control" required name="message" placeholder="Votre message"></textarea>
                        </div>

                        <div class="form-group">
                                <select id="color_id" class="form-control" name="color_id" placeholder="Choisissez une couleur de fond">
                                        @foreach($colors as $color)
                                          <option value="{{$color->id}}" style="background-color: {{ $color->color_code }}">{{$color->name}}</option>
                                        @endforeach
                                      </select>
                              </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
