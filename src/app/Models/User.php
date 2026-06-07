<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * Atribut yang boleh diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'avatar_url',
        'name',
        'email',
        'password',
        'nis',
        'nip',
        'parent_id',
    ];

    /**
     * Atribut yang disembunyikan saat data dikirim ke array/json.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data atribut.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->avatar_url) {
            return asset('storage/' . $this->avatar_url);
        }

        $hash = md5(strtolower(trim($this->email)));

        return 'https://www.gravatar.com/avatar/' . $hash . '?d=mp&r=g&s=250';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Refresh permission cache untuk menghindari error "Forbidden" saat login
        \Illuminate\Support\Facades\Cache::forget(config('permission.cache.key'));
        
        return match ($panel->getId()) {
            'admin' => $this->hasRole('admin'),
            'akademik' => $this->hasRole('akademik'),
            'guru' => $this->hasRole('guru'),
            'siswa' => $this->hasRole('siswa'),
            'orangtua' => $this->hasRole('orangtua'),
            default => false,
        };
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function materials()
    {
        return $this->hasMany(Material::class, 'teacher_id');
    }

    public function questionBanks()
    {
        return $this->hasMany(QuestionBank::class, 'teacher_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'teacher_id');
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'student_id');
    }
}