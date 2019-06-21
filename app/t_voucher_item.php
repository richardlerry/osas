<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $vouch_id
 * @property int $vouchI_id
 * @property string $itemName
 * @property float $amount
 * @property string $created_at
 * @property string $updated_at
 * @property RVoucher $rVoucher
 */
class t_voucher_item extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'vouchI_id';

    /**
     * @var array
     */
    protected $fillable = ['vouch_id', 'itemName', 'amount', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rVoucher()
    {
        return $this->belongsTo(r_voucher::class, 'vouch_id', 'vouch_id');
    }
}
