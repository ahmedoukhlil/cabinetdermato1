# Script PowerShell pour corriger la configuration mysqli dans WAMP64
# Ce script vérifie et corrige les problèmes de configuration mysqli dans php.ini

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Correction de la configuration mysqli" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Trouver le fichier php.ini actif
Write-Host "Recherche du fichier php.ini..." -ForegroundColor Yellow

# Méthode 1: Essayer via php --ini
$phpIniPath = $null
try {
    $phpOutput = php --ini 2>&1 | Out-String
    if ($phpOutput -match "Loaded Configuration File:\s+(.+)") {
        $phpIniPath = $matches[1].Trim()
    }
} catch {
    # PHP n'est pas dans le PATH, continuer avec la méthode 2
}

# Méthode 2: Chercher dans WAMP64
if (-not $phpIniPath -or -not (Test-Path $phpIniPath)) {
    Write-Host "Recherche dans WAMP64..." -ForegroundColor Yellow
    $wampPath = "C:\wamp64\bin\php"
    if (Test-Path $wampPath) {
        # Trouver la version PHP la plus récente ou celle utilisée
        $phpVersions = Get-ChildItem -Path $wampPath -Directory -Filter "php*" | Sort-Object Name -Descending
        foreach ($phpVersion in $phpVersions) {
            $testIniPath = Join-Path $phpVersion.FullName "php.ini"
            if (Test-Path $testIniPath) {
                $phpIniPath = $testIniPath
                Write-Host "Fichier php.ini trouvé: $phpIniPath" -ForegroundColor Green
                break
            }
        }
    }
}

if (-not $phpIniPath -or -not (Test-Path $phpIniPath)) {
    Write-Host "ERREUR: Impossible de trouver le fichier php.ini" -ForegroundColor Red
    Write-Host "Veuillez spécifier manuellement le chemin du fichier php.ini" -ForegroundColor Red
    Write-Host "Exemple: C:\wamp64\bin\php\php8.3.14\php.ini" -ForegroundColor Yellow
    exit 1
}

Write-Host "Fichier php.ini trouvé: $phpIniPath" -ForegroundColor Green
Write-Host ""

# Créer une sauvegarde
$backupPath = "$phpIniPath.backup_$(Get-Date -Format 'yyyyMMdd_HHmmss')"
Write-Host "Création d'une sauvegarde: $backupPath" -ForegroundColor Yellow
Copy-Item $phpIniPath $backupPath
Write-Host "Sauvegarde créée avec succès" -ForegroundColor Green
Write-Host ""

# Lire le contenu du fichier
$content = Get-Content $phpIniPath

# Compter les occurrences de extension=mysqli (actives et commentées)
$activeExtensions = 0
$commentedExtensions = 0
$extensionLines = @()

for ($i = 0; $i -lt $content.Length; $i++) {
    $line = $content[$i]
    if ($line -match '^\s*extension\s*=\s*mysqli\s*$') {
        $activeExtensions++
        $extensionLines += @{Line = $i + 1; Content = $line; Active = $true}
    }
    elseif ($line -match '^\s*;\s*extension\s*=\s*mysqli\s*$') {
        $commentedExtensions++
        $extensionLines += @{Line = $i + 1; Content = $line; Active = $false}
    }
}

Write-Host "Analyse du fichier php.ini:" -ForegroundColor Cyan
Write-Host "  - Extensions mysqli actives: $activeExtensions" -ForegroundColor $(if ($activeExtensions -eq 1) { "Green" } else { "Red" })
Write-Host "  - Extensions mysqli commentées: $commentedExtensions" -ForegroundColor Yellow
Write-Host ""

# Corriger les problèmes
$modified = $false
$newContent = @()

if ($activeExtensions -eq 0) {
    Write-Host "Aucune extension mysqli active trouvée." -ForegroundColor Red
    Write-Host "Recherche d'une ligne commentée à activer..." -ForegroundColor Yellow
    
    # Chercher la première ligne commentée et l'activer
    $found = $false
    for ($i = 0; $i -lt $content.Length; $i++) {
        $line = $content[$i]
        if (-not $found -and $line -match '^\s*;\s*extension\s*=\s*mysqli\s*$') {
            $newContent += $line -replace '^\s*;\s*', ''
            $modified = $true
            $found = $true
            Write-Host "  Ligne $($i + 1) activée: $line -> extension=mysqli" -ForegroundColor Green
        } else {
            $newContent += $line
        }
    }
    
    if (-not $found) {
        Write-Host "Aucune ligne commentée trouvée. Ajout d'une nouvelle ligne..." -ForegroundColor Yellow
        # Ajouter après la section des extensions (chercher une zone appropriée)
        $inserted = $false
        for ($i = 0; $i -lt $content.Length; $i++) {
            $newContent += $content[$i]
            if (-not $inserted -and $content[$i] -match '^\s*extension\s*=') {
                $newContent += "extension=mysqli"
                $modified = $true
                $inserted = $true
                Write-Host "  Nouvelle ligne ajoutée après la ligne $($i + 1)" -ForegroundColor Green
            }
        }
    }
} elseif ($activeExtensions -gt 1) {
    Write-Host "ATTENTION: Plusieurs extensions mysqli actives détectées!" -ForegroundColor Red
    Write-Host "Suppression des doublons..." -ForegroundColor Yellow
    
    $firstActive = $true
    for ($i = 0; $i -lt $content.Length; $i++) {
        $line = $content[$i]
        if ($line -match '^\s*extension\s*=\s*mysqli\s*$') {
            if ($firstActive) {
                $newContent += $line
                $firstActive = $false
                Write-Host "  Ligne $($i + 1) conservée: $line" -ForegroundColor Green
            } else {
                $newContent += ";$line"
                $modified = $true
                Write-Host "  Ligne $($i + 1) commentée (doublon): $line" -ForegroundColor Yellow
            }
        } else {
            $newContent += $line
        }
    }
} else {
    Write-Host "Configuration correcte: Une seule extension mysqli active." -ForegroundColor Green
    $newContent = $content
}

# Écrire le fichier modifié si nécessaire
if ($modified) {
    Write-Host ""
    Write-Host "Application des modifications..." -ForegroundColor Yellow
    $newContent | Set-Content $phpIniPath -Encoding UTF8
    Write-Host "Fichier php.ini modifié avec succès!" -ForegroundColor Green
    Write-Host ""
    Write-Host "IMPORTANT: Redémarrez WAMP pour appliquer les changements!" -ForegroundColor Cyan
    Write-Host "  - Cliquez sur l'icône WAMP -> Redémarrer tous les services" -ForegroundColor Yellow
} else {
    Write-Host "Aucune modification nécessaire." -ForegroundColor Green
}

Write-Host ""
Write-Host "Vérification finale..." -ForegroundColor Cyan
$result = php -m 2>&1 | Select-String "mysqli"
if ($result) {
    if ($result -match "Warning.*already loaded") {
        Write-Host "ATTENTION: L'extension est toujours chargée plusieurs fois." -ForegroundColor Red
        Write-Host "Redémarrez WAMP et réessayez." -ForegroundColor Yellow
    } else {
        Write-Host "SUCCÈS: Extension mysqli détectée!" -ForegroundColor Green
    }
} else {
    Write-Host "L'extension mysqli n'est pas encore chargée." -ForegroundColor Yellow
    Write-Host "Redémarrez WAMP pour appliquer les changements." -ForegroundColor Yellow
}

Write-Host ""
Write-Host "Sauvegarde disponible à: $backupPath" -ForegroundColor Gray
Write-Host "========================================" -ForegroundColor Cyan

