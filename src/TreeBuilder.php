<?php declare(strict_types=1);

namespace Star\Component\Tree;

use PHPUnit\Framework\IncompleteTestError;
use Star\Component\Tree\Platforms\InMemoryPlatform;
use Star\Component\Tree\Platforms\SqlitePlatform;

final class TreeBuilder
{
    /**
     * @var $platform
     */
    private $platform;

    /**
     * @var TreeNode[]
     */
    private $roots = [];

    private function __construct(MappingPlatform $platform)
    {
        $this->platform = $platform;
    }

    /**
     * @param mixed $value
     *
     * @return TreeBuilder
     */
    public function addRoot($value): self
    {
   //     $this->roots[] = new RootNode(0, $this->type->createValue($value));

        return $this;
    }

    public function addChild($value, $parent): self
    {
 //       $this->roots[] = new ChildNode(0, $this->type->createValue($value), $parent);

        return $this;
    }

    /**
     * @return Tree
     */
    public function inMemory(): Tree
    {
        return new Tree(new InMemoryPlatform());
    }

    /**
     * @return Tree
     */
    public function sqlite(): Tree
    {
        return new Tree(new SqlitePlatform());
    }
}
