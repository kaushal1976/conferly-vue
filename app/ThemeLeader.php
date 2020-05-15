<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThemeLeader extends Model
{
    protected $visible = [
        'user'
    ];
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeOfUserEmail($query, $email)
    {
        return $query->where('users.email', $email)
            ->join('users', 'theme_leaders.user_id', '=', 'users.id')
            ->join('themes', 'theme_leaders.theme_id', '=', 'themes.id');
    }
    public function ofScopeTheme($query, $themeId)
    {
        return $query->where('theme_id', '=', $themeId);
    }
}
