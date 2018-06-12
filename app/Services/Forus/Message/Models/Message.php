<?php

namespace App\Services\Forus\Message\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @mixin Eloquent
 * @property mixed $id
 * @property string $name
 * @property string $message
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Services\Forus\Message\Models
 */
class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'message'
    ];
}
