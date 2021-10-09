<?php

declare(strict_types=1);

namespace App\Model;

class Queue extends Sequence
{
    /**
     * @var Node
     */
    private Node $head;

    /**
     * @var Node
     */
    private Node $last;

    public function __construct()
    {
        $this->head = null;
        $this->last = null;
    }

    /**
     * @param string $item
     */
    public function put(string $item): void
    {
        $node = new Node($item);
        if ($this->isEmpty()) {
            $this->head = $node;
            $this->last = $node;
        } else {
            $this->last->setNext($node);
            $this->last = $node;
        }
    }

    /**
     * @return string|null
     */
    public function get(): ?string
    {
        if ($this->isEmpty()) {
            return null;
        }

        $item = $this->head->getItem();
        $this->head = $this->head->getNext();

        return $item;
    }


    /**
     * @return Node|null
     */
    protected function getFirst(): ?Node
    {
        return $this->head;
    }
}
