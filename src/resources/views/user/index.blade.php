@extends('layout.default')

@section('content')

<div class="page-header">
    <h2>Usuários</h2>
</div>

@if (session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Ops!</strong> {{ session('error') }}
    </div>
@endif

<div class="row form-group">
    <div class="col-md-12">
        <a href="{{ route('users.create') }}" class="btn btn-primary pull-right open-modal" data-toggle="modal" data-target="#formModal">Novo</a>
    </div>
</div>

<div class="row form-group">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 25%;">Nome</th>
                    <th style="width: 50%;">CEP</th>
                    <th style="width: 25%;" class="text-center">Opções</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) >= 1)
                    @foreach ($users as $user)
                        <tr>
                            <td style="width: 25%; vertical-align: middle;">{{ $user->nome }} {{ $user->sobrenome }}</td>
                            <td style="width: 50%; vertical-align: middle;">{{ substr($user->cep, 0, 5) }}-{{ substr($user->cep, -3) }}</td>
                            <td class="text-right" style="width: 25%;">
                                <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">Detalhes</a>
                                <a href="{{ route('users.edit', ['id' => $user->id]) }}"class="btn btn-info btn-sm open-modal" title="Alterar" data-toggle="modal" data-target="#formModal">Alterar</a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal" data-whatever="{{ $user->id }}">Excluir</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center"><strong>Nenhum usuário cadatrado</strong></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="text-center">
    {{ $users->links() }}
</div>

<!-- Modal que exibe o formulário de Cadastro/Alteração de usuário -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content"></div>
    </div>
</div>

<!-- Modal para exibir dialógo se confirma exclusão de usuário -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Confirmar</h4>
            </div>

            <div class="modal-body">
                Você tem certeza que deseja continuar?
            </div>

            <div class="modal-footer">
                <input type="hidden" id="user_id" value="" /> <!-- Campo onde será incluído o id do usuário que se deseja exclir -->
                <button type="button" class="btn btn-default cancelar" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary excluir">Sim</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        // Request AJAX para salvar/alterar um usuário
        $('body').on('click', '.salvar', function(){
            $('.salvar').addClass('disabled').html('Aguarde...');

            $.ajax({
                'url': '/users/store',
                'method': 'post',
                'data': $('#form').serialize(),
                'dataType': 'json',
                'success': function(response){
                    if (response.status_error === false){
                        window.location.href="/users/show/" + response.user.id;
                    }
                },
                'error': function(err){
                    $('.salvar').removeClass('disabled').html('Salvar');
                    
                    if (err.status == 422){
                        var errors = $.parseJSON(err.responseText);
                        $.each(errors, function(k, v){
                            $('.' + k + '_error').removeClass('hide').html(v);
                        })
                    }
                }
            })
        })

        
        // Request AJAX para excluir usuário
        $('body').on('click', '.excluir', function(){
            userId = $('input#user_id').val();

            $('.excluir').addClass('disabled').html('Aguarde...');
            $('.cancelar').addClass('hide');

            $.ajax({
                'url': '/users/delete/' + userId,
                'method': 'get',
                'dataType': 'json',
                'success': function(response){
                    $('.excluir').addClass('hide');

                    if (response.status_error === false){
                        $('.modal-body').html('<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Usuário excluído com sucesso!</div>');
                    } else {
                        $('.modal-body').html('<div class="alert alert-danger" role="alert"><strong>Ops!</strong> ' + response.error + '</div>');
                    }
                },
                'error': function(err){
                    var errors = $.parseJSON(err.responseText);
                    $('.modal-body').html('<div class="alert alert-danger" role="alert"><strong>Ops!</strong> ' + errors.message + '</div>');
                }
            })
        })

        
        // Request AJAX para buscar o CEP
        $('body').on('blur', '#cep', function(){
            var cep = $('#cep').val();

            if (cep.length == 8){
                $('.cep_error').addClass('hide').html('');
                $('.depends_cep').attr('disabled', true);

                $.ajax({
                    'url': '/api/cep/' + cep,
                    'method': 'get',
                    'dataType': 'json',
                    'success': function(response){
                        $('.depends_cep').attr('disabled', false);
                        
                        if (response.status_error === true){
                            $('.cep_error').removeClass('hide').html('*CEP inváido!');
                        } else {
                            $('#logradouro').val(response.cep.logradouro).focus();
                            $('#bairro').val(response.cep.bairro);
                            $('#cidade').val(response.cep.localidade);
                            $('#UF').val(response.cep.uf);
                        }
                    },
                    'error': function(err){
                        var errors = $.parseJSON(err.responseText);
                        $('.cep_error').removeClass('hide').html(errors.message);
                        $('.depends_cep').attr('disabled', false);
                    }
                })

            } else {
                $('.cep_error').removeClass('hide').html('*CEP informado inváido!');
            }
        })


        // atualiza a pagina parent quando o modal de cadastro/alteração fecha
        $('#formModal').on('hidden.bs.modal', function (e) {
            location.reload();
        })


        // pega o ID do usuário que se deseja excluir para passá-lo no modal
        $('#confirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var userId = button.data('whatever')

            $('input#user_id').val(userId)
        })


        // atualiza a pagina parent qdo o registro é excluído e o modal fechado
        $('#confirmModal').on('hidden.bs.modal', function (e) {
            location.reload();
        })
    })
</script>
@endsection