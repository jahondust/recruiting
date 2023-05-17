<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resume extends Model
{
    use HasFactory, CreatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "description",
        "avatar",
        "experience",
        "education",
        "salary",
        "created_by",
    ];

    /**
     * Positions
     *
     * @param null
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'resume_positions', 'resume_id', 'position_id');
    }

    /**
     * Author
     *
     * @param null
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Skills
     *
     * @param null
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'resume_skills', 'resume_id', 'skill_id');
    }

    /**
     * Portfolios
     *
     * @param null
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function portfolios(): HasMany
    {
        return $this->hasMany(ResumePortfolio::class);
    }

    /**
     * Languages
     *
     * @param null
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'resume_languages', 'resume_id', 'language_id')->withPivot('level');
    }

    /**
     * Views
     *
     * @param null
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function views(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'resume_views', 'resume_id', 'user_id');
    }

    /**
     * Views Count Attribute
     *
     * @param null
     * @return int
     */
    public function getViewsCountAttribute(): int
    {
        return $this->views()->count();
    }
}
