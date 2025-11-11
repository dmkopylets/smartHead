<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email'
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public static function asOptions()
    {
        $options = ['' => 'not set'];
        $items = self::orderBy('name', 'asc')->get()->pluck('name', 'id');
        foreach ($items as $id => $name) {
            $options[$id] = $name;
        }
        return $options;
    }
}
