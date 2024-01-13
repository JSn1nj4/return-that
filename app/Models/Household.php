<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Models\Household
 *
 * @property int $id
 * @property string $nickname
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\HouseholdFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Household newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Household newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Household query()
 * @method static \Illuminate\Database\Eloquent\Builder|Household whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Household whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Household whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Household whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Household extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
