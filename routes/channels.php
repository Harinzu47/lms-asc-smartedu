<?php

use App\Enums\UserRole;
use App\Models\WhiteboardSession;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

/**
 * Whiteboard Presence Channel
 * Allows authenticated users to join if session is active
 */
Broadcast::channel('whiteboard.{sessionCode}', function ($user, $sessionCode) {
    $session = WhiteboardSession::where('session_code', $sessionCode)
        ->where('is_active', true)
        ->first();

    if (!$session) {
        \Log::info('Whiteboard channel: Session not found', ['code' => $sessionCode]);
        return false;
    }

    // Allow tutor (creator)
    if ($user->id === $session->created_by) {
        \Log::info('Whiteboard channel: Tutor authorized', ['user' => $user->id]);
        return ['id' => $user->id, 'name' => $user->name, 'role' => 'tutor'];
    }

    // Allow students in the class - check using kelas_id and role enum
    $jadwal = $session->jadwal;

    if ($user->kelas_id === $jadwal->kelas_id && $user->role === UserRole::SISWA) {
        \Log::info('Whiteboard channel: Student authorized', ['user' => $user->id]);
        return ['id' => $user->id, 'name' => $user->name, 'role' => 'siswa'];
    }

    \Log::info('Whiteboard channel: Authorization failed', [
        'user_id' => $user->id,
        'user_kelas_id' => $user->kelas_id,
        'jadwal_kelas_id' => $jadwal->kelas_id,
        'user_role' => $user->role?->value,
    ]);

    return false;
});
