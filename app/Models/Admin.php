<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model {
    use HasFactory, Notifiable;

    protected $admin;
    protected $email;
    protected $email_from_cabinet;

    public function __construct() {
        $this->admin = config('admin.name');
        $this->email = config('admin.email');
        $this->email_from_cabinet = config('admin.email_from_cabinet');
    }

    public function routeNotificationForMail() {
        return $this->email_from_cabinet;
    }
}
