<?php declare(strict_types=1);

namespace Star\Component\Tree;

use Star\Component\Tree\Exception\NodeNotFound;

final class Tree
{
    /**
     * When true, we should compute the left/right before allowing a node to be returned
     *
     * @var bool
     */
    private $dirty = false;

    /**
     * @var MappingPlatform
     */
    private $platform;

    /**
     * @param MappingPlatform $platform
     */
    public function __construct(MappingPlatform $platform)
    {
        $this->platform = $platform;
    }

    /**
     * @param TreeSubject $subject
     */
    public function addRootNode(TreeSubject $subject): void
    {
        $this->addNode(TreeNode::rootNode($subject));
    }

    /**
     * @param TreeSubject $subject
     * @param string $parent
     * @throws NodeNotFound
     */
    public function addChildNode(TreeSubject $subject, string $parent): void
    {
        if (! $this->platform->nodeExists($parent)) {
            throw new NodeNotFound(sprintf('The parent node with identifier "%s" could not be found.', $parent));
        }

        $parentNode = $this->platform->getNode($parent);
        $this->addNode(TreeNode::childNode($subject, $parentNode));
    }

    /**
     * @param string $identifier
     *
     * @return TreeNode
     */
    public function getNodeInfo(string $identifier): TreeNode
    {
        if ($this->dirty) {
            $this->platform->clean();
            $this->dirty = false;
        }

        return $this->platform->getNode($identifier);
    }

    /**
     * @param TreeNode $node
     */
    private function addNode(TreeNode $node): void
    {
        $this->dirty = true;
        $this->platform->insertNode($node);
    }
}
