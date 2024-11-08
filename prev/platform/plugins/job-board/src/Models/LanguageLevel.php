<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class LanguageLevel extends BaseModel
{
    protected $table = 'jb_language_levels';

    protected $fillable = [
        'name',
        'order',
        'is_default',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
