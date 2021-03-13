<?php

namespace App\Serializer\Hub;

use App\Entity\Hub\Hub;

class HubArraySerializer
{
    /**
     * @param $hubs
     * @return array
     */
    public function listToArray($hubs)
    {
        $result = [];
        foreach ($hubs as $hub) {
            $result[] = $this->toArray($hub);
        }

        return $result;
    }

    /**
     * @param Hub $hub
     * @return array-
     */
    public function toArray(Hub $hub)
    {
        return [
            'id' => $hub->getId(),
            'name' => $hub->getName(),
            'creation_datetime' => $hub->getCreationDatetime(),
            'creator' => $hub->getCreator()->getUsername()
        ];
    }

//    public function classObject(Hub $hub)
//    {
//        return
//    }
}
