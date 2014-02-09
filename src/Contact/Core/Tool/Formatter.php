<?php
/**
 * @license MIT
 * Full license text in LICENSE file
 */

namespace Contact\Core\Tool;

interface Formatter
{
    public function setup(array $data);

    public function format($template);
}
