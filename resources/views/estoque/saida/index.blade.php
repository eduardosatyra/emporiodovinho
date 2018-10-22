@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Lista de Saidas</h3>
		<a href="saida/create" class="btn btn-success" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-plus-sign"></i> Adicionar saída</a>
		@include('estoque.saida.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Cód</th>
					<th>Cadastrado em</th>
					<th>Cadastrado por</th>
					<th>Opções</th>
				</thead>
				@foreach ($saidas as $sai)
				<tr>
					<td>{{ $sai->id_saida}}</td>
					<td><?php echo date('d/m/Y H:i:s', strtotime($sai->data_hora)); ?></td>					
					<td>{{ $sai->name}}</td>
					<td>
						<a href="{{URL::action('SaidaController@show',$sai->id_saida)}}" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Visualizar"><span class="glyphicon glyphicon-search"></span></a>
					</td>
				</tr>
				@include('estoque.saida.modal')
				@endforeach
			</table>
		</div>
		{{$saidas->render()}}
	</div>
</div>
@stop