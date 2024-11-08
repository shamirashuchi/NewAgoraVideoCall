<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends BaseModel
{
    protected $table = 'jb_packages';

    protected $fillable = [
        'name',
        'price',
        'currency_id',
        'percent_save',
        'number_of_listings',
        'account_limit',
        'order',
        'is_default',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class)->withDefault();
    }

    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'jb_account_packages', 'package_id', 'account_id');
    }

    public function getTotalPriceAttribute(): float
    {
        return $this->price - ($this->price * $this->percent_save / 100);
    }

    public function getPriceTextAttribute(): string
    {
        return format_price($this->price, $this->currency);
    }

    public function getPricePerJobTextAttribute(): string
    {
        return __(':price / per job', ['price' => format_price($this->price / $this->number_of_listings, $this->currency)]);
    }

    public function getNumberJobsFreeAttribute(): string
    {
        return __('Free :number job(s)', ['number' => $this->number_of_listings]);
    }

    public function getPriceTextWithSaleOffAttribute(): string
    {
        return __(':price Total :percentage_sale', ['price' => $this->price_text, 'percentage_sale' => $this->percent_save_text]);
    }

    public function getPercentSaveTextAttribute(): string
    {
        $text = '';

        if ($this->percent_save) {
            $text .= ' ' . __('(save :percentage %)', ['percentage' => $this->percent_save]);
        }

        return $text;
    }

    public function isPurchased(): bool
    {
        return $this->account_limit && $this->accounts_count >= $this->account_limit;
    }
}
