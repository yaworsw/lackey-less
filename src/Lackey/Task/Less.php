<?php

namespace Lackey\Task;

class Less extends AbstractTask
{

    protected $name = 'less';

    protected $description = 'Less compiler.';

    public function run(array $options = array(), array $runOptions = array())
    {
        $options = array_replace_recursive(array(
            'files' => array(),
            'options' => array(
                'paths' => null,
                'compress' => false,
                'preserveComments' => true,
            ),
        ), $options);

        $files   = isset($options['files'])   ? $options['files']   : array();
        $options = isset($options['options']) ? $options['options'] : array();

        $lc = new \lessc();
        $lc->setPreserveComments($options['preserveComments']);

        foreach ($files as $dest => $src) {

            $paths = isset($options['paths'])
                   ? $options['paths']
                   : array_filter(array_map($src, 'dirname'), function ($item) {
                        return !empty($item);
                   });
            if (empty($paths)) {
                $paths = array(getcwd());
            }

            $lc->setImportDir($paths);
            $lc->compileFile($src, $dest);
        }

        return 0;
    }
}
