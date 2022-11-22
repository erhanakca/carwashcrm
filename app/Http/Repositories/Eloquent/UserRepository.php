<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

}
