<?php

namespace App\Service\Patcher;

use BadMethodCallException;
use Doctrine\Common\Collections\Collection;
use http\Exception\InvalidArgumentException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class Patch
{
    private array $values = [];
    private array $pathList = [];
    private array $operations = [];
    private array $currentPathList = [];
    protected PropertyAccessor $propertyAccess;

    public function __construct()
    {
        $this->propertyAccess = PropertyAccess::createPropertyAccessor();

    }

    public function patch($object, PatchObject $patchObject)
    {
        $propPath = $this->getPropertyPath($patchObject->path);
        $propName = $this->getProperty($patchObject->path);

        if($patchObject->op === PatchObject::OPERATION_REPLACE) {
            $this->patchReplace($patchObject, $object, $propPath, $propName);
        } else {
            throw new \HttpRequestException(
                sprintf('Patch op "%s" is not supported', $patchObject->op),
                0,
                null
            );
        }
    }

    public function addValues($propertyName, $values)
    {
        $this->values[$propertyName] = $values;
        return $this;
    }

    public function setValues(array $values = [])
    {
        $this->values = $values;
        return $this;
    }

    public function setPathList($pathList)
    {
        $this->pathList = $pathList;
        return $this;
    }

    public function setOperations($operations)
    {
        $this->operations = $operations;
        return $this;
    }

    private function patchReplace(PatchObject $patchObject, $object, $propPath, $propName)
    {
        $value = $this->checkPatchValue($propName, $patchObject->value);
        dump($value); die();
    }

    private function checkPatchValue($propName, $patchObjectValue)
    {
        if(isset($this->values[$propName])) {
            $value = $this->getValueFromEntity($this->values[$propName], $patchObjectValue);
            if(!$value) {
                throw new InvalidArgumentException(
                    sprintf('This value %s is not correct', $value)
                );
            }
            return $value;
        }
        return false;
    }

    private function getValueFromEntity($entities, $id)
    {
        foreach ($entities as $entity) {
            if (is_object($entity) && method_exists($entity, 'getId') && $entity->getId() == $id) {
                return $entity;
            }
        }
        return null;
    }

    private function isEntitiesCollection($object, $propertyName)
    {
        return $this->propertyAccess->getValue($object, $propertyName) instanceof Collection;
    }

    private function getPropertyPath(string $path): string
    {
        $arrayPath = explode('/', trim($path, '/'));

        $propertyPath = $arrayPath[0];

        if (isset($arrayPath[1])) {
            $propertyPath .= "[" . $arrayPath[1] . "]";
        }

        return $propertyPath;
    }

    private function getProperty(string $path): string
    {
        $arrayPath = explode('/', trim($path, '/'));

        return $arrayPath[0];
    }
}
