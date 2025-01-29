<?php

namespace App\Policies;

use App\Models\Essay;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EssayPolicy
{
    use HandlesAuthorization;

    /**
     * 確定用戶是否可以查看特定作文
     */
    public function view(User $user, Essay $essay): bool
    {
        return $user->id === $essay->user_id;
    }

    /**
     * 確定用戶是否可以創建作文
     */
    public function create(User $user): bool
    {
        return true; // 所有已登入用戶都可以創建作文
    }

    /**
     * 確定用戶是否可以更新作文
     */
    public function update(User $user, Essay $essay): bool
    {
        return $user->id === $essay->user_id;
    }

    /**
     * 確定用戶是否可以刪除作文
     */
    public function delete(User $user, Essay $essay): bool
    {
        return $user->id === $essay->user_id;
    }
} 