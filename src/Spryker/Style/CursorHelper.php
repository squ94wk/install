<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Style;

trait CursorHelper
{
    /**
     * @param int $count
     *
     * @return void
     */
    protected function moveLineUp($count = 1)
    {
        $output = sprintf("\x1B[%sA", $count);
        $this->write($output);
    }

    /**
     * @return void
     */
    protected function moveCursorToBeginOfLine()
    {
        $this->write("\x0D");
    }

    /**
     * @return void
     */
    protected function eraseLine()
    {
        $this->write("\x1B[2K");
    }

    /**
     * @param string|array $messages
     * @param int $options
     *
     * @return void
     */
    abstract public function write($messages, $options = 0): void;
}
