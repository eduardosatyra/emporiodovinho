<table>
	<tr>
		<th>Cliente</th>
		<th>Tipo Pagamento</th>
		<th>Data e Hora</th>
		<th>Total da Venda</th>
	</tr>
	@foreach ($data as $ven)
		<tr>
			<td>$ven->nome</td>
			<td>$ven->tipo_pagamento</td>
			<td>$ven->data_hora</td>
			<td>$ven->total_venda</td>
		</tr>
	@endforeach
</table>