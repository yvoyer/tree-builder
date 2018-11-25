<?php declare(strict_types=1);

namespace Star\Component\Tree\Exception;

final class DuplicateSubjectIdentifier extends \LogicException
{
    /**
     * @param string $identifier
     *
     * @return DuplicateSubjectIdentifier
     */
    public static function nodeWithIdentifierExist(string $identifier): self
    {
        return new DuplicateSubjectIdentifier(
            sprintf(
                'Another node already exists with identifier "%s", each node must have a unique identifier.',
                $identifier
            )
        );
    }
}
