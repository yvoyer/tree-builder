<?php declare(strict_types=1);

namespace Star\Component\Tree\Types;

use Star\Component\Tree\TreeSubject;

final class StringValue implements TreeSubject
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * The unique identifier for the wrapped value. Used to keep track of nodes.
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->value;
    }
}
