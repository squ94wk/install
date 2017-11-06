<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Console;

use Codeception\Test\Unit;
use Spryker\Console\SetupConsoleCommand;

/**
 * Auto-generated group annotations
 * @group SprykerTest
 * @group Console
 * @group SetupConsoleCommandCommandTest
 * Add your own group annotations below this line
 */
class SetupConsoleCommandCommandTest extends Unit
{
    /**
     * @var \SprykerTest\ConsoleTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testExcludedCommandByNameIsNotExecuted()
    {
        $command = new SetupConsoleCommand();
        $tester = $this->tester->getCommandTester($command);

        $arguments = [
            'command' => $command->getName(),
            SetupConsoleCommand::ARGUMENT_ENVIRONMENT => 'development',
            '--' . SetupConsoleCommand::OPTION_EXCLUDE => ['section-a-command-a'],
        ];
        $tester->execute($arguments);

        $output = $tester->getDisplay();
        $this->assertNotRegexp('/Command: section-a-command-a/', $output, 'Command "section-a-command-a" was not expected to be executed but was');
    }
}
