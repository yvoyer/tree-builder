<?php declare(strict_types=1);

namespace Star\Component\Tree\Platforms;

use Star\Component\Tree\Exception\DuplicateSubjectIdentifier;
use Star\Component\Tree\Exception\NodeNotFound;
use Star\Component\Tree\MappingPlatform;
use Star\Component\Tree\NodePosition;
use Star\Component\Tree\TreeNode;

final class InMemoryPlatform implements MappingPlatform
{
    /**
     * @var TreeNode[]
     */
    private $root_nodes = [];

    /**
     * @var TreeNode[]
     */
    private $nodes = [];

    /**
     * @param string $identifier
     *
     * @return bool
     */
    public function nodeExists(string $identifier): bool
    {
        return array_key_exists($identifier, $this->nodes);
    }

    /**
     * @param TreeNode $node
     * @throws DuplicateSubjectIdentifier
     */
    public function insertNode(TreeNode $node): void
    {
        $identifier = $node->getIdentifier();
        if ($this->nodeExists($identifier)) {
            throw DuplicateSubjectIdentifier::nodeWithIdentifierExist($identifier);
        }

        $this->nodes[$identifier] = $node;
        if ($node->isRoot()) {
            $this->root_nodes[$identifier] = $node;
        }
    }

    /**
     * @param string $identifier
     *
     * @return TreeNode
     * @throws NodeNotFound
     */
    public function getNode(string $identifier): TreeNode
    {
        if (! $this->nodeExists($identifier)) {
            throw NodeNotFound::notFoundInPlatform($identifier, $this);
        }

        return $this->nodes[$identifier];
    }

    /**
     * @return string[] The node identifiers
     */
    public function getRootNodes(): array
    {
        return array_keys($this->root_nodes);
    }

    /**
     * Cleanup any corruption found in the tree
     */
    public function clean(): void
    {
        $context = NodePosition::start();
        foreach ($this->root_nodes as $root) {
            $root->reorder($context);
        }
    }
}
