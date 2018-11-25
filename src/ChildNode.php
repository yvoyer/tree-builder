<?php //declare(strict_types=1);
//
//namespace Star\Component\Tree;
//
//final class ChildNode implements TreeNode
//{
//    /**
//     * @var int
//     */
//    private $left;
//
//    /**
//     * @var int
//     */
//    private $right;
//
//    /**
//     * @var int
//     */
//    private $depth;
//
//    /**
//     * @var TreeSubject
//     */
//    private $subject;
//
//    /**
//     * @var TreeNode
//     */
//    private $parent;
//
//    /**
//     * @var NodeObserver[]
//     */
//    private $observers = [];
//
//    /**
//     * @param TreeSubject $subject
//     * @param TreeNode $parent
//     */
//    public function __construct(TreeSubject $subject, TreeNode $parent)
//    {
//        $this->subject = $subject;
//        $this->parent = $parent;
//    }
//
//    /**
//     * @return int
//     */
//    public function getLeft(): int
//    {
//        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
//    }
//
//    /**
//     * @return int
//     */
//    public function getRight(): int
//    {
//        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
//    }
//
//    /**
//     * @return int
//     */
//    public function getDepth(): int
//    {
//        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
//    }
//
//    /**
//     * @param NodeVisitor $visitor
//     */
//    public function acceptNodeVisitor(NodeVisitor $visitor): void
//    {
//        $visitor->visitChildNode($this);
//    }
//
//    /**
//     * @param NodeObserver $observer
//     */
//    public function attachObserver(NodeObserver $observer): void
//    {
//        $this->observers[] = $observer;
//    }
//
//    public function reorder(CompilationContext $context): CompilationContext
//    {
//        $this->left = $context->getCurrentLeft();
//        $newContext = $context->
//        $this->right = $context->getCurrentRight();
//
//        return
//    }
//}
