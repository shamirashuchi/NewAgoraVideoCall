<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\JobBoard\Enums\ModerationStatusEnum;
use Botble\JobBoard\Enums\SalaryRangeEnum;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\DB;
use RvMedia;

class Job extends BaseModel
{
    protected $table = 'jb_jobs';

    protected $fillable = [
        'name',
        'description',
        'content',
        'company_id',
        'address',
        'status',
        'apply_url',
        'is_freelance',
        'career_level_id',
        'salary_from',
        'salary_to',
        'salary_range',
        'currency_id',
        'degree_level_id',
        'job_shift_id',
        'job_experience_id',
        'functional_area_id',
        'hide_salary',
        'number_of_positions',
        'expire_date',
        'author_id',
        'author_type',
        'views',
        'number_of_applied',
        'hide_company',
        'latitude',
        'longitude',
        'auto_renew',
        'is_featured',
        'external_apply_clicks',
        'country_id',
        'state_id',
        'city_id',
        'employer_colleagues',
        'start_date',
        'application_closing_date',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'moderation_status' => ModerationStatusEnum::class,
        'salary_range' => SalaryRangeEnum::class,
        'expire_date' => 'datetime',
        'application_closing_date' => 'datetime',
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(JobSkill::class, 'jb_jobs_skills', 'job_id', 'job_skill_id');
    }

