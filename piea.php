<?php 
    include "config.php";
    session_start();
    require_once ('jpgraph/jpgraph.php');
    require_once ('jpgraph/jpgraph_pie.php');
    $data = array($_GET['pr'],100-$_GET['pr']);
    $graph = new PieGraph(630,630);
    //$theme_class="DefaultTheme";
    //$graph->SetBox(true);
    $graph->title->Set($_GET['title']);
    $p1 = new PiePlot($data);
    $graph->Add($p1);
    //$p1->ShowBorder();
    $p1->SetColor('green');
    $p1->SetSliceColors(array('green','red'));
    $graph->Stroke();

 ?>
