<?php

namespace PlacetoPay\DocumentTypes;

interface HasPrimaryKey
{
    public function getKey();

    public function getKeyName(): string;
}
