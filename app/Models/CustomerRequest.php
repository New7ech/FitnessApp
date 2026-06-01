<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'type',
    'status',
    'name',
    'email',
    'phone',
    'goal',
    'service',
    'preferred_date',
    'preferred_time',
    'message',
    'admin_notes',
    'read_at',
])]
class CustomerRequest extends Model
{
    public const TYPES = [
        'question' => 'Question',
        'reservation' => 'Reservation',
        'quote' => 'Devis',
    ];

    public const STATUSES = [
        'new' => 'Nouvelle',
        'contacted' => 'Contacte',
        'confirmed' => 'Confirmee',
        'closed' => 'Cloturee',
    ];

    protected function casts(): array
    {
        return [
            'preferred_date' => 'date',
            'read_at' => 'datetime',
        ];
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? ucfirst((string) $this->type);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst((string) $this->status);
    }

    public function getPhoneDigitsAttribute(): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $this->phone);

        if ($digits === '') {
            return null;
        }

        if (str_starts_with($digits, '00')) {
            $digits = substr($digits, 2);
        }

        if (str_starts_with($digits, '0')) {
            return '225'.$digits;
        }

        return $digits;
    }

    public function getDialPhoneAttribute(): ?string
    {
        return $this->phone_digits ? '+'.$this->phone_digits : null;
    }

    public function getContactSummaryAttribute(): string
    {
        return trim(collect([$this->name, $this->email, $this->dial_phone])->filter()->implode(' | '));
    }
}
