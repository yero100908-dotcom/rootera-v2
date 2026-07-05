<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'service_type', 'area', 'message',
        'status', 'admin_notes', 'invoice_amount', 'completed_at', 'source',
    ];

    protected $casts = [
        'invoice_amount' => 'decimal:2',
        'completed_at' => 'datetime',
    ];

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'new'         => 'Baru',
            'in_progress' => 'Diproses',
            'completed'   => 'Selesai',
            'cancelled'   => 'Dibatalkan',
            default       => 'Tidak Diketahui',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'new'         => 'blue',
            'in_progress' => 'yellow',
            'completed'   => 'green',
            'cancelled'   => 'red',
            default       => 'gray',
        };
    }
}
