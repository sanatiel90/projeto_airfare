<?php
include_once('../model/class/Manager.class.php');
include_once('fpdf/fpdf.php');

//funcao para definir o local correto do fuso horario, para nao ficar as 3 horas a mais
date_default_timezone_set('America/Sao_Paulo');

$manager = new Manager();
$lista_voos = $manager->lista_voos(base64_decode($_GET['filter']),base64_decode($_GET['order']));

class PDF extends FPDF{
    //funcao q define o cabeçalho do rel
    function Header(){
        $this->SetFont('Arial','B',16);
        $this->Cell(45);
        $this->Cell(100,0,utf8_decode('Airfare - Relatório de Vôos Cadastrados'),10,0,'C');
        $this->Ln(10);
        $this->Cell(190,0,utf8_decode('Relatório emitido em '.date('d/m/Y H:i:s')),0,1,'C');
        $this->Ln(20);
    }
//funcao q define o rodape, com a pagina atual e data da emissão do pdf, do rel
    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
} // fim class

//criando novo obj de pdf
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->SetTitle("relatorio_voos");
//add uma pagina
$pdf->AddPage();
//defininido fonte
$pdf->SetFont('Arial','B',12);
//se dados_comprovante tiver um resultado cria o pdf de comprovante com os dados
if($lista_voos != null){
    foreach ($lista_voos as $key) {
        //cabeçalhos para dados do comprovante
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(10,1,utf8_decode('Cód.'),0,0,'C');
        $pdf->Cell(90,1,utf8_decode('Saída'),0,0,'C');
        $pdf->Cell(90,1,'Destino',0,0,'C');
        $pdf->Ln(4);
        //mostra dados do comprovante
        $pdf->SetFont('Times','',12);
        $pdf->Cell(10,10,$key['id'],1,0,'C');
        $pdf->Cell(90,10,utf8_decode($key["aeroporto_origem"].' - '.$key["cidade_origem"].' ('.$key["estado_origem"].')'),1,0,'C');
        $pdf->Cell(90,10,utf8_decode($key["aeroporto_destino"].' - '.$key["cidade_destino"].' ('.$key["estado_destino"].')'),1,0,'C');
        $pdf->Ln(15);
        //cabeçalhos para dados do rel
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(37,1,utf8_decode('Data Vôo'),0,0,'C');
        $pdf->Cell(37,1,'Companhia',0,0,'C');
        $pdf->Cell(32,1,utf8_decode('Preço') ,0,0,'C');
        $pdf->Cell(42,1,'Total Vagas',0,0,'C');
        $pdf->Cell(42,1,utf8_decode('Vagas disponíveis'),0,0,'C');
        $pdf->Ln(4);
        //mostra dados do comprovante
        $pdf->SetFont('Times','',12);
        $pdf->Cell(37,10,date("d/m/Y",strtotime($key['data_voo'])),1,0,'C');
        $pdf->Cell(37,10,$key['companhia'],1,0,'C');
        $pdf->Cell(32,10,'R$ '.$key['preco'],1,0,'C');
        $pdf->Cell(42,10,$key['total_vagas'],1,0,'C');
        $pdf->Cell(42,10,$key['vagas_disponiveis'],1,0,'C');
        $pdf->Ln(30);
    }
} else {
    //se lista voos estiver nulo mostra msg
    $pdf->Ln(5);
    $pdf->Cell(190,10,' '.utf8_decode('Não').' existem dados a serem mostrados',1,0,'C');
}
//mostra pdf
$pdf->Output();