<?php

declare(strict_types=1);

namespace App\Model;

class Walker
{
    /**
     * @var Graph
     */
    private Graph $graph;

    /**
     * @param Graph $graph
     */
    public function __construct(Graph $graph)
    {
        $this->graph = $graph;
        $this->path = [];
    }

    /**
     * @param string $node
     * @param Sequence $sequence
     * @return array
     */
    public function walk(string $node, Sequence $sequence): array
    {
        $path = [];
        $sequence->put($node);
        while (!$sequence->isEmpty()) {
            $curr = $sequence->get();
            $path[$curr] = true;
            foreach ($this->graph->getEdges($curr) as $next => $length) {
                if (!isset($path[$next])) {
                    if (!$sequence->contains($next)) {
                        $sequence->put($next);
                    }
                }
            }

            $this->show($path, $sequence);
        }

        return $path;
    }

    /**
     * @param array $path
     * @param Sequence $sequence
     */
    public function show(array $path, Sequence $sequence): void
    {
        for ($x = 0; $x < 8; $x++) {
            for ($y = 0; $y < 8; $y++) {
                $value = strval($x) . strval($y);
                if (isset($path[$value])) {
                    echo $value . ' ';
                } elseif ($sequence->contains($value)) {
                    echo '++  ';
                } else {
                    echo '--  ';
                }
            }

            echo '<br>';
        }

        echo '<br>';

        foreach ($sequence->getList() as $item) {
            echo $item . ' ';
        }

        echo '<br><br>';
    }
}
