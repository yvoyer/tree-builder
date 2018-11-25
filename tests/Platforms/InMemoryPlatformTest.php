<?php declare(strict_types=1);

namespace Star\Component\Tree\Platforms;

use PHPUnit\Framework\TestCase;
use Star\Component\Tree\Exception\DuplicateSubjectIdentifier;
use Star\Component\Tree\Exception\NodeNotFound;
use Star\Component\Tree\TreeNode;
use Star\Component\Tree\Types\StringValue;

final class InMemoryPlatformTest extends TestCase
{
    /**
     * @var InMemoryPlatform
     */
    private $platform;

    public function setUp()
    {
        $this->platform = new InMemoryPlatform();
    }

    public function test_it_should_throw_exception_when_node_do_not_exists()
    {
        $this->expectException(NodeNotFound::class);
        $this->expectExceptionMessage(
            sprintf(
                'Node with identifier "not-found" could not be found in platform "%s".',
                InMemoryPlatform::class
            )
        );
        $this->platform->getNode('not-found');
    }

    public function test_it_should_insert_root_nodes()
    {
        $this->assertCount(0, $this->platform->getRootNodes());
        $this->platform->insertNode(TreeNode::rootNode(new StringValue('root 1')));
        $this->assertCount(1, $this->platform->getRootNodes());
        $this->platform->insertNode(TreeNode::rootNode(new StringValue('root 2')));
        $this->assertCount(2, $this->platform->getRootNodes());
    }

    public function test_it_should_throw_exception_when_inserting_duplicate_identifier()
    {
        $this->platform->insertNode($node = TreeNode::rootNode(new StringValue('duplicate')));
        $this->expectException(DuplicateSubjectIdentifier::class);
        $this->expectExceptionMessage(
            'Another node already exists with identifier "duplicate", each node must have a unique identifier.'
        );
        $this->platform->insertNode($node = TreeNode::rootNode(new StringValue('duplicate')));
    }
}
