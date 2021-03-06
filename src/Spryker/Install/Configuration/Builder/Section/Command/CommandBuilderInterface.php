<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Install\Configuration\Builder\Section\Command;

use Spryker\Install\Stage\Section\Command\CommandInterface;

interface CommandBuilderInterface
{
    /**
     * @param string $name
     * @param array $definition
     *
     * @return \Spryker\Install\Stage\Section\Command\CommandInterface
     */
    public function buildCommand(string $name, array $definition): CommandInterface;
}
