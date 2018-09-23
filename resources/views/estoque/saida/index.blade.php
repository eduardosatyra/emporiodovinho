@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Saidas <a href="saida/create"><button class="btn btn-success">Novo</button></a></h3>
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
					<td>{{ $sai->data_hora}}</td>
					<td>{{ $sai->name}}</td>
					<td>					
						<a href="{{URL::action('SaidaController@show',$sai->id_saida)}}"><button class="btn btn-info">Detalhes</button></a>
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