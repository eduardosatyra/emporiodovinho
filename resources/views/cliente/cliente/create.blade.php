@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Novo Cliente</h3>
    </div>
</div>
{!!Form::open(array('url'=>'cliente/cliente','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
    <div class="panel panel-default" style="margin-left: 16px; width: 97%;">
        <div class="panel-heading">Dados Gerais</div>
        <div class="panel-body">
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" name="nome" required value="{{old('nome')}}" class="form-control" placeholder="Nome...">
                     @if ($errors->has('nome'))
                        <span class="text-danger">
                            {{ $errors->first('nome') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Tipo Documento</label>
                    <select name="tipo_documento" class="form-control tipo_documento">
                        <option value="CPF"> CPF </option>
                        <option value="RG">RG </option>
                    </select>   
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="num_doc">Número Documento</label>
                    <input type="text" name="num_doc" required value="{{old('num_doc')}}" class="form-control num_doc" placeholder="Número do Documento...">
                    @if ($errors->has('num_doc'))
                        <span class="text-danger">
                            {{ $errors->first('num_doc') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="telefone">Celular</label>
                    <input type="text" name="telefone" class="form-control  phone" placeholder="Telefone...">
                    @if ($errors->has('telefone'))
                        <span class="text-danger">
                            {{ $errors->first('telefone') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email"
                    class="form-control" placeholder="Email...">
                </div>
            </div>
        </div>
    </div>

</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">Salvar</button>
    <button class="btn btn-default"  onClick="history.go(-1)">Voltar</button>
</div>
{!!Form::close()!!}
@push('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.mask.min.js')}}"></script>

<script>
$(".tipo_documento").change(function() {
    var doc = $('.tipo_documento').val();
    if(doc == 'CPF'){
        $('.num_doc').mask('000.000.000-00', {reverse: true});
    }
    if(doc == 'RG'){
        $('.num_doc').mask('00.000.000-0', {reverse: true});
    }

});
</script>
@endpush
@stop