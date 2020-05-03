<?php

namespace PlacetoPay\DocumentTypes\Support;

interface HasPrimaryKey
{
    /**
     * Get the value of the entity's primary key.
     *
     * @return mixed
     */
    public function getKey();

    /**
     * Get the primary key for the entity.
     *
     * @return string
     */
    public function getKeyName(): string;
}
