<?php declare(strict_types=1);

namespace Star\Component\Tree;

use PHPUnit\Framework\TestCase;
use Star\Component\Tree\Types\StringType;

final class TreeBuilderTest extends TestCase
{
    public function test_it_should_create_a_root_node()
    {
        $builder = new TreeBuilder(new StringType());
        $node = $builder
            ->addRoot('root')
            ->build();

        $this->assertSame(1, $node->getLeft());
        $this->assertSame(1, $node->getRight());
        $this->assertSame(1, $node->getDepth());
        $this->assertTrue($node->isRoot());
    }

    public function test_it_should_create_a_child_node()
    {
        $builder = new TreeBuilder(new StringType());
        $builder
            ->addRoot('root')
            ->build();

        $this->assertSame(1, $root->getLeft());
        $this->assertSame(1, $root->getRight());
        $this->assertSame(1, $root->getDepth());
        $this->assertTrue($root->isRoot());
    }
}
