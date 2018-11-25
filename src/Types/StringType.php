<?php declare(strict_types=1);

namespace Star\Component\Tree\Types;

use Star\Component\Tree\NodeType;
use Star\Component\Tree\TreeSubject;

final class StringType implements NodeType
{
    /**
     * @param mixed $value
     *
     * @return TreeSubject
     */
    public function createValue($value): TreeSubject
    {
        return new class($value) implements TreeSubject {
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
        };
    }
}
