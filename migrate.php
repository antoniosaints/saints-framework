<?php

class MigrationGenerator
{
    public static function generate(string $migrationName)
    {
        $timestamp = date('YmdHis');
        $migrationFilename = "$timestamp" . "_$migrationName.php";
        $migrationContent = "<?php\n\n// Migration file generated at " . date('Y-m-d H:i:s') . "\n\n";
        $migrationContent .= "class $migrationName\n{\n";
        $migrationContent .= "    public function up()\n    {\n        // Escreva o código SQL para aplicar a migração aqui\n    }\n\n";
        $migrationContent .= "    public function down()\n    {\n        // Escreva o código SQL para reverter a migração aqui\n    }\n}\n";

        // Define o diretório onde os arquivos de migração serão salvos
        $migrationDirectory = __DIR__ . '/migrations/';

        // Verifica se o diretório de migrações existe, senão, cria-o
        if (!file_exists($migrationDirectory)) {
            mkdir($migrationDirectory, 0777, true);
        }

        // Cria o arquivo de migração e escreve o conteúdo
        file_put_contents($migrationDirectory . $migrationFilename, $migrationContent);

        echo "Migration '$migrationFilename' gerada com sucesso!\n";
    }
}

// Verifica se o comando para gerar a migração foi fornecido
if ($argc < 2) {
    die("Usage: php generate-migration.php <migration_name>\n");
}

// Obtém o nome da migração a ser gerada
$migrationName = $argv[1];

// Gera a migração
MigrationGenerator::generate($migrationName);