<?php declare(strict_types=1);

namespace Star\Component\Tree;

use Star\Component\Tree\Exception\DuplicateSubjectIdentifier;
use Star\Component\Tree\Exception\NodeNotFound;

interface MappingPlatform
{
    /**
     * @param string $identifier
     *
     * @return bool
     */
    public function nodeExists(string $identifier): bool;

    /**
     * @param TreeNode $node
     * @throws DuplicateSubjectIdentifier
     */
    public function insertNode(TreeNode $node): void;

    /**
     * @param string $identifier
     *
     * @return TreeNode
     * @throws NodeNotFound
     */
    public function getNode(string $identifier): TreeNode;

    /**
     * @return string[] The node identifiers
     */
    public function getRootNodes(): array;

    /**
     * Cleanup any corruption found in the tree
     */
    public function clean(): void;
}
