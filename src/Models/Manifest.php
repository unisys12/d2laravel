<?php

namespace unisys12\D2Laravel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manifest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \unisys12\D2Laravel\Database\Factories\ManifestFactory::new();
    }
}
