<div class="modal fade"  id="modal-cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    {{Form::Open(array('action'=>array('ClienteController@store'),'method'=>'post'))}}
    {{Form::token()}}
    <div class="modal-dialog" role="document">
        <button type="button" class="close" style="margin-top: 5px; margin-right: 10px;" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>  
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
                        <input type="text" name="email"
                        class="form-control" placeholder="Email...">
                    </div>
                </div>
            </div>
            <input type="hidden" name="venda" value="null">
            <div class="form-group" style="margin-left: 30px;">
                <button class="btn btn-primary" type="submit">Salvar</button>
                <button class="btn btn-default"  onClick="history.go(-1)">Voltar</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}
</div>


