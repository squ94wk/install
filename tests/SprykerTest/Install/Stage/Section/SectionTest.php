<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerTest\Install\Stage\Section;

use Codeception\Test\Unit;
use Spryker\Install\Stage\Section\Command\Command;
use Spryker\Install\Stage\Section\Command\Exception\CommandExistsException;
use Spryker\Install\Stage\Section\Section;

/**
 * Auto-generated group annotations
 * @group SprykerTest
 * @group Install
 * @group Stage
 * @group Section
 * @group SectionTest
 * Add your own group annotations below this line
 */
class SectionTest extends Unit
{
    public const SECTION_NAME = 'section';

    /**
     * @return void
     */
    public function testGetName()
    {
        $section = new Section(static::SECTION_NAME);
        $this->assertSame(static::SECTION_NAME, $section->getName());
    }

    /**
     * @return void
     */
    public function testAddCommandToSection()
    {
        $section = new Section(static::SECTION_NAME);
        $section->addCommand(new Command('command'));

        $this->assertCount(1, $section->getCommands());
    }

    /**
     * @return void
     */
    public function testAddCommandsToSection()
    {
        $section = new Section(static::SECTION_NAME);
        $section
            ->addCommand(new Command('commandA'))
            ->addCommand(new Command('commandB'));

        $this->assertCount(2, $section->getCommands());
    }

    /**
     * @return void
     */
    public function testAddCommandsWithSameNameThrowsException()
    {
        $this->expectException(CommandExistsException::class);

        $section = new Section(static::SECTION_NAME);
        $section
            ->addCommand(new Command('commandA'))
            ->addCommand(new Command('commandA'));
    }
}
