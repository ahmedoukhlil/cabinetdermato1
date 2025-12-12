# Migration directe vers Laravel 11 et PHP 8.3

## ⚠️ ATTENTION

Cette migration est **directe** de Laravel 7 vers Laravel 11. Elle nécessite des modifications importantes du code.

**Recommandation :** Testez d'abord sur un environnement de développement !

## 📋 Prérequis

- ✅ PHP 8.3.14 disponible dans WAMP
- ✅ Base de données sauvegardée
- ✅ Code versionné (Git recommandé)

## 🔧 Étape 1 : Changer vers PHP 8.3.14

1. Cliquez sur l'icône **WAMP** → **PHP** → **Version PHP**
2. Sélectionnez **php8.3.14**
3. Redémarrez WAMP
4. Vérifiez : `php -v` (doit afficher PHP 8.3.14)

## 🔧 Étape 2 : Mettre à jour composer.json

Le fichier `composer.json` sera mis à jour avec :
- PHP ^8.2
- Laravel 11
- Nouvelles versions des packages compatibles

## 🔧 Étape 3 : Modifications de code nécessaires

### 3.1. Middleware CheckForMaintenanceMode

**Laravel 7 :**
```php
\App\Http\Middleware\CheckForMaintenanceMode::class
```

**Laravel 11 :**
```php
\Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class
```

### 3.2. Route Middleware

**Laravel 7 :**
```php
protected $routeMiddleware = [...]
```

**Laravel 11 :**
```php
protected $middlewareAliases = [...]
```

### 3.3. Faker

**Laravel 7 :**
```php
use Faker\Generator as Faker;
```

**Laravel 11 :**
```php
use Faker\Factory as Faker;
// OU utiliser le nouveau package fakerphp/faker
```

### 3.4. Database Seeds

**Laravel 7 :**
```php
use Illuminate\Database\Seeder;
```

**Laravel 11 :**
```php
// Les seeds sont maintenant dans database/seeders/
use Database\Seeders\Seeder;
```

## 🔧 Étape 4 : Structure des dossiers

Certains dossiers ont changé :
- `database/seeds/` → `database/seeders/`
- `app/Http/Middleware/CheckForMaintenanceMode.php` → Supprimé (intégré dans Laravel)

## 🔧 Étape 5 : Configuration

- `config/app.php` : Modifications de la structure
- `bootstrap/app.php` : Nouvelle structure dans Laravel 11
- `.env` : Nouvelles variables d'environnement

## ⚡ Commandes de migration

Une fois les fichiers mis à jour :

```bash
# Supprimer l'ancien vendor
rm -rf vendor composer.lock

# Installer les nouvelles dépendances
composer install

# Nettoyer les caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Exécuter les migrations (si nécessaire)
php artisan migrate

# Générer la nouvelle clé (si nécessaire)
php artisan key:generate
```

## 🐛 Problèmes courants et solutions

### Problème 1 : Package non compatible
**Solution :** Chercher une alternative ou une version compatible Laravel 11

### Problème 2 : Méthodes dépréciées
**Solution :** Utiliser les nouvelles méthodes recommandées par Laravel 11

### Problème 3 : Erreurs de type
**Solution :** PHP 8.3 est plus strict, corriger les types

## ✅ Checklist de vérification

- [ ] PHP 8.3.14 actif
- [ ] Base de données sauvegardée
- [ ] Code versionné
- [ ] composer.json mis à jour
- [ ] Dépendances installées
- [ ] Middleware mis à jour
- [ ] Routes testées
- [ ] Vues testées
- [ ] Contrôleurs testés
- [ ] Base de données fonctionnelle
- [ ] Tests unitaires passent (si disponibles)

