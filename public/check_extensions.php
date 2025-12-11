<?php
/**
 * Script de diagnostic des extensions PHP
 * Vérifie l'état des extensions nécessaires pour Laravel/MySQL
 * 
 * SUPPRIMEZ CE FICHIER APRÈS UTILISATION pour des raisons de sécurité
 */

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic des extensions PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
        }
        .extension {
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border-left: 4px solid;
        }
        .ok {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }
        .warning {
            background-color: #fff3cd;
            border-color: #ffc107;
            color: #856404;
        }
        .info {
            background-color: #d1ecf1;
            border-color: #17a2b8;
            color: #0c5460;
            margin-top: 20px;
        }
        .status {
            font-weight: bold;
            font-size: 1.1em;
        }
        code {
            background-color: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Diagnostic des extensions PHP</h1>
        
        <?php
        $extensions = [
            'mysqli' => 'Extension MySQLi (requise pour certaines connexions MySQL)',
            'pdo_mysql' => 'Extension PDO MySQL (utilisée par Laravel)',
            'pdo' => 'Extension PDO (requise pour PDO MySQL)',
            'mbstring' => 'Extension mbstring (requise par Laravel)',
            'openssl' => 'Extension OpenSSL (requise par Laravel)',
            'json' => 'Extension JSON (requise par Laravel)',
            'curl' => 'Extension cURL (souvent requise)',
        ];
        
        $allOk = true;
        $critical = ['mysqli', 'pdo_mysql', 'pdo'];
        
        foreach ($extensions as $ext => $description) {
            $loaded = extension_loaded($ext);
            $isCritical = in_array($ext, $critical);
            
            if (!$loaded && $isCritical) {
                $allOk = false;
            }
            
            $class = $loaded ? 'ok' : ($isCritical ? 'error' : 'warning');
            $status = $loaded ? '✅ Activée' : '❌ Non activée';
            
            echo "<div class='extension $class'>";
            echo "<div class='status'>$status</div>";
            echo "<strong>$ext</strong> - $description";
            if (!$loaded && $isCritical) {
                echo "<br><small>⚠️ Cette extension est CRITIQUE et doit être activée !</small>";
            }
            echo "</div>";
        }
        
        // Informations supplémentaires
        echo "<div class='extension info'>";
        echo "<h3>📋 Informations système</h3>";
        echo "<strong>Version PHP :</strong> " . PHP_VERSION . "<br>";
        echo "<strong>Fichier php.ini :</strong> " . php_ini_loaded_file() . "<br>";
        
        $additionalIni = php_ini_scanned_files();
        if ($additionalIni) {
            echo "<strong>Fichiers ini supplémentaires :</strong> " . $additionalIni . "<br>";
        }
        
        echo "<br><strong>Extensions chargées :</strong><br>";
        $loadedExts = get_loaded_extensions();
        sort($loadedExts);
        echo "<code>" . implode(', ', $loadedExts) . "</code>";
        echo "</div>";
        
        // Résumé
        if ($allOk) {
            echo "<div class='extension ok'>";
            echo "<h3>✅ Toutes les extensions critiques sont activées !</h3>";
            echo "Votre configuration PHP semble correcte.";
            echo "</div>";
        } else {
            echo "<div class='extension error'>";
            echo "<h3>⚠️ Action requise</h3>";
            echo "Certaines extensions critiques ne sont pas activées. ";
            echo "Consultez le fichier <code>ACTIVER_MYSQLI.md</code> à la racine du projet pour les instructions d'activation.";
            echo "</div>";
        }
        ?>
        
        <div class="extension info" style="margin-top: 30px;">
            <strong>⚠️ Sécurité :</strong> Supprimez ce fichier après utilisation !
            <br><small>Ce fichier expose des informations sensibles sur votre configuration PHP.</small>
        </div>
    </div>
</body>
</html>

