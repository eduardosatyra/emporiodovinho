@extends('layouts.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Nova Saida</h3>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
{!!Form::open(array('url'=>'estoque/saida','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="nome">Produto</label>
                    <select name="p_id_produto" id="p_id_produto" class="form-control selectpicker" data-live-search="true">
                        <option value="selecione">Selecione um produto..</option>
                        @foreach($produtos as $pro)
                        <option value="{{$pro->id_produto}}_{{$pro->estoque}}"">
                            {{$pro->nome}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                <div class="form-group">
                    <label for="num_doc">Estoque Atual</label>                            
                    <input type="text" readonly="true" id="estoque_atual" class="form-control" value="">
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                <div class="form-group">
                    <label for="num_doc">Quantidade</label>
                    <input type="number" name="quantidade" value="{{old('quantidade')}}" 
                    id="p_quantidade"
                    class="form-control" placeholder="Quantidade...">
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                <div class="form-group">
                    <label for="num_doc">Motivo</label>
                    <input type="text" name="motivo" value="{{old('motivo')}}" 
                    id="motivo"
                    class="form-control" placeholder="Motivo...">
                </div>
            </div>            
            <div class="col-lg-2 col-sm-2 col-md-2  col-xs-12">
                <div class="form-group">
                    <button type="button" id="bt_add"
                    class="btn btn-primary" style="margin-top: 24px;">
                    Adicionar
                </button>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12  col-xs-12">
            <table id="detalhes" class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color:#A9D0F5">
                    <th>Opções</th>
                    <th>Produtos</th>
                    <th>Quantidade</th>
                    <th>Motivo</th>                    
                </thead>                
            </table>
        </div>
    </div>
</div>
<div class="col-lg-12 col-sm-12 col-md-12  col-xs-12" id="salvar" style="display: none;">
    <div class="form-group">
        <input name="_token" value="{{ csrf_token() }}"
        type="hidden">
        <button class="btn btn-primary" id="salvar" type="submit">Salvar</button>
        <button class="btn btn-danger" type="reset">Cancelar</button>
    </div>
</div>
</div>	
{!!Form::close()!!}		
@push('scripts')
<script>
    $("#p_id_produto").change(mostrarValores);
    $(document).ready(function(){
        $('#bt_add').click(function(){
            adicionar();
        });
    });
    var total=0;
    var cont=0;
    $("#salvar").hide();
    function adicionar(){
        dadosProdutos = document.getElementById("p_id_produto").value.split('_');
        id_produto=dadosProdutos[0];        
        produto=$("#p_id_produto option:selected").text();
        quantidade=$("#p_quantidade").val();
        motivo=$("#motivo").val();
        estoque=$("#estoque_atual").val();
        if(id_produto!="" && quantidade!="" && quantidade>0 && motivo!=""){
            if(estoque >= quantidade){
                var linha = '<tr class="selected" id="linha'+cont+'">    <td> <button type="button" class="btn btn-warning" onclick="apagar('+cont+');"> X </button></td>      <td> <input type="hidden" name="id_produto[]" value="'+id_produto+'">'+produto+'</td>             <td> <input type="number" name="quantidade[]" value="'+quantidade+'"></td>                       <td> <input type="text" name="motivo[]" value="'+motivo+'"></td></tr>'
                cont++;
                total++;
                ocultar();
                limpar();
                $('#detalhes').append(linha);
            }else{
                alert("A quantidade de saida não pode ser maior que o estoque.");
            }
        }else{
            alert("Erro ao inserir os detalhes, preencha os campos corretamente!!");
        }
    }
    function limpar(){
        $("#p_quantidade").val("");
        $("#motivo").val("");
    }
    function ocultar(){
        if(total>0){
            $("#salvar").show();
        } else{
            $("#salvar").hide();
        }
    }
    function apagar(index){       
        $("#linha" + index).remove();
        total--;
        ocultar();
    }
    function mostrarValores(){
        dadosProdutos = document.getElementById("p_id_produto").value.split('_');
        $("#estoque_atual").val(dadosProdutos[1]);
    }
</script>
@endpush
@stop