# Script PowerShell pour changer la version PHP dans WAMP64
# Ce script change la version PHP active vers PHP 7.4.33 pour la compatibilité avec Laravel 7

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Changement de version PHP dans WAMP" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Vérifier la version actuelle
Write-Host "Version PHP actuelle:" -ForegroundColor Yellow
$currentVersion = php -v 2>&1 | Select-String "PHP (\d+\.\d+\.\d+)" | ForEach-Object { $_.Matches.Groups[1].Value }
Write-Host "  $currentVersion" -ForegroundColor $(if ($currentVersion -match "^7\.") { "Green" } else { "Red" })
Write-Host ""

# Lister les versions disponibles
Write-Host "Versions PHP disponibles dans WAMP:" -ForegroundColor Cyan
$wampPhpPath = "C:\wamp64\bin\php"
$availableVersions = @()

if (Test-Path $wampPhpPath) {
    $phpDirs = Get-ChildItem -Path $wampPhpPath -Directory -Filter "php*" | Sort-Object Name
    foreach ($dir in $phpDirs) {
        $version = $dir.Name
        $availableVersions += $version
        $isCurrent = $version -eq "php$($currentVersion -replace '\.', '.')"
        $marker = if ($isCurrent) { " ← ACTUELLE" } else { "" }
        $color = if ($version -eq "php7.4.33") { "Green" } elseif ($isCurrent) { "Yellow" } else { "Gray" }
        Write-Host "  $version$marker" -ForegroundColor $color
    }
} else {
    Write-Host "  ERREUR: Dossier WAMP non trouvé: $wampPhpPath" -ForegroundColor Red
    exit 1
}

Write-Host ""

# Vérifier si PHP 7.4.33 est disponible
$targetVersion = "php7.4.33"
if (-not ($availableVersions -contains $targetVersion)) {
    Write-Host "ERREUR: Version $targetVersion non trouvée dans WAMP" -ForegroundColor Red
    Write-Host "Versions disponibles: $($availableVersions -join ', ')" -ForegroundColor Yellow
    exit 1
}

# Vérifier si déjà sur la bonne version
if ($currentVersion -match "^7\.4") {
    Write-Host "Vous utilisez déjà PHP 7.4.x" -ForegroundColor Green
    Write-Host "Aucun changement nécessaire." -ForegroundColor Green
    exit 0
}

Write-Host "Changement vers $targetVersion..." -ForegroundColor Yellow
Write-Host ""

# Instructions pour changer via l'interface WAMP
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  INSTRUCTIONS MANUELLES" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Pour changer la version PHP dans WAMP:" -ForegroundColor Yellow
Write-Host ""
Write-Host "1. Cliquez sur l'icône WAMP dans la barre des tâches" -ForegroundColor White
Write-Host "2. Allez dans: PHP → Version PHP" -ForegroundColor White
Write-Host "3. Sélectionnez: $targetVersion" -ForegroundColor Green
Write-Host "4. WAMP redémarrera automatiquement" -ForegroundColor White
Write-Host ""
Write-Host "OU" -ForegroundColor Cyan
Write-Host ""
Write-Host "Utilisez cette commande PowerShell (en tant qu'administrateur):" -ForegroundColor Yellow
Write-Host ""
Write-Host "  `$wampMenu = [System.Windows.Forms.NotifyIcon]" -ForegroundColor Gray
Write-Host "  # Note: Le changement via script nécessite des privilèges admin" -ForegroundColor Gray
Write-Host ""

# Vérifier si on peut accéder au fichier de configuration WAMP
$wampConfigPath = "C:\wamp64\wampmanager.conf"
if (Test-Path $wampConfigPath) {
    Write-Host "Tentative de modification automatique..." -ForegroundColor Yellow
    
    try {
        # Lire le fichier de configuration
        $config = Get-Content $wampConfigPath -Raw
        
        # Chercher et remplacer la version PHP
        $pattern = 'phpVersion\s*=\s*"[^"]*"'
        if ($config -match $pattern) {
            $newConfig = $config -replace $pattern, "phpVersion = `"$targetVersion`""
            $newConfig | Set-Content $wampConfigPath -NoNewline
            Write-Host "Fichier de configuration modifié: $wampConfigPath" -ForegroundColor Green
            Write-Host ""
            Write-Host "IMPORTANT: Redémarrez WAMP manuellement pour appliquer les changements!" -ForegroundColor Cyan
            Write-Host "  - Cliquez sur l'icône WAMP → Quitter" -ForegroundColor Yellow
            Write-Host "  - Relancez WAMP" -ForegroundColor Yellow
        } else {
            Write-Host "Format de configuration non reconnu" -ForegroundColor Yellow
            Write-Host "Veuillez changer manuellement via l'interface WAMP" -ForegroundColor Yellow
        }
    } catch {
        Write-Host "Impossible de modifier automatiquement (droits insuffisants?)" -ForegroundColor Yellow
        Write-Host "Veuillez changer manuellement via l'interface WAMP" -ForegroundColor Yellow
    }
} else {
    Write-Host "Fichier de configuration WAMP non trouvé" -ForegroundColor Yellow
    Write-Host "Veuillez changer manuellement via l'interface WAMP" -ForegroundColor Yellow
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  VÉRIFICATION" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Après avoir changé la version PHP, exécutez:" -ForegroundColor Yellow
Write-Host "  php -v" -ForegroundColor White
Write-Host ""
Write-Host "Vous devriez voir: PHP 7.4.33" -ForegroundColor Green
Write-Host ""

