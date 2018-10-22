@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Novo Usuário</h3>
        {!!Form::open(array('url'=>'usuario/usuario','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}
        <div class="panel panel-default">
            <div class="panel-heading">Dados do usuário</div>
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Nome</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                        <span class="text-danger">
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                        <span class="text-danger">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Senha</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                        <span class="text-danger">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirmar senha</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Salvar</button>
                <button class="btn btn-default"  onClick="history.go(-1)">Voltar</button>
            </div>
        </div>

        {!!Form::close()!!}		

    </div>
</div>
@stop