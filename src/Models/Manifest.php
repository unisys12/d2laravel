<?php

namespace unisys12\D2Laravel\Models;

use unisys12\D2Laravel\Database\Factories\ManifestFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manifest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return ManifestFactory::new();
    }
}
