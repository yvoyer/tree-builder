<?php declare(strict_types=1);

namespace Star\Component\Tree\Exception;

use Star\Component\Tree\MappingPlatform;

final class NodeNotFound extends \Exception
{
    /**
     * @param string $id
     * @param MappingPlatform $platform
     *
     * @return NodeNotFound
     */
    public static function notFoundInPlatform(string $id, MappingPlatform $platform): self
    {
        return new self(
            sprintf(
                'Node with identifier "%s" could not be found in platform "%s".',
                $id,
                get_class($platform)
            )
        );
    }
}
