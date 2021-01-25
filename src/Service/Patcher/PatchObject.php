<?php

namespace App\Service\Patcher;

class PatchObject
{
    const OPERATION_ADD = 'add';
    const OPERATION_REPLACE = 'replace';
    const OPERATION_DELETE = 'remove';
    const OPERATIONS = [
        self::OPERATION_ADD,
        self::OPERATION_REPLACE,
        self::OPERATION_DELETE,
    ];

    public string $op;
    public string $path;
    public $value;

    public function __construct(string $op, string $path, $value = null)
    {
        $this->op = $op;
        $this->path = $path;
        $this->value = $value;
    }
}
