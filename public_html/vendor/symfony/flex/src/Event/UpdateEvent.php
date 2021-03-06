<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Flex\Event;

use Composer\Script\Event;
use Composer\Script\ScriptEvents;

class UpdateEvent extends Event
{
    private $force;

    public function __construct(bool $force)
    {
        $this->name = ScriptEvents::POST_UPDATE_CMD;
        $this->force = $force;
    }

    public function force(): bool
    {
        return $this->force;
    }
}
