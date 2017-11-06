<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Setup\Executable\CommandLine;

use Spryker\Setup\Configuration\ConfigurationInterface;
use Spryker\Setup\Exception\SetupException;
use Spryker\Setup\Executable\ExecutableInterface;
use Spryker\Setup\Stage\Section\Command\CommandInterface;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\Process\Process;

class CommandLineExecutable implements ExecutableInterface
{
    /**
     * @var \Spryker\Setup\Stage\Section\Command\CommandInterface
     */
    protected $command;

    /**
     * @var \Spryker\Setup\Configuration\ConfigurationInterface
     */
    protected $configuration;

    /**
     * @var array
     */
    protected $internalBuffer = [];

    /**
     * @param \Spryker\Setup\Stage\Section\Command\CommandInterface $command
     * @param \Spryker\Setup\Configuration\ConfigurationInterface $configuration
     */
    public function __construct(CommandInterface $command, ConfigurationInterface $configuration)
    {
        $this->command = $command;
        $this->configuration = $configuration;
    }

    /**
     * @param \Symfony\Component\Console\Style\StyleInterface $output
     *
     * @return int
     */
    public function execute(StyleInterface $output)
    {
        $process = new Process($this->command->getExecutable(), SPRYKER_ROOT, null, null, 600);
        $process->start();

        foreach ($process as $buffer) {
            echo $buffer;
        }

        if (!$process->isSuccessful()) {
            $this->abortSetupIfNotAllowedToContinue($output);
        }

        return ($process->getExitCode() === null) ? static::CODE_SUCCESS : $process->getExitCode();
    }

    /**
     * @param \Symfony\Component\Console\Style\StyleInterface $output
     *
     * @throws \Spryker\Setup\Exception\SetupException
     *
     * @return void
     */
    protected function abortSetupIfNotAllowedToContinue(StyleInterface $output)
    {
        if ($this->command->breakOnFailure() || !$this->askToContinue($output)) {
            throw new SetupException('Aborted setup...');
        }
    }

    /**
     * @param \Symfony\Component\Console\Style\StyleInterface $output
     *
     * @return bool
     */
    protected function askToContinue(StyleInterface $output)
    {
        if (!$this->configuration->shouldAskBeforeContinueAfterException()) {
            return true;
        }

        $output->newLine();
        $question = sprintf('Command <fg=yellow>%s</> failed! Continue with setup?', $this->command->getName());

        return $output->confirm($question);
    }
}
