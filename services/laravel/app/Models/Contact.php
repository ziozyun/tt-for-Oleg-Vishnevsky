<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'value'];

    const TYPE_PHONE = 1;
    const TYPE_EMAIL = 2;

    public function getTypeAttribute($value)
    {
        switch ($value) {
            case self::TYPE_PHONE:
                return 'Phone';
            case self::TYPE_EMAIL:
                return 'Email';
            default:
                return 'Unknown';
        }
    }

    public function setTypeAttribute($value)
    {
        if ($value === 'Phone') {
            $this->attributes['type'] = self::TYPE_PHONE;
        } elseif ($value === 'Email') {
            $this->attributes['type'] = self::TYPE_EMAIL;
        } else {
            $this->attributes['type'] = null;
        }
    }

    public function contactable()
    {
        return $this->morphTo();
    }
}
