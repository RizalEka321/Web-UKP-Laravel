<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KerjasamaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // KerjasamaPolicy.php

    public function viewAny(User $user)
    {
        return $user->role === 'admin' || $user->role === 'prodi';
    }

    public function view(User $user, Kerjasama $kerjasama)
    {
        // Pemeriksaan tambahan, misalnya, hanya memperbolehkan prodi melihat data kerjasama yang terkait dengan prodi mereka.
        if ($user->role === 'prodi') {
            return $kerjasama->prodi->contains('nama_prodi', $user->nama_prodi);
        }

        return true; // Admin dapat melihat semua data kerjasama.
    }

}
