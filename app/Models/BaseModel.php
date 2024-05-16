<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use Filterable;
}
