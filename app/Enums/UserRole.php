<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case TUTOR = 'tutor';
    case SISWA = 'siswa';

    /**
     * Get the display label for the role.
     */
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::TUTOR => 'Tutor',
            self::SISWA => 'Siswa',
        };
    }
}
