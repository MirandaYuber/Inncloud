<?php

namespace Yuber\Kernel\Infrastructure\Repositories;

abstract class ApiRepository extends BaseRepository
{
    abstract public function getEndpoint():string;


}
