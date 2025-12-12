# Script PowerShell pour verifier la compatibilite avec Laravel 11
# Ce script analyse le code et identifie les problemes potentiels

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Verification de compatibilite Laravel 11" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

$issues = @()
$warnings = @()

# 1. Verifier PHP
Write-Host "1. Verification PHP..." -ForegroundColor Yellow
$phpVersionOutput = php -v 2>&1 | Out-String
if ($phpVersionOutput -match "PHP (\d+\.\d+\.\d+)") {
    $phpVersion = $matches[1]
    if ($phpVersion -match "^8\.[23]") {
        Write-Host "   [OK] PHP $phpVersion compatible avec Laravel 11" -ForegroundColor Green
    } else {
        $issues += "PHP $phpVersion n'est pas compatible (requis: PHP 8.2+)"
        Write-Host "   [ERREUR] PHP $phpVersion non compatible" -ForegroundColor Red
    }
} else {
    $issues += "Impossible de determiner la version PHP"
    Write-Host "   [ERREUR] Version PHP non detectee" -ForegroundColor Red
}
Write-Host ""

# 2. Verifier les fichiers problematiques
Write-Host "2. Recherche de code incompatible..." -ForegroundColor Yellow

# CheckForMaintenanceMode
$maintenanceFiles = Get-ChildItem -Path app -Recurse -Filter "*.php" | Select-String "CheckForMaintenanceMode"
if ($maintenanceFiles) {
    $warnings += "CheckForMaintenanceMode trouve - doit etre remplace par PreventRequestsDuringMaintenance"
    Write-Host "   [AVERTISSEMENT] CheckForMaintenanceMode trouve" -ForegroundColor Yellow
    $maintenanceFiles | ForEach-Object { Write-Host "      - $($_.Path):$($_.LineNumber)" -ForegroundColor Gray }
}

# Faker (ancien package)
$fakerFiles = Get-ChildItem -Path app,database -Recurse -Filter "*.php" | Select-String "Faker\\Generator|fzaninotto"
if ($fakerFiles) {
    $warnings += "Ancien package Faker trouve - doit etre remplace par fakerphp/faker"
    Write-Host "   [AVERTISSEMENT] Ancien package Faker trouve" -ForegroundColor Yellow
}

# Route middleware (ancienne syntaxe)
$kernelFile = "app/Http/Kernel.php"
if (Test-Path $kernelFile) {
    $kernelContent = Get-Content $kernelFile -Raw
    if ($kernelContent -match '\$routeMiddleware') {
        $warnings += "routeMiddleware trouve dans Kernel.php - doit etre remplace par middlewareAliases"
        Write-Host "   [AVERTISSEMENT] routeMiddleware trouve dans Kernel.php" -ForegroundColor Yellow
    }
}

# Database seeds (ancien emplacement)
if (Test-Path "database/seeds") {
    $warnings += "Dossier database/seeds trouve - doit etre deplace vers database/seeders"
    Write-Host "   [AVERTISSEMENT] Dossier database/seeds trouve" -ForegroundColor Yellow
}

Write-Host ""

# 3. Verifier les packages
Write-Host "3. Analyse des packages..." -ForegroundColor Yellow
if (Test-Path "composer.json") {
    $composerContent = Get-Content "composer.json" -Raw | ConvertFrom-Json
    
    $incompatiblePackages = @()
    
    # Packages connus pour avoir des problemes
    $problemPackages = @{
        "fzaninotto/faker" = "Remplacer par fakerphp/faker"
        "laravel/framework" = "Mettre a jour vers ^11.0"
        "laravel/passport" = "Mettre a jour vers ^13.0"
        "spatie/laravel-medialibrary" = "Mettre a jour vers ^11.0"
        "yajra/laravel-datatables-oracle" = "Mettre a jour vers ^11.0"
    }
    
    foreach ($package in $problemPackages.Keys) {
        if ($composerContent.require.PSObject.Properties.Name -contains $package) {
            $currentVersion = $composerContent.require.$package
            $warnings += "$package ($currentVersion) - $($problemPackages[$package])"
            Write-Host "   [AVERTISSEMENT] $package : $currentVersion" -ForegroundColor Yellow
            Write-Host "      -> $($problemPackages[$package])" -ForegroundColor Gray
        }
    }
}

Write-Host ""

# Resume
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  RESUME" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

if ($issues.Count -eq 0) {
    Write-Host "[OK] Aucun probleme bloqueur detecte" -ForegroundColor Green
} else {
    Write-Host "[ERREUR] Problemes bloqueurs ($($issues.Count)):" -ForegroundColor Red
    $issues | ForEach-Object { Write-Host "  - $_" -ForegroundColor Red }
}

if ($warnings.Count -gt 0) {
    Write-Host ""
    Write-Host "[AVERTISSEMENT] Modifications necessaires ($($warnings.Count)):" -ForegroundColor Yellow
    $warnings | ForEach-Object { Write-Host "  - $_" -ForegroundColor Yellow }
}

Write-Host ""
Write-Host "Consultez MIGRATION_DIRECTE_LARAVEL11.md pour les details" -ForegroundColor Cyan
Write-Host ""

