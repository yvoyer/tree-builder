<?php declare(strict_types=1);

namespace Star\Component\Tree;

/**
 * Wrapper for a value of a node.
 */
interface TreeSubject
{
    /**
     * The unique identifier for the wrapped value. Used to keep track of nodes.
     *
     * @return string
     */
    public function getIdentifier(): string;
}
