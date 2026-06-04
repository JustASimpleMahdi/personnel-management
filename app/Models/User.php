<?php

namespace App\Models;

use App\UserShiftEnum;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['firstname',
    'lastname',
    'username',
    'password',
    'national_code',
    'salary',
    'phone',
    'address',
    'shift',
    'role_id'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use HasFactory, Notifiable;
    use Authorizable, Authenticatable;

    public function reports(): HasMany{
        return $this->hasMany(Report::class);
    }
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function redirectRoute(): string
    {
        return route($this->role->key->value . '.index');
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'shift' => UserShiftEnum::class
        ];
    }

    protected function fullname(): Attribute
    {
        return Attribute::get(fn() => $this->firstname . ' ' . $this->lastname);
    }
}
