# Script PowerShell pour corriger tous les problemes detectes
# Ce script automatise la correction des erreurs

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Correction des problemes detectes" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

$errors = @()
$warnings = @()
$success = @()

# 1. Verifier la version PHP actuelle
Write-Host "1. Verification de la version PHP..." -ForegroundColor Yellow
$phpVersionOutput = php -v 2>&1 | Out-String
$phpVersion = ""
if ($phpVersionOutput -match "PHP (\d+\.\d+\.\d+)") {
    $phpVersion = $matches[1]
}
Write-Host "   Version actuelle: PHP $phpVersion" -ForegroundColor $(if ($phpVersion -match "^7\.") { "Green" } else { "Red" })

if ($phpVersion -notmatch "^7\.") {
    $errors += "PHP $phpVersion est actif (necessite PHP 7.x)"
    Write-Host "   [AVERTISSEMENT] Version incorrecte!" -ForegroundColor Red
    
    # Essayer de changer la version PHP dans WAMP
    Write-Host "   Tentative de changement vers PHP 7.4.33..." -ForegroundColor Yellow
    $wampConfigPath = "C:\wamp64\wampmanager.conf"
    $targetVersion = "php7.4.33"
    
    if (Test-Path $wampConfigPath) {
        try {
            $config = Get-Content $wampConfigPath -Raw
            $pattern = 'phpVersion\s*=\s*"[^"]*"'
            if ($config -match $pattern) {
                $newConfig = $config -replace $pattern, "phpVersion = `"$targetVersion`""
                $newConfig | Set-Content $wampConfigPath -NoNewline
                $warnings += "Configuration WAMP modifiee. REDEMARREZ WAMP pour appliquer les changements!"
                Write-Host "   [OK] Configuration modifiee" -ForegroundColor Green
                Write-Host "   [IMPORTANT] REDEMARREZ WAMP maintenant!" -ForegroundColor Yellow
            }
        } catch {
            $errors += "Impossible de modifier automatiquement la configuration WAMP"
            Write-Host "   [ERREUR] Impossible de modifier automatiquement" -ForegroundColor Red
        }
    } else {
        $errors += "Fichier de configuration WAMP non trouve"
        Write-Host "   [ERREUR] Fichier de configuration non trouve" -ForegroundColor Red
    }
} else {
    $success += "Version PHP correcte: $phpVersion"
    Write-Host "   [OK] Version PHP correcte" -ForegroundColor Green
}

Write-Host ""

# 2. Verifier les extensions MySQL
Write-Host "2. Verification des extensions MySQL..." -ForegroundColor Yellow
$phpModules = php -m 2>&1 | Out-String
$mysqli = $phpModules -match "mysqli"
$pdo_mysql = $phpModules -match "pdo_mysql"

if ($mysqli) {
    $success += "Extension mysqli: OK"
    Write-Host "   [OK] mysqli: Activee" -ForegroundColor Green
} else {
    $errors += "Extension mysqli manquante"
    Write-Host "   [ERREUR] mysqli: Non activee" -ForegroundColor Red
}

if ($pdo_mysql) {
    $success += "Extension pdo_mysql: OK"
    Write-Host "   [OK] pdo_mysql: Activee" -ForegroundColor Green
} else {
    $errors += "Extension pdo_mysql manquante"
    Write-Host "   [ERREUR] pdo_mysql: Non activee" -ForegroundColor Red
}

Write-Host ""

# 3. Verifier le dossier vendor
Write-Host "3. Verification du dossier vendor..." -ForegroundColor Yellow
if (Test-Path "vendor") {
    $success += "Dossier vendor: Existe"
    Write-Host "   [OK] Dossier vendor existe" -ForegroundColor Green
} else {
    $errors += "Dossier vendor manquant"
    Write-Host "   [ERREUR] Dossier vendor manquant" -ForegroundColor Red
    
    # Verifier si on peut installer avec la version PHP actuelle
    if ($phpVersion -match "^7\.") {
        Write-Host "   Tentative d'installation des dependances..." -ForegroundColor Yellow
        Write-Host "   (Cela peut prendre plusieurs minutes)" -ForegroundColor Gray
        
        try {
            $composerOutput = composer install 2>&1
            if ($LASTEXITCODE -eq 0) {
                $success += "Dependances installees avec succes"
                Write-Host "   [OK] Dependances installees" -ForegroundColor Green
            } else {
                $errors += "Echec de l'installation des dependances"
                Write-Host "   [ERREUR] Echec de l'installation" -ForegroundColor Red
                Write-Host "   Dernieres lignes d'erreur:" -ForegroundColor Yellow
                $composerOutput | Select-Object -Last 5 | ForEach-Object { Write-Host "   $_" -ForegroundColor Gray }
            }
        } catch {
            $errors += "Erreur lors de l'installation: $_"
            Write-Host "   [ERREUR] Erreur: $_" -ForegroundColor Red
        }
    } else {
        $warnings += "Impossible d'installer les dependances avec PHP $phpVersion. Changez vers PHP 7.4.33 d'abord."
        Write-Host "   [AVERTISSEMENT] Changez d'abord vers PHP 7.4.33" -ForegroundColor Yellow
    }
}

Write-Host ""

# 4. Verifier le fichier .env
Write-Host "4. Verification du fichier .env..." -ForegroundColor Yellow
if (Test-Path ".env") {
    $envContent = Get-Content .env -Raw
    $hasDbConfig = $envContent -match "DB_CONNECTION=mysql" -and 
                   $envContent -match "DB_DATABASE=fondation" -and 
                   $envContent -match "DB_USERNAME=root"
    
    if ($hasDbConfig) {
        $success += "Fichier .env: Configuration MySQL correcte"
        Write-Host "   [OK] Configuration .env correcte" -ForegroundColor Green
    } else {
        $warnings += "Fichier .env existe mais la configuration MySQL pourrait etre incomplete"
        Write-Host "   [AVERTISSEMENT] Verifiez la configuration MySQL dans .env" -ForegroundColor Yellow
    }
} else {
    $errors += "Fichier .env manquant"
    Write-Host "   [ERREUR] Fichier .env manquant" -ForegroundColor Red
}

Write-Host ""

# 5. Verifier la cle APP_KEY
Write-Host "5. Verification de la cle APP_KEY..." -ForegroundColor Yellow
if (Test-Path ".env") {
    $envContent = Get-Content .env
    $appKey = $envContent | Select-String "^APP_KEY="
    if ($appKey -and $appKey -notmatch "^APP_KEY=$") {
        $success += "APP_KEY: Configuree"
        Write-Host "   [OK] APP_KEY configuree" -ForegroundColor Green
    } else {
        $warnings += "APP_KEY non configuree dans .env"
        Write-Host "   [AVERTISSEMENT] APP_KEY non configuree" -ForegroundColor Yellow
        
        if ($phpVersion -match "^7\." -and (Test-Path "vendor")) {
            Write-Host "   Generation de la cle..." -ForegroundColor Yellow
            try {
                php artisan key:generate --ansi 2>&1 | Out-Null
                if ($LASTEXITCODE -eq 0) {
                    $success += "APP_KEY generee avec succes"
                    Write-Host "   [OK] APP_KEY generee" -ForegroundColor Green
                } else {
                    Write-Host "   [ERREUR] Impossible de generer la cle" -ForegroundColor Red
                }
            } catch {
                Write-Host "   [ERREUR] Impossible de generer la cle" -ForegroundColor Red
            }
        }
    }
}

Write-Host ""

# Resume
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  RESUME" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

if ($success.Count -gt 0) {
    Write-Host "[OK] Succes ($($success.Count)):" -ForegroundColor Green
    $success | ForEach-Object { Write-Host "  - $_" -ForegroundColor Green }
    Write-Host ""
}

if ($warnings.Count -gt 0) {
    Write-Host "[AVERTISSEMENT] Avertissements ($($warnings.Count)):" -ForegroundColor Yellow
    $warnings | ForEach-Object { Write-Host "  - $_" -ForegroundColor Yellow }
    Write-Host ""
}

if ($errors.Count -gt 0) {
    Write-Host "[ERREUR] Erreurs ($($errors.Count)):" -ForegroundColor Red
    $errors | ForEach-Object { Write-Host "  - $_" -ForegroundColor Red }
    Write-Host ""
}

# Actions requises
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  ACTIONS REQUISES" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

if ($phpVersion -notmatch "^7\.") {
    Write-Host "1. REDEMARREZ WAMP:" -ForegroundColor Yellow
    Write-Host "   - Cliquez sur l'icone WAMP -> Quitter" -ForegroundColor White
    Write-Host "   - Relancez WAMP" -ForegroundColor White
    Write-Host "   - PHP -> Version PHP -> Selectionnez php7.4.33" -ForegroundColor White
    Write-Host ""
    Write-Host "2. Apres le redemarrage, reexecutez ce script:" -ForegroundColor Yellow
    Write-Host "   .\corriger_problemes.ps1" -ForegroundColor White
    Write-Host ""
} elseif (-not (Test-Path "vendor")) {
    Write-Host "1. Installez les dependances:" -ForegroundColor Yellow
    Write-Host "   composer install" -ForegroundColor White
    Write-Host ""
    Write-Host "2. Generez la cle d'application:" -ForegroundColor Yellow
    Write-Host "   php artisan key:generate" -ForegroundColor White
    Write-Host ""
} else {
    Write-Host "[OK] Tous les problemes principaux sont resolus!" -ForegroundColor Green
    Write-Host ""
    Write-Host "Vous pouvez maintenant utiliser votre application Laravel." -ForegroundColor Green
    Write-Host ""
    Write-Host "Commandes utiles:" -ForegroundColor Cyan
    Write-Host "  php artisan --version    # Verifier la version Laravel" -ForegroundColor White
    Write-Host "  php artisan migrate      # Executer les migrations" -ForegroundColor White
    Write-Host "  php artisan serve        # Demarrer le serveur de developpement" -ForegroundColor White
}

Write-Host ""
