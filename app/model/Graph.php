<?php

namespace App\Model;

class Graph
{
    /** @var array */
    private $edges;
    // матрица смежности вершин
    // $edges['A']['B'] = 12;  - длина
    // $edges['B']['A'] = 12;

    public function __construct()
    {
        $this->edges = [];
    }

    /**
     * @param string $node
     */
    public function addNode(string $node): void
    {
        $this->edges[$node] = [];
    }

    /**
     * @param string $node1
     * @param string $node2
     * @param float $length
     */
    public function addEdge(string $node1, string $node2, float $length): void
    {
        $this->edges[$node1][$node2] = $length;
        $this->edges[$node2][$node1] = $length;
    }

    /**
     * @return iterable
     */
    public function getNodes(): iterable
    {
        foreach ($this->edges as $node => $edge) {
            yield $node;
        }
    }

    /**
     * @param string $node1
     * @return iterable
     */
    public function getEdges(string $node1): iterable
    {
        foreach ($this->edges[$node1] as $node2 => $edge) {
            yield $node2 => $edge;
        }
    }
}
