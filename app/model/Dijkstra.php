<?php

namespace App\Model;

class Dijkstra
{
    private const INFINITY = 1e19;

    /** @var Graph */
    private $graph;

    /** @var array */
    private $used;

    /** @var array */
    private $esum;

    /** @var array */
    private $path;

    /**
     * Dijkstra constructor.
     * @param Graph $graph
     */
    public function __construct(Graph $graph)
    {
        $this->graph = $graph;
        $this->used = [];
        $this->esum = [];
        $this->path = [];
    }

    /**
     * @param string $fromNode
     * @param string $toNode
     * @return string
     */
    public function getShortestPath(string $fromNode, string $toNode): string
    {
        $this->init();
        $this->esum[$fromNode] = 0;
        while ($currNode = $this->findNearestUnusedNode()) {
            $this->setEsumToNextNodes($currNode);
        }
        return $this->restorePath($fromNode, $toNode);
    }

    /**
     *  Initialization
     */
    public function init(): void
    {
        foreach ($this->graph->getNodes() as $node) {
            $this->used[$node] = false;
            $this->esum[$node] = self::INFINITY;
            $this->path[$node] = '';
        }
    }

    /**
     * @return string
     */
    public function findNearestUnusedNode(): string
    {
        $nearestNode = '';
        foreach ($this->graph->getNodes() as $node) {
            if (!$this->used[$node]) {
                if ($nearestNode == '' || ($this->esum[$node] < $this->esum[$nearestNode])) {
                    $nearestNode = $node;
                }
            }
        }
        return $nearestNode;
    }

    /**
     * @param string $currNode
     */
    public function setEsumToNextNodes(string $currNode): void
    {
        $this->used[$currNode] = true;
        foreach ($this->graph->getEdges($currNode) as $nextNode => $length) {
            if (!$this->used[$nextNode]) {
                $newEsum = $this->esum[$currNode] + $length;
                if ($newEsum < $this->esum[$nextNode]) {
                    $this->esum[$nextNode] = $newEsum;
                    $this->path[$nextNode] = $currNode;
                }
            }
        }
    }

    /**
     * @param string $fromNode
     * @param string $toNode
     * @return string
     */
    public function restorePath(string $fromNode, string $toNode): string
    {
        $path = $toNode;
        while ($toNode !== $fromNode) {
            $toNode = $this->path[$toNode];
            $path = $toNode.$path;
        }
        return $path;
    }

}