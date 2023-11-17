<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class AdminUser extends Model implements Authenticatable {

    use HasFactory;

    protected $table = 'admin_users';

    protected $fillable = [
        'name',
        'sub_name',
        'email',
        'password',
        'tel',
        'post_code',
        'prefecture',
        'city',
        'street',
        'admin_level',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthIdentifierName() {
        return 'id';
    }

    public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function getAuthPassword() {
        return $this->password;
    }

    public function getRememberToken() {
        return $this->remember_token; // ユーザーの"remember_token"を取得します
    }

    public function setRememberToken($value) {
        $this->remember_token = $value; // ユーザーの"remember_token"を設定します
    }

    public function getRememberTokenName() {
        return 'remember_token'; // "remember_token" カラム名を指定します
    }
}