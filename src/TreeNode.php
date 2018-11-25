<?php declare(strict_types=1);

namespace Star\Component\Tree;

final class TreeNode
{
    /**
     * @var int
     */
    private $left;

    /**
     * @var int
     */
    private $right;

    /**
     * @var int
     */
    private $depth;

    /**
     * @var TreeSubject
     */
    private $subject;

    /**
     * @var TreeNode|null
     */
    private $parent;

    /**
     * @var TreeNode[]
     */
    private $children = [];

    /**
     * @param TreeSubject $subject
     * @param int $depth
     */
    private function __construct(TreeSubject $subject, int $depth)
    {
        $this->subject = $subject;
        $this->depth = $depth;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->subject->getIdentifier();
    }

    /**
     * @return int
     */
    public function getLeft(): int
    {
        return $this->left;
    }

    /**
     * @return int
     */
    public function getRight(): int
    {
        return $this->right;
    }

    /**
     * @return int
     */
    public function getDepth(): int
    {
        return $this->depth;
    }

    /**
     * @return bool
     */
    public function isRoot(): bool
    {
        return $this->depth === 1;
    }

    /**
     * @param CompilationContext $context
     */
    public function reorder(CompilationContext $context): void
    {
        $this->depth = $context->getCurrentDepth();
        $this->left = $context->getCurrentLeft();

        foreach ($this->children as $child) {
            $context = $context->nextChild();
            $child->reorder($context);
            $child->right = $context->getCurrentRight();
        }

        $this->right = $context->getCurrentRight();
    }

    private function addChild(TreeNode $child): void
    {
        $child->parent = $this;
        $this->children[] = $child;
    }

    /**
     * @param TreeSubject $subject
     *
     * @return TreeNode
     */
    public static function rootNode(TreeSubject $subject): self
    {
        return new self($subject, 1);
    }

    /**
     * @param TreeSubject $subject
     * @param TreeNode $parent
     *
     * @return TreeNode
     */
    public static function childNode(TreeSubject $subject, TreeNode $parent): self
    {
        $child = new self($subject, $parent->depth + 1);
        $parent->addChild($child);

        return $child;
    }
}
