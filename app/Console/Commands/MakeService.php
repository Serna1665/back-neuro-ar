<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    protected $signature = 'make:service {module} {name}';
    protected $description = 'Crea un nuevo servicio en la estructura modular extendiendo de BaseService';

    public function handle()
    {
        $module = ucfirst($this->argument('module')); // Nombre del módulo (Usuarios, Productos, etc.)
        $name = $this->argument('name');             // Nombre del servicio
        $path = base_path("app/Http/Modules/{$module}/Service");

        // Verificar y crear la carpeta si no existe
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $filePath = "{$path}/{$name}.php";

        // Crear el namespace dinámicamente
        $namespace = "App\\Http\\Modules\\{$module}\\Service";

        // Stub del contenido del servicio sin constructor
        $stub = <<<PHP
<?php

namespace {$namespace};

use App\Services\BaseService;

class {$name} extends BaseService
{
    // Aquí puedes agregar métodos específicos para {$name}
}
PHP;

        // Crear el archivo si no existe
        if (File::exists($filePath)) {
            $this->error("El servicio {$name} ya existe en {$path}");
            return;
        }

        File::put($filePath, $stub);
        $this->info("Servicio {$name} creado exitosamente en {$filePath}");
    }
}
