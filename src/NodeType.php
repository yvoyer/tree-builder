<?php declare(strict_types=1);

namespace Star\Component\Tree;

interface NodeType
{
    /**
     * @param mixed $value
     *
     * @return TreeSubject
     */
    public function createValue($value): TreeSubject;
}
