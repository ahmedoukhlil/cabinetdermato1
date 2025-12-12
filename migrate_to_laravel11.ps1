# Script PowerShell pour migrer vers Laravel 11 et PHP 8.3
# Ce script automatise la migration de Laravel 7 vers Laravel 11

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Migration vers Laravel 11 et PHP 8.3" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Vérifier la version PHP
Write-Host "1. Verification de la version PHP..." -ForegroundColor Yellow
$phpVersionOutput = php -v 2>&1 | Out-String
$phpVersion = ""
if ($phpVersionOutput -match "PHP (\d+\.\d+\.\d+)") {
    $phpVersion = $matches[1]
}
Write-Host "   Version actuelle: PHP $phpVersion" -ForegroundColor $(if ($phpVersion -match "^8\.[23]") { "Green" } else { "Red" })

if ($phpVersion -notmatch "^8\.[23]") {
    Write-Host "   [ERREUR] PHP 8.2 ou 8.3 est requis pour Laravel 11" -ForegroundColor Red
    Write-Host "   Changez vers PHP 8.3.14 dans WAMP" -ForegroundColor Yellow
    Write-Host ""
    exit 1
}

Write-Host "   [OK] Version PHP compatible" -ForegroundColor Green
Write-Host ""

# Vérifier si Git est disponible
Write-Host "2. Verification de Git..." -ForegroundColor Yellow
$gitAvailable = $false
try {
    $gitVersion = git --version 2>&1
    if ($gitVersion) {
        $gitAvailable = $true
        Write-Host "   [OK] Git disponible" -ForegroundColor Green
    }
} catch {
    Write-Host "   [AVERTISSEMENT] Git non disponible" -ForegroundColor Yellow
    Write-Host "   Il est recommande de versionner votre code avant la migration" -ForegroundColor Yellow
}
Write-Host ""

# Créer une sauvegarde
Write-Host "3. Creation de sauvegardes..." -ForegroundColor Yellow
$backupDir = "backup_migration_$(Get-Date -Format 'yyyyMMdd_HHmmss')"
New-Item -ItemType Directory -Path $backupDir -Force | Out-Null

Copy-Item "composer.json" "$backupDir\composer.json.backup" -Force
Copy-Item "composer.lock" "$backupDir\composer.lock.backup" -Force -ErrorAction SilentlyContinue
Copy-Item ".env" "$backupDir\.env.backup" -Force -ErrorAction SilentlyContinue

Write-Host "   [OK] Sauvegardes creees dans: $backupDir" -ForegroundColor Green
Write-Host ""

# Avertissement
Write-Host "========================================" -ForegroundColor Yellow
Write-Host "  ATTENTION" -ForegroundColor Yellow
Write-Host "========================================" -ForegroundColor Yellow
Write-Host ""
Write-Host "Cette migration va:" -ForegroundColor Yellow
Write-Host "  1. Modifier composer.json" -ForegroundColor White
Write-Host "  2. Mettre a jour toutes les dependances" -ForegroundColor White
Write-Host "  3. Requerir des modifications de code" -ForegroundColor White
Write-Host ""
Write-Host "Voulez-vous continuer? (O/N)" -ForegroundColor Cyan
$response = Read-Host

if ($response -ne "O" -and $response -ne "o" -and $response -ne "Y" -and $response -ne "y") {
    Write-Host "Migration annulee." -ForegroundColor Yellow
    exit 0
}

Write-Host ""
Write-Host "4. Mise a jour de composer.json..." -ForegroundColor Yellow
Write-Host "   Le fichier composer.json va etre modifie" -ForegroundColor Gray
Write-Host "   Consultez MIGRATION_DIRECTE_LARAVEL11.md pour les details" -ForegroundColor Gray
Write-Host ""

# Note : La modification réelle de composer.json sera faite manuellement
# car elle nécessite une analyse approfondie des dépendances

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  PROCHAINES ETAPES MANUELLES" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "1. Modifiez composer.json avec les nouvelles versions" -ForegroundColor Yellow
Write-Host "   (Voir le fichier composer.json.laravel11 pour reference)" -ForegroundColor Gray
Write-Host ""
Write-Host "2. Supprimez vendor et composer.lock:" -ForegroundColor Yellow
Write-Host "   Remove-Item -Recurse -Force vendor" -ForegroundColor White
Write-Host "   Remove-Item -Force composer.lock" -ForegroundColor White
Write-Host ""
Write-Host "3. Installez les nouvelles dependances:" -ForegroundColor Yellow
Write-Host "   composer install" -ForegroundColor White
Write-Host ""
Write-Host "4. Mettez a jour le code (voir MIGRATION_DIRECTE_LARAVEL11.md)" -ForegroundColor Yellow
Write-Host ""
Write-Host "5. Testez l'application" -ForegroundColor Yellow
Write-Host ""

Write-Host "Sauvegardes disponibles dans: $backupDir" -ForegroundColor Gray
Write-Host ""

