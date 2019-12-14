<?php

namespace App\Model;

class Node
{

    /** @var string */
    private $item;

    /** @var Node|null */
    private $next;

    /**
     * Node constructor.
     * @param string    $item
     * @param Node|null $next
     */
    public function __construct(string $item, ?Node $next = null)
    {
        $this->item = $item;
        $this->next = $next;
    }

    /**
     * @return string
     */
    public function getItem() : string
    {
        return $this->item;
    }

    /**
     * @return Node|null
     */
    public function getNext() : ?Node
    {
        return $this->next;
    }

    /**
     * @param Node|null $next
     */
    public function setNext(?Node $next) : void
    {
        $this->next = $next;
    }
}
