<?php

namespace LackeyTest\Task;

use Lackey\Task\Less;
use LackeyTest\AbstractTestCase;

class LessTest extends AbstractTestCase
{

    public function testCompile()
    {
        $dest = __DIR__ . '/_files/test.css';
        $src  = __DIR__ . '/_files/compile.less';

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

    public function testThrowsExceptionWhenSrcNotFound()
    {
        $exceptionThrown = false;
        try {
            $dest = __DIR__ . '/_files/test2.css';
            $src  = __DIR__ . '/_files/404_file_not_found.less';

            $task   = new Less();
            $result = $task->run(array(
                'files' => array(
                    $dest => $src,
                ),
                'options' => array(
                    'paths' => __DIR__ . '/_files/inc',
                ),
            ));
        } catch (\Exception $ex) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
        $this->assertFalse(is_file($dest));
    }
}
