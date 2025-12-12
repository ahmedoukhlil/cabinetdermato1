# Modifications de code nécessaires pour Laravel 11

## 📋 Modifications requises

### 1. app/Http/Kernel.php

**Laravel 7 :**
```php
protected $middleware = [
    \App\Http\Middleware\CheckForMaintenanceMode::class,
    // ...
];

protected $routeMiddleware = [
    'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
    // ...
];
```

**Laravel 11 :**
```php
protected $middleware = [
    \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
    // ...
];

protected $middlewareAliases = [
    'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
    // ...
];
```

### 2. Supprimer app/Http/Middleware/CheckForMaintenanceMode.php

Ce middleware est maintenant intégré dans Laravel. Supprimez le fichier.

### 3. database/seeds/ → database/seeders/

**Action :** Déplacer tous les fichiers de `database/seeds/` vers `database/seeders/`

**Modification dans les fichiers :**
```php
// Avant (Laravel 7)
use Illuminate\Database\Seeder;

// Après (Laravel 11)
use Database\Seeders\Seeder;
```

### 4. database/factories/UserFactory.php

**Laravel 7 :**
```php
use Faker\Generator as Faker;
```

**Laravel 11 :**
```php
use Faker\Factory as Faker;
// OU
use Faker\Generator;
```

### 5. composer.json - Packages à mettre à jour

| Package actuel | Version actuelle | Version Laravel 11 | Notes |
|---------------|-----------------|-------------------|-------|
| php | ^7.2.5 | ^8.2 | **OBLIGATOIRE** |
| laravel/framework | ^7.0 | ^11.0 | **OBLIGATOIRE** |
| laravel/passport | ^8.4 | ^13.0 | Vérifier compatibilité |
| doctrine/dbal | ^2.10 | ^3.0 | Breaking changes |
| spatie/laravel-medialibrary | ^7.19 | ^11.0 | Vérifier compatibilité |
| yajra/laravel-datatables-oracle | ^9.9 | ^11.0 | Vérifier compatibilité |
| fzaninotto/faker | ^1.9.1 | **SUPPRIMER** | Remplacer par fakerphp/faker |
| fakerphp/faker | - | ^1.23 | **NOUVEAU** |
| laravel/ui | ^2.0 | ^4.0 | Vérifier compatibilité |
| carlos-meneses/laravel-mpdf | ^2.1 | ^3.0 | Vérifier compatibilité |

### 6. Routes et Middleware

Vérifiez que toutes les routes utilisent la nouvelle syntaxe de middleware si nécessaire.

### 7. Tests PHPUnit

**Laravel 7 :**
```php
use PHPUnit\Framework\TestCase;
```

**Laravel 11 :**
```php
use Tests\TestCase;
// OU
use PHPUnit\Framework\TestCase;
```

## 🔧 Scripts d'aide

Utilisez `check_compatibility_laravel11.ps1` pour identifier les problèmes.

## ⚠️ Packages à vérifier manuellement

Certains packages peuvent ne pas avoir de version compatible Laravel 11 :
- `laraveldaily/laravel-charts` : Vérifier si une version Laravel 11 existe
- `carlos-meneses/laravel-mpdf` : Vérifier la compatibilité

## 📝 Checklist de migration

- [ ] PHP 8.3.14 actif
- [ ] Sauvegardes créées
- [ ] composer.json mis à jour
- [ ] Kernel.php modifié
- [ ] CheckForMaintenanceMode supprimé
- [ ] Seeds déplacés vers database/seeders/
- [ ] Imports des seeds mis à jour
- [ ] UserFactory mis à jour (Faker)
- [ ] composer.lock supprimé
- [ ] vendor supprimé
- [ ] composer install exécuté
- [ ] Tests de l'application