    public function careerLevel(): BelongsTo
    {
        return $this->belongsTo(CareerLevel::class, 'career_level_id')->withDefault();
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class)->withDefault();
    }

    public function degreeLevel(): BelongsTo
    {
        return $this->belongsTo(DegreeLevel::class, 'degree_level_id')->withDefault();
    }

    public function jobShift(): BelongsTo
    {
        return $this->belongsTo(JobShift::class, 'job_shift_id')->withDefault();
    }

    public function jobExperience(): BelongsTo
    {
        return $this->belongsTo(JobExperience::class, 'job_experience_id')->withDefault();
    }

    public function functionalArea(): BelongsTo
    {
        return $this->belongsTo(FunctionalArea::class, 'functional_area_id')->withDefault();
    }

    public function jobTypes(): BelongsToMany
    {
        return $this->belongsToMany(JobType::class, 'jb_jobs_types', 'job_id', 'job_type_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id')->withDefault();
    }

    public function author(): MorphTo
    {
        return $this->morphTo()->withDefault();
    }

    public function getSalaryTextAttribute(): string
    {
        if ($this->hide_salary) {
            return __('Attractive');
        }

        if ($this->salary_from && $this->salary_to) {
            $salary = format_price($this->salary_from) . ((float)$this->salary_to > 0 ? ' - ' . format_price($this->salary_to) : null);

            return $salary . '/' . strtolower($this->salary_range->label());
        }

        if ($this->salary_to) {
            return __('Upto :price', ['price' => format_price($this->salary_to)]);
        }

        return __('Attractive');
    }

    public function scopeNotExpired(Builder $query): Builder
    {
        return $query->where(function ($query) {
            $query
                ->where('expire_date', '>=', now()->toDateTimeString())
                ->orWhere('never_expired', true);
        });
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->where(function ($query) {
            $query
                ->where('expire_date', '<', now()->toDateTimeString())
                ->where('never_expired', false);
        });
    }

    public function scopeAddSavedApplied(Builder $query): Builder
    {
        if (auth('account')->check()) {
            $query->addApplied()->addSaved();
        }

        return $query;
    }

    public function scopeAddApplied(Builder $query): Builder
    {
        if (! auth('account')->check() || auth('account')->user()->isEmployer()) {
            return $query;
        }

        $accountId = auth('account')->id();

        return $query
            ->leftJoin('jb_applications', function ($join) use ($accountId) {
                $join
                    ->on('jb_applications.job_id', '=', 'jb_jobs.id')
                    ->where('jb_applications.account_id', $accountId);
            })
            ->addSelect(DB::raw('IF(jb_applications.job_id IS NULL, 0, jb_applications.job_id) AS is_applied'))
            ->addSelect('jb_jobs.*');
    }

    public function scopeAddSaved(Builder $query): Builder
    {
        if (! auth('account')->check() || auth('account')->user()->isEmployer()) {
            return $query;
        }

        $accountId = auth('account')->id();

        return $query
            ->leftJoin('jb_saved_jobs', function ($join) use ($accountId) {
                $join
                    ->on('jb_saved_jobs.job_id', '=', 'jb_jobs.id')
                    ->where('jb_saved_jobs.account_id', $accountId);
            })
            ->addSelect(DB::raw('IF(jb_saved_jobs.job_id IS NULL, 0, jb_saved_jobs.job_id) AS is_saved'))
            ->addSelect('jb_jobs.*');
    }

    public function scopeByAccount(Builder $query, int $accountId): Builder
    {
        return $query->where(function (Builder $query) use ($accountId) {
            $query->where([
                'jb_jobs.author_id' => $accountId,
                'jb_jobs.author_type' => Account::class,
            ])
                ->orWhereHas('company.accounts', function (Builder $query) use ($accountId) {
                    $query->where('jb_companies_accounts.account_id', $accountId);
                });
        });
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'jb_jobs_categories', 'job_id', 'category_id');
    }

    public function savedJobs(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'jb_saved_jobs', 'job_id', 'account_id');
    }

    public function applicants(): HasMany
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

    public function analytics(): HasMany
    {
        return $this->hasMany(Analytics::class, 'job_id');
    }

    public function canShowSavedJob(): bool
    {
        return $this->is_saved !== -1;
    }

    public function canShowApplyJob(): bool
    {
        if (! auth('account')->check()) {
            return true;
        }

        if (auth('account')->user()->isEmployer()) {
            return false;
        }

        return $this->is_applied !== -1;
    }

    public function getHasCompanyAttribute(): bool
    {
        return ! $this->hide_company && $this->company->id;
    }

    public function getCompanyLogoThumbAttribute(): string
    {
        if ($this->has_company) {
            return $this->company->logo_thumb;
        }

        $logo = theme_option('default_company_logo', theme_option('logo'));

        return RvMedia::getImageUrl($logo, null, false, RvMedia::getDefaultImage());
    }

    public function getCompanyNameAttribute(): ?string
    {
        if ($this->has_company) {
            return $this->company->name;
        }

        return null;
    }

    public function getCompanyUrlAttribute(): ?string
    {
        if ($this->has_company) {
            return $this->company->url;
        }

        return null;
    }

    public function getIsExpiredAttribute(): bool
    {
        if (! $this->expire_date || $this->never_expired) {
            return false;
        }

        return $this->expire_date->lte(now());
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Tag::class,
            'jb_jobs_tags',
            'job_id',
            'tag_id'
        );
    }

    public function getEmployerColleaguesAttribute(?string $value): array
    {
        try {
            return json_decode((string)$value, true) ?: [];
        } catch (Exception) {
            return [];
        }
    }

    public function setEmployerColleaguesAttribute(array $employerColleagues)
    {
        $this->attributes['employer_colleagues'] = $employerColleagues ? json_encode($employerColleagues, true) : '';
    }

    public function getEmployerEmailsAttribute(): array
    {
        $emails = [];

        if ($this->author->email) {
            $emails[] = $this->author->email;
        }

        if (! empty($this->employer_colleagues)) {
            $emails = array_merge($emails, $this->employer_colleagues);
        }

        return $emails;
    }

    public function getLocationAttribute(): ?string
    {
        $displayType = setting('job_board_job_location_display', 'state_and_country');

        return match ($displayType) {
            'city_state_and_country' => ($this->city_name ? $this->city_name . ', ' : '') . ($this->state_name ? $this->state_name . ', ' : '') . $this->country->code,
            'city_and_state' => ($this->city_name ? $this->city_name . ', ' : '') . $this->state_name,
            default => ($this->state_name ? $this->state_name . ', ' : '') . $this->country->code,
        };
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (Job $job) {
            $job->analytics()->delete();
            $job->applicants()->delete();
            $job->savedJobs()->detach();
            $job->skills()->detach();
            $job->jobTypes()->detach();
            $job->categories()->detach();
            $job->tags()->detach();
        });
    }
}
