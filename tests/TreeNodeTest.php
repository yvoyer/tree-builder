<?php declare(strict_types=1);

namespace Star\Component\Tree;

use PHPUnit\Framework\TestCase;
use Star\Component\Tree\Types\StringValue;

final class TreeNodeTest extends TestCase
{
    public function test_it_should_return_a_root_node()
    {
        $node = TreeNode::rootNode(new StringValue('root'));
        $this->assertTrue($node->isRoot());
    }

    public function test_it_should_return_a_child_node()
    {
        $node = TreeNode::childNode(new StringValue('child'), TreeNode::rootNode(new StringValue('root')));
        $this->assertFalse($node->isRoot());
    }
}
