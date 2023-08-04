<?php

namespace App\DomainModel\Packaging;

use App\DomainModel\Packaging;

interface PackagingRepository
{
    public function create(Packaging $packaging): void;
}
