<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // ใช้ bcrypt หรือ Hash::make เพื่อเข้ารหัสรหัสผ่าน
            'remember_token' => Str::random(10),
            'role' => 'user', // หรือ 'admin' ถ้าคุณต้องการ
        ];
    }
}
