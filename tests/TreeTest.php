<?php declare(strict_types=1);

namespace Star\Component\Tree;

use PHPUnit\Framework\TestCase;
use Star\Component\Tree\Exception\DuplicateSubjectIdentifier;
use Star\Component\Tree\Exception\NodeNotFound;
use Star\Component\Tree\Platforms\InMemoryPlatform;
use Star\Component\Tree\Types\StringValue;

final class TreeTest extends TestCase
{
    const ROOT = 'root';

    public function test_it_should_create_first_root_node()
    {
        $tree = new Tree(new InMemoryPlatform());
        $tree->addRootNode($subject = new StringValue(self::ROOT));
        $this->assertReadOnlyNode($tree, $subject, 1, 2, 1);

        return clone $tree;
    }

    /**
     * @param Tree $tree
     * @depends test_it_should_create_first_root_node
     * @return Tree
     */
    public function test_it_should_add_sibling_root(Tree $tree)
    {
        $rootOne = new StringValue(self::ROOT);
        $tree->addRootNode($rootTwo = new StringValue('root2'));
        $this->assertReadOnlyNode($tree, $rootOne, 1, 2, 1);
        $this->assertReadOnlyNode($tree, $rootTwo, 3, 4, 1);

        $tree->addRootNode($rootThree = new StringValue('root3'));
        $this->assertReadOnlyNode($tree, $rootOne, 1, 2, 1);
        $this->assertReadOnlyNode($tree, $rootTwo, 3, 4, 1);
        $this->assertReadOnlyNode($tree, $rootThree, 5, 6, 1);

        return clone $tree;
    }

    /**
     * @param Tree $tree
     * @depends test_it_should_create_first_root_node
     * @return Tree
     */
    public function test_it_should_add_child_to_root(Tree $tree)
    {
        $root = new StringValue(self::ROOT);
        $this->assertReadOnlyNode($tree, $root, 1, 2, 1);
        $tree->addChildNode($child = new StringValue('child-1'), $root->getIdentifier());
        $this->assertReadOnlyNode($tree, $root, 1, 4, 1);
        $this->assertReadOnlyNode($tree, $child, 2, 3, 2);

        return clone $tree;
    }

    /**
     * @param TreeSubject $subject
     * @param int $left
     * @param int $right
     * @param int $depth
     */
    private function assertReadOnlyNode(Tree $tree, TreeSubject $subject, int $left, int $right, int $depth): void
    {
        $node = $tree->getNodeInfo($subject->getIdentifier());
        $this->assertEquals($left, $node->getLeft(), 'Left is not as expected');
        $this->assertEquals($right, $node->getRight(), 'Right is not as expected');
        $this->assertEquals($depth, $node->getDepth(), 'Depth is not as expected');
    }

    public function test_it_should_throw_exception_when_two_identical_identifier_are_present() {
        $tree = new Tree(new InMemoryPlatform());
        $tree->addRootNode(new StringValue('id'));
        $this->expectException(DuplicateSubjectIdentifier::class);
        $this->expectExceptionMessage(
            'Another node already exists with identifier "id", each node must have a unique identifier.'
        );
        $tree->addRootNode(new StringValue('id'));
    }

    public function test_it_should_throw_exception_when_parent_do_not_exists()
    {
        $tree = new Tree(new InMemoryPlatform());
        $this->expectException(NodeNotFound::class);
        $this->expectExceptionMessage('The parent node with identifier "root" could not be found.');
        $tree->addChildNode(new StringValue('child'), 'root');
    }
}
