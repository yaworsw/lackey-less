<?php

namespace Lackey\Task\Less;

use Lackey\Task;

class Result implements Task\ResultInterface
{

    private $sourceMap;

    public function __construct(array $sourceMap = array(), $error = false)
    {
        $this->sourceMap = $sourceMap;
        $this->error     = boolval($error);
    }

    public function getStatus()
    {
        return $this->error ? 1 : 0;
    }

    public function isError()
    {
        return $this->error;
    }

    public function getSrcMap()
    {
        return $this->sourceMap;
    }
}
