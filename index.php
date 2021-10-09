<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use App\Model\Dijkstra;
use App\Model\Graph;

require_once 'vendor/autoload.php';

$graph = new Graph();
$graph->addNode('A');
$graph->addNode('B');
$graph->addNode('C');
$graph->addNode('D');
$graph->addNode('E');
$graph->addNode('F');
$graph->addNode('G');
$graph->addEdge('A', 'B', 2);
$graph->addEdge('A', 'C', 3);
$graph->addEdge('A', 'D', 6);
$graph->addEdge('B', 'C', 4);
$graph->addEdge('B', 'E', 9);
$graph->addEdge('C', 'D', 1);
$graph->addEdge('C', 'E', 7);
$graph->addEdge('C', 'F', 6);
$graph->addEdge('D', 'F', 4);
$graph->addEdge('E', 'F', 1);
$graph->addEdge('E', 'G', 5);
$graph->addEdge('F', 'G', 8);

$dijkstra = new Dijkstra($graph);
echo $dijkstra->getShortestPath('G', 'A');
