<?php
    
 Class C_Enviroment{

    public static function loadEnv($filePath)
    {
        if (!file_exists($filePath)) {
            throw new Exception("El archivo .env no existe en la ruta especificada.");
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue; // Ignorar comentarios
            }
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }

 }
?>