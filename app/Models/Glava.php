<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Glava extends Model
{
    use HasFactory,Notifiable;

    protected $admin;
    protected $email;

    public function __construct() {
        $this->admin = config('glava.name');
        $this->email = config('glava.email');
    }
}
