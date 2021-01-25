<?php

namespace App\Factory\Note;

use App\Service\Patcher\PatchObject;
use JsonException;
use Symfony\Component\HttpFoundation\Request;

class PatchFactory
{

    public function createPatchObject(Request $request)
    {
        $patch = $request->getContent();

        // check if op exist
        if (!property_exists($patch, 'op')) {
            throw new JsonException($request->getContent(), 'patch operation is empty');
        }

        // check if op is valid
        if (!in_array($patch->op, PatchObject::OPERATIONS)) {
            throw new JsonException($request->getContent(), 'patch operation is not valid');
        }

        // check if op has value
        if (($patch->op === PatchObject::OPERATION_ADD || $patch->op === PatchObject::OPERATION_REPLACE) && !property_exists($patch, 'value')) {
            throw new JsonException($request->getContent(), 'patch value is empty');
        }

        // check if path of ressource
        if (!property_exists($patch, 'path')) {
            throw new JsonException($request->getContent(), 'patch path is empty');
        }

        return new PatchObject($patch->op, $patch->path, $patch->value ?? null);
    }

}
