<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="exampleModalLabel"><?php echo (isset($user) ? 'Alterar Usuário #' . $user->id : 'Cadastrar Usuário'); ?></h4>
</div>

<div class="modal-body">
    <form id="form">
        {{ csrf_field() }}
        @if (isset($user))
            <input type="hidden" name="id" value="{{ $user->id }}" />
        @endif
        <div class="form-group">
            <label for="nome" class="control-label">Nome:</label>
            <input type="text"  class="form-control" name="nome" id="nome" value="<?php echo (isset($user->nome) ? $user->nome : ''); ?>" />
            <small class="text-danger hide nome_error"></small>
        </div>

        <div class="form-group">
            <label for="sobrenome">Sobrenome:</label>
            <input type="text"  class="form-control" name="sobrenome" id="sobrenome" value="<?php echo (isset($user->sobrenome) ? $user->sobrenome : ''); ?>" />
            <small class="text-danger hide sobrenome_error"></small>
        </div>

        <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text"  class="form-control" name="cep" id="cep" value="<?php echo (isset($user->cep) ? $user->cep : ''); ?>" maxlength="8" />
            <small class="text-danger hide cep_error"></small>
        </div>
        
        <div class="form-group">
            <label for="logradouro">Logradouro:</label>
            <input type="text"  class="form-control depends_cep" name="logradouro" id="logradouro" value="<?php echo (isset($user->logradouro) ? $user->logradouro : ''); ?>" />
            <small class="text-danger hide logradouro_error"></small>
        </div>

        <div class="form-group">
            <label for="complemento">Complemento:</label>
            <input type="text"  class="form-control" name="complemento" id="complemento" value="<?php echo (isset($user->complemento) ? $user->complemento : ''); ?>" />
            <small class="text-danger hide complemento_error"></small>
        </div>

        <div class="form-group">
            <label for="bairro">Bairro:</label>
            <input type="text"  class="form-control depends_cep" name="bairro" id="bairro" value="<?php echo (isset($user->bairro) ? $user->bairro : ''); ?>" />
            <small class="text-danger hide bairro_error"></small>
        </div>

        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text"  class="form-control depends_cep" name="cidade" id="cidade" value="<?php echo (isset($user->cidade) ? $user->cidade : ''); ?>" />
            <small class="text-danger hide cidade_error"></small>
        </div>

        <div class="form-group">
            <label for="UF">UF:</label>
            <input type="text"  class="form-control depends_cep" name="uf" id="UF" value="<?php echo (isset($user->uf) ? $user->uf : ''); ?>" />
            <small class="text-danger hide uf_error"></small>
        </div>

    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-primary salvar">Salvar</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
</div>