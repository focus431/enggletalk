<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassSchedule;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Essay;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'role',
        'first_name',
        'last_name',
        'gender',
        'password',
        'email',
        'rate',
        'date_of_birth',
        'blood_group',
        'mobile',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'avatar_path',
        'activated',
        'activation_code',
        'google_meet_code',
        'about_me',
        'education_background',
        'youtube_link',
        'created_at',
        'updated_at',
        't_duration',
        't_expired',
        't_classes',  // 總課程數量
        'remaining_classes', // 剩餘課程數量
        'is_online',
        'preferred_language',
        'timezone',
        'completionPercentage',
        'bank_name',           // 銀行名稱
        'branch_name',         // 分行名稱
        'swift_code',          // SWIFT 代碼
        'account_number',      // 帳戶號碼
        'account_holder_name',
        'line_id',      // 新增字段
    'promo_code',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 獲取用戶頭像的存儲路徑
     *
     * @return string 存儲路徑
     */
    public function getAvatarPathAttribute()
    {
        // 如果模型中有一個 'avatar_path' 屬性，則使用它。
        // 否則，返回預設的頭像路徑。
        return $this->attributes['avatar_path'] ?? 'default-avatar.jpg';
    }

    // 在 User 模型中
    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'mentor_courses', 'user_id', 'course_id');
    }

    public function isMentee()
    {
        // 假設 'mentee' 是代表 Mentee 角色的值
        return $this->role === 'mentee';
    }


    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id', 'id');
    }




    /**
     * 用户的最喜欢的老师
     */
    public function favoriteMentors()
    {
        return $this->belongsToMany(User::class, 'favorites', 'user_id', 'mentor_id');
    }





    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class, 'user_id');
    }

    // 在 User 模型中
    protected $dates = ['t_expired'];

    /**
     * 設定 preferred_language 時自動標準化語言代碼
     */
    public function setPreferredLanguageAttribute($value)
    {
        $this->attributes['preferred_language'] = $this->normalizeChineseLocale($value);
    }

    /**
     * 標準化中文語言代碼
     */
    private function normalizeChineseLocale(?string $locale): string
    {
        if (!$locale) {
            return config('app.fallback_locale');
        }

        // 處理各種可能的中文語言代碼格式
        switch (strtolower($locale)) {
            case 'zh':
            case 'zh-tw':
            case 'zh_tw':
            case 'zhtw':
                return 'zh_TW';
            
            case 'zh-cn':
            case 'zh_cn':
            case 'zhcn':
                return 'zh_CN';
            
            default:
                return $locale;
        }
    }

    public function essays()
    {
        return $this->hasMany(Essay::class);
    }
}
