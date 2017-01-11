<?php
include_once('../model/class/Manager.class.php');
include_once('fpdf/fpdf.php');

//funcao para definir o local correto do fuso horario, para nao ficar as 3 horas a mais
date_default_timezone_set('America/Sao_Paulo');

$manager = new Manager();
$dados_comprovante = $manager->dados_comprovante($_GET['id']);

class PDF extends FPDF{
    //funcao q define o cabeçalho do rel
    function Header(){
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(45);
        $this->Cell(110, 0, 'Airfare - Comprovante de compra de passagem', 10, 0, 'C');
        $this->Ln(20);
    }

//funcao q define o rodape, com a pagina atual e data da emissão do pdf, do rel
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(190,0,'Comprovante emitido em '.date('d/m/Y H:i:s'),0,1,'C');
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
} // fim class

//criando novo obj de pdf
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->SetTitle("comprovante_compra");
//add uma pagina
$pdf->AddPage();
//defininido fonte
$pdf->SetFont('Arial','B',12);
//se dados_comprovante tiver um resultado cria o pdf de comprovante com os dados
if ($dados_comprovante != null) {
    //mostra nome do comprador
    foreach ($dados_comprovante as $key) {
        $pdf->Cell(38,1,'Nome Comprador:',0,0,'C');
        $pdf->SetFont('Times','',14);
        $pdf->Cell(30,1,$key["nome_cli"],0,0,'C');
        $pdf->Ln(12);
    }
    //cabeçalhos para dados do comprovante
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(12,1,utf8_decode('Cód.'),0,0,'C');
    $pdf->Cell(60,1,'Data/Hora da Compra',0,0,'C');
    $pdf->Cell(40,1,utf8_decode('Nº Passagens'),0,0,'C');
    $pdf->Cell(35,1,utf8_decode('Preço Total') ,0,0,'C');
    $pdf->Ln(3);
    //mostra dados do comprovante
    $pdf->SetFont('Times','',12);
    foreach ($dados_comprovante as $key) {
        $pdf->Cell(12,10,$key['id_pedido'],1,0,'C');
        $pdf->Cell(60,10,date("d/m/Y H:i:s",strtotime($key['data_pedido'])),1,0,'C');
        $pdf->Cell(40,10,$key['quantidade_pessoas'],1,0,'C');
        $pdf->Cell(35,10,'R$ '.$key['preco_total'],1,0,'C');
        $pdf->Ln(10);
    }
    //cabeçalhos para dados do comprovante
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,1,utf8_decode('Data Vôo'),0,0,'C');
    $pdf->Cell(35,1,utf8_decode('Hora Saída'),0,0,'C');
    $pdf->Cell(35,1,utf8_decode('Hora Chegada') ,0,0,'C');
    $pdf->Cell(37,1,utf8_decode('Companhia') ,0,1,'C');
    $pdf->Ln(3);
    //mostra dados do comprovante
    $pdf->SetFont('Times','',12);
    foreach ($dados_comprovante as $key) {
        $pdf->Cell(40,10,date("d/m/Y",strtotime($key['data_voo'])),1,0,'C');
        $pdf->Cell(35,10,$key['hora_saida'],1,0,'C');
        $pdf->Cell(35,10,$key['hora_chegada'],1,0,'C');
        $pdf->Cell(37,10,$key['companhia'],1,1,'C');
        $pdf->Ln(10);
    }
    //cabeçalhos para dados do comprovante
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(89,1,utf8_decode('Saída'),0,0,'C');
    $pdf->Cell(89,1,utf8_decode('Destino'),0,0,'C');
    $pdf->Ln(3);
    //mostra dados do comprovante
    $pdf->SetFont('Times','',12);
    foreach ($dados_comprovante as $key) {
        $pdf->Cell(89,10,$key['aeroporto_origem'].' - '.$key['cidade_origem'].'/'.$key['estado_origem'],1,0,'C');
        $pdf->Cell(89,10,$key['aeroporto_destino'].' - '.$key['cidade_destino'].'/'.$key['estado_destino'],1,0,'C');
        $pdf->Ln(10);
    }
} else {
    //se dados comprovante estiver nulo mostra msg
    $pdf->Ln(5);
    $pdf->Cell(190,10,' '.utf8_decode('Não').' existem dados a serem mostrados',1,0,'C');
}
//mostra pdf
$pdf->Output();