<?php
namespace App\Policies;

use App\Models\Film;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilmPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Film $film): bool
    {
        return $user !== null;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Film $film): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Film $film): bool
    {
        return $user->role === 'admin';
    }
}
