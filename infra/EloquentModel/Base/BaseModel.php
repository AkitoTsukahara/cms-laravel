<?php

declare(strict_types=1);

namespace App\infra\EloquentModel\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Infra\EloquentModel\Base\AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class BaseModel extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;
}
