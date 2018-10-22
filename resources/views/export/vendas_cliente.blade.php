<?php
$arquivo = 'planilha.xls';
// Criamos uma tabela HTML com o formato da planilha
$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<th>Cliente</th>';
$html .= '<th>Tipo Pagamento</th>';
$html .= '<th>Data e Hora</th>';
$html .= '<th>Total da Venda</th>';
$html .= '</tr>';
$html .= '</table>';

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=teste.xls" );
header ("Content-Description: PHP Generated Data" );

echo $html;
exit;

?>
