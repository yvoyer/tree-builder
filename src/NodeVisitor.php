<?php declare(strict_types=1);

namespace Star\Component\Tree;

interface NodeVisitor
{
    /**
     * @param TreeNode $node
     */
    public function visitRootNode(TreeNode $node): void;

    /**
     * @param TreeNode $node
     */
    public function visitChildNode(TreeNode $node): void;
}
