@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-sm-6 col-xs-6">
		<div class="form-group">
			<label for="nome">Cadastrado por:</label>
			<p>{{$saida->name}}</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-primary" style="margin-left: 16px; width: 97%;">
		<div class="panel-body">
			<div class="col-lg-12 col-sm-12 col-md-12  col-xs-12">
				<table id="detalhes" class="table table-striped table-bordered table-condensed table-hover">
					<thead style="background-color:#A9D0F5">                    	
                    	<th>Produtos</th>
                    	<th>Quantidade</th>
                    	<th>Motivo</th>        
						<th>Cadastrado em</th>                    
                	</thead> 					
					<tbody>
						@foreach($detalhes as $det)
						<tr>
							<td>{{$det->nome}}</td>
							<td>{{$det->quantidade}}</td>
							<td>{{$det->motivo}}</td>
							<td><?php echo date('d/m/Y H:i:s', strtotime($saida->data_hora)); ?></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop