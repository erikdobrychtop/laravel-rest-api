<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Caminho base dos serviços
        $servicesPath = app_path('Services');

        // Buscar todos os arquivos PHP no diretório Services
        $serviceFiles = glob($servicesPath . '/*.php');

        foreach ($serviceFiles as $file) {
            // Obter o nome completo da classe com base no caminho do arquivo
            $className = 'App\\Services\\' . basename($file, '.php');

            // Verificar se a classe existe
            if (class_exists($className)) {
                // Registrar automaticamente a classe no container
                $this->app->singleton($className, function ($app) use ($className) {
                    return new $className();
                });
            }
        }
    }

    public function boot()
    {
        // Métodos adicionais
    }
}
