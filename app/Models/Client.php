<?php

namespace App\Models;

use App\Enums\ClientType;
use App\Traits\HasTransliterateSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, HasTransliterateSearch, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'fax',
        'email',
    ];


}
