@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Novo Fornecedor</h3>
    </div>
</div>
{!!Form::open(array('url'=>'fornecedor/fornecedor','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
    <div class="panel panel-default" style="margin-left: 16px; width: 97%;">
        <div class="panel-heading">Dados do fornecedor</div>
        <div class="panel-body">
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="nome">Nome</label>
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
                    <input type="text" name="telefone" class="form-control phone" value="{{old('telefone')}}" placeholder="Telefone...">
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
                    <input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="Email...">
                    @if ($errors->has('email'))
                        <span class="text-danger">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="Ativo"> ATIVO </option>
                        <option value="Inativo">INATIVO </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default" style="margin-left: 16px; width: 97%;">
        <div class="panel-heading">Endereço</div>
        <div class="panel-body">
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" value="{{old('cep')}}" class="form-control cep" placeholder="CEP...">
                    @if ($errors->has('cep'))
                        <span class="text-danger">
                            {{ $errors->first('cep') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco"  value="{{old('endereco')}}" class="form-control" placeholder="Endereço...">
                    @if ($errors->has('endereco'))
                        <span class="text-danger">
                            {{ $errors->first('endereco') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="numero">Número</label>
                    <input type="text" name="numero"  value="{{old('numero')}}" class="form-control" placeholder="Número...">
                    @if ($errors->has('numero'))
                        <span class="text-danger">
                            {{ $errors->first('numero') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro"  value="{{old('bairro')}}" class="form-control" placeholder="Bairro...">
                    @if ($errors->has('bairro'))
                        <span class="text-danger">
                            {{ $errors->first('bairro') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade"  value="{{old('cidade')}}" class="form-control" placeholder="Cidade...">
                    @if ($errors->has('cidade'))
                        <span class="text-danger">
                            {{ $errors->first('cidade') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-control">
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>                        
                    </select>                    
                    @if ($errors->has('estado'))
                        <span class="text-danger">
                            {{ $errors->first('estado') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="complemento">Complemento</label>
                    <input type="text" name="complemento"  value="{{old('complemento')}}" class="form-control" placeholder="Complemento...">
                    @if ($errors->has('complemento'))
                        <span class="text-danger">
                            {{ $errors->first('complemento') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">Salvar</button>
    <button class="btn btn-danger" type="reset">Cancelar</button>
</div>
{!!Form::close()!!}

@push('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
$(".tipo_documento").change(function() {
    var doc = $('.tipo_documento').val();
    if(doc == 'CPF'){
        $('.num_doc').mask('000.000.000-00', {reverse: true}); 
    }
    $('.num_doc').mask('00.000.000-0', {reverse: true}); 

    
});
</script>
@endpush
@stop