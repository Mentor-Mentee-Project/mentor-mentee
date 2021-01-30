<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function career()
    {
        return $this->belongsTo('App\Models\Career', 'career_id');
    }

    //purposeの取得
    public function purposes()
    {
        return $this->belongsToMany('App\Models\Purpose', 'profile_purposes');
    }

    //skillの取得
    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill', 'profile_skills');
    }

    public function profileUrls()
    {
        return $this->hasMany('App\Models\ProfileUrl');
    }

    //urlの取得
    public function urls()
    {
        return $this->belongsToMany('App\Models\Url', 'profile_urls')->withPivot('url_id')->orderBy(
            'profile_urls.url_id'
        );
    }

    public function modify($request): void
    {
        $this->fill(
            [
                'goal' => $request->goal,
                'career_id' => $request->career,
            ]
        )->save();
        $this->purposes()->sync($request->get('purpose', []));
        $this->skills()->sync($request->get('skill', []));
    }

    public static function make($user_id)
    {
        return self::create(
            [
                'user_id' => $user_id,
            ]
        );
    }
}
