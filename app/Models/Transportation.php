<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transportation
 *
 * @property int $id
 * @property string $city
 * @property int $complete
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation whereComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transportation whereUserId($value)
 * @mixin \Eloquent
 */
class Transportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
