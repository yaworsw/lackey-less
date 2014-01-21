<?php

namespace LackeyTest\Task;

use Lackey\Task\Less;
use LackeyTest\AbstractTestCase;

class LessTest extends AbstractTestCase
{

    public function testCompile()
    {
        $dest = __DIR__ . '/_files/test.css';
        $src  = __DIR__ . '/_files/test.less';

        $task = new Less();
        $result = $task->run(array(
            'files' => array(
                $dest => $src,
            ),
            'options' => array(
                'paths' => __DIR__ . '/_files/inc',
            ),
        ));
        $this->assertFileExists($dest);

        unlink($dest);
    }
}
