<?php

declare(strict_types=1);

namespace App\Model;

class Node
{
    /**
     * @var string
     */
    private string $item;

    /**
     * @var Node|null
     */
    private ?Node $next;

    /**
     * @param string $item
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
    public function getItem(): string
    {
        return $this->item;
    }

    /**
     * @return Node|null
     */
    public function getNext(): ?Node
    {
        return $this->next;
    }

    /**
     * @param Node|null $next
     */
    public function setNext(?Node $next): void
    {
        $this->next = $next;
    }
}
