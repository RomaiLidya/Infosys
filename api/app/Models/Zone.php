<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'Zone';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'repaymentDay',
        'description',
        'isDeleted',
        'deletedAt'
    ];

    protected $attributes = [
        'isDeleted' => false,
    ];

    protected $guarded = [];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
