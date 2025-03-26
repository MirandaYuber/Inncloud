<?php

namespace Yuber\Kernel\Infrastructure\Repositories;

abstract class DbRepository extends BaseRepository
{
    abstract public function getTableName():string;

    abstract public function getDatabaseConnection():string;

}

