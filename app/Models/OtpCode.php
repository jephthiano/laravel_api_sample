<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OtpCode extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'receiving_medium',
        'code',
        'use_case',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->id) {
                $model->id = (string) Str::uuid();
            }

            // Encrypt receiving medium and hash code
            $model->receiving_medium = Crypt::encryptString($model->receiving_medium);
            $model->code = Hash::make($model->code);
        });
    }

    public function scopeValid($query)
    {
        return $query->where('status', 'new');
    }

    public function matchesCode(string $input): bool
    {
        return Hash::check($input, $this->code);
    }

    public function markAsUsed(): void
    {
        $this->status = 'used';
        $this->save();
    }

    public function getReceivingMediumAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setReceivingMediumAttribute($value)
    {
        $this->attributes['receiving_medium'] = Crypt::encryptString($value);
    }
}
