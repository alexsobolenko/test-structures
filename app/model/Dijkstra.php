<?php

declare(strict_types=1);

namespace App\Model;

class Dijkstra
{
    private const INFINITY = 1e19;

    /**
     * @var Graph
     */
    private Graph $graph;

    /**
     * @var array
     */
    private array $used;

    /**
     * @var array
     */
    private array $esum;

    /**
     * @var array
     */
    private array $path;

    /**
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
            $path = sprintf("%s%s", $toNode, $path);

        }

        return $path;
    }
}
