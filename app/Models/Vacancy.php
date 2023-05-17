<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vacancy extends Model
{
    use HasFactory, CreatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "requirements",
        "conditions",
        "salary",
        "position_id",
        "created_by",
    ];

    /**
     * Position
     *
     * @param null
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
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
        return $this->belongsToMany(Skill::class, 'vacancy_skills', 'vacancy_id', 'skill_id');
    }

    /**
     * Responses
     *
     * @param null
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function responses(): BelongsToMany
    {
        return $this->belongsToMany(Resume::class, 'vacancy_responses', 'vacancy_id', 'resume_id')
            ->with(['author'])
            ->withPivot(['status', 'created_at']);
    }

    /**
     * Views
     *
     * @param null
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function views(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'vacancy_views', 'vacancy_id', 'user_id');
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
