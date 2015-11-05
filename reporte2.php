<?php
require('fpdf.php');
require('conexion.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('logo_pb.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    //$this->Cell(30,10,'Title',1,0,'C');
    $this->Cell(70);
    $this->SetFont('Arial','',9);
    $this->Cell(50,10,'Fecha: '.date('d-m-Y').'',0);
    $this->Ln(5);
    $this->Cell(150);
    $this->Cell(50,10,'Operador: Cuzziol');
    $this->Ln(10);
    $this->Cell(45);
    //setea fuente de titulo
    $this->SetFont('Arial','B',15);
    $this->Cell(100,10,'Lista de Madres Donantes desde: 01/10/2015 Fecha hasta: 01/11/2015',0,0,'C');

    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//cabecera de tabla
$pdf->SetFont('Times','',8);
$pdf->Cell(15,8,'Donante',1,0,'C');
$pdf->Cell(25,8,'Apellido',1,0,'C');
$pdf->Cell(30,8,'Nombre',1,0,'C');
$pdf->Cell(15,8,'DNI',1,0,'C');
$pdf->Cell(20,8,'Cant de frascos',1,0,'C');
$pdf->Cell(27,8,'Cant de leche donada',1,0,'C');
$pdf->Cell(23,8,'Cant de donaciones',1,0,'C');
$pdf->Cell(20,8,'F Inicio de Cons',1,0,'C');
$pdf->Cell(20,8,'F Fin de Cons',1,0,'C');
$pdf->Ln(8);
//fin cabecera de tabla

$consulta = mysql_query("SELECT *
FROM consentimiento c, donante d
WHERE c.Donante_nroDonante = d.nroDonante AND (c.fechaHasta BETWEEN '2015-10-1' AND '2015-11-1')

UNION

SELECT *
FROM consentimiento c, donante d
WHERE c.Donante_nroDonante = d.nroDonante AND c.fechaHasta IS NULL");

while($fila = mysql_fetch_array($consulta)){
    $pdf->Cell(15,8,$fila['nroDonante'],1,0,'C');
    $pdf->Cell(25,8,$fila['apellido'],1,0,'C');
    $pdf->Cell(30,8,$fila['nombre'],1,0,'C');
    $pdf->Cell(15,8,$fila['dniDonante'],1,0,'C');
    $pdf->Cell(20,8,'',1,0,'C');
    $pdf->Cell(27,8,'',1,0,'C');
    $pdf->Cell(23,8,'',1,0,'C');
    $pdf->Cell(20,8,$fila['fechaDesde'],1,0,'C');
    $pdf->Cell(20,8,$fila['fechaHasta'],1,0,'C');
    $pdf->Ln(8);
}

//TOTALES
$pdf->SetFont('Times','B',12);
//consulta
$consulta = mysql_query("SELECT COUNT(*) as Num FROM consentimiento WHERE fechaHasta IS NULL");
$consulta = mysql_fetch_array($consulta);
$pdf->Cell(75,10,'Madres activas',1,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(70,10,$consulta['Num'],1,1,'C');

$consulta = mysql_query("SELECT COUNT(*) as Num FROM `consentimiento` WHERE fechaHasta BETWEEN '2015-10-1' AND '2015-11-1'");
$consulta = mysql_fetch_array($consulta);
$pdf->SetFont('Times','B',12);
$pdf->Cell(75,10,'Madres que pasan a estado inactivo',1,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(70,10,$consulta[0],1,1,'C');

$pdf->SetFont('Times','B',12);
$pdf->Cell(75,10,'Total de frascos',1,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(70,10,'',1,1,'C');

$pdf->SetFont('Times','B',12);
$pdf->Cell(75,10,'Cantidad de leche donada',1,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(70,10,'',1,1,'C');

$consulta = mysql_query("SELECT COUNT(*) as Num FROM `consentimiento` WHERE fechaDesde BETWEEN '2015-10-1' AND '2015-11-1'");
$consulta = mysql_fetch_array($consulta);
$pdf->SetFont('Times','B',12);
$pdf->Cell(75,10,'Nuevos consentimientos',1,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(70,10,$consulta[0],1,1,'C');

$pdf->SetFont('Times','B',12);
$pdf->Cell(75,10,'Nuevas madres donantes ',1,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(70,10,'',1,1,'C');



//contenido de tabla



//fin contenido de tabla


/*for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
    */
$pdf->Output();
?>