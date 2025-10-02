<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class RestoreUser extends Command
{
    /**
     * Nombre y firma del comando.
     *
     * php artisan user:restore email@example.com
     */
    protected $signature = 'user:restore {email}';

    /**
     * Descripción del comando.
     */
    protected $description = 'Restaura un usuario eliminado con SoftDeletes usando su email';

    /**
     * Ejecutar el comando.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $user = User::onlyTrashed()->where('email', $email)->first();

        if (!$user) {
            $this->error("No se encontró el usuario con email: {$email} en papelera.");
            return 1;
        }

        $user->restore();

        $this->info("✅ Usuario {$email} restaurado correctamente.");
        return 0;
    }
}
