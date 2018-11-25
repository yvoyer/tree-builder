<?php declare(strict_types=1);

namespace Star\Component\Tree\Platforms;

use PHPUnit\Framework\TestCase;
use Star\Component\Tree\MappingPlatform;
use Star\Component\Tree\TreeNode;
use Star\Component\Tree\Types\StringValue;

final class SqlitePlatformTest extends TestCase
{
    public function test_it_should_insert_root_node()
    {
        $platform = new SqlitePlatform();
        $value = new StringValue('root-1');
        $this->assertFalse($platform->nodeExists($value->getIdentifier()));
        $platform->insertNode(TreeNode::rootNode($value));
        $this->assertTrue($platform->nodeExists($value->getIdentifier()));
    }

    public function test_it_should_increase_positions_when_adding_sibbling()
    {
        $platform = new SqlitePlatform();
        $platform->insertNode(TreeNode::rootNode(new StringValue($rootOne = 'root-1')));
        $this->assertNodePosition($platform, $rootOne, 1, 2, 1);

        $platform->insertNode(TreeNode::rootNode(new StringValue($rootTwo = 'root-2')));
        $this->assertNodePosition($platform, $rootOne, 1, 2, 1);
        $this->assertNodePosition($platform, $rootTwo, 3, 4, 1);

        $platform->insertNode(TreeNode::rootNode(new StringValue($rootThree = 'root-3')));
        $this->assertNodePosition($platform, $rootOne, 1, 2, 1);
        $this->assertNodePosition($platform, $rootTwo, 3, 4, 1);
        $this->assertNodePosition($platform, $rootThree, 5, 6, 1);
    }

    /**
     * @param MappingPlatform $platform
     * @param string $id
     * @param int $left
     * @param int $right
     * @param int $depth
     */
    private function assertNodePosition(MappingPlatform $platform, string $id, int $left, int $right, int $depth): void
    {
        $node = $platform->getNode($id);
        var_dump($node);
        $this->assertSame($left, $node->getLeft());
        $this->assertSame($right, $node->getRight());
        $this->assertSame($depth, $node->getDepth());
    }
}
