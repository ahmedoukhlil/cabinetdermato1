# Plan de migration vers PHP 8.3 et Laravel 11

## 📊 État actuel

- **PHP actuel :** 7.4.33 / 8.3.14 (disponible dans WAMP)
- **Laravel actuel :** 7.24.0
- **PHP requis actuel :** ^7.2.5

## 🎯 Objectif

- **PHP cible :** 8.3.14 (déjà disponible dans WAMP)
- **Laravel cible :** 11.x (dernière version stable)
- **PHP requis :** ^8.2

## ⚠️ Points importants avant la migration

### Changements majeurs entre Laravel 7 et Laravel 11

1. **PHP 8.2+ requis** (au lieu de PHP 7.2.5+)
2. **Suppression de certaines fonctionnalités dépréciées**
3. **Nouvelles structures de fichiers** (bootstrap/app.php)
4. **Middleware renommé** (CheckForMaintenanceMode → PreventRequestsDuringMaintenance)
5. **Nouvelles versions des packages** requises
6. **Changements dans les facades et helpers**

## 📋 Plan de migration étape par étape

### Phase 1 : Préparation (Sauvegarde)

1. **Sauvegarder la base de données**
   ```bash
   mysqldump -u root fondation > backup_fondation_$(date +%Y%m%d).sql
   ```

2. **Créer une branche Git** (si vous utilisez Git)
   ```bash
   git checkout -b migration-laravel11
   ```

3. **Sauvegarder composer.json et composer.lock**
   ```bash
   cp composer.json composer.json.backup
   cp composer.lock composer.lock.backup
   ```

### Phase 2 : Migration progressive (Recommandé)

#### Option A : Migration progressive (Laravel 7 → 8 → 9 → 10 → 11)

**Avantages :** Moins de risques, migration plus douce
**Inconvénients :** Plus long, plusieurs étapes

#### Option B : Migration directe (Laravel 7 → 11)

**Avantages :** Plus rapide
**Inconvénients :** Plus de changements à gérer en une fois

**⚠️ Recommandation :** Migration progressive pour une application en production

### Phase 3 : Mise à jour des dépendances

Les packages suivants devront être mis à jour :

- `laravel/framework`: ^7.0 → ^11.0
- `laravel/passport`: ^8.4 → ^12.0 (ou version compatible)
- `doctrine/dbal`: ^2.10 → ^3.0
- `spatie/laravel-medialibrary`: ^7.19 → ^11.0
- `yajra/laravel-datatables-oracle`: ^9.9 → ^11.0
- `carlos-meneses/laravel-mpdf`: ^2.1 → Version compatible Laravel 11
- `fzaninotto/faker`: ^1.9.1 → `fakerphp/faker` (nouveau package)
- Et tous les autres packages...

## 🔧 Scripts de migration

Des scripts seront créés pour faciliter la migration :
- `migrate_to_laravel11.ps1` : Script principal de migration
- `check_compatibility.ps1` : Vérification de compatibilité

## ⚡ Migration rapide (Option directe)

Si vous choisissez la migration directe, suivez le guide dans `MIGRATION_DIRECTE_LARAVEL11.md`

## 📚 Ressources

- [Guide de migration Laravel 7 → 8](https://laravel.com/docs/8.x/upgrade)
- [Guide de migration Laravel 8 → 9](https://laravel.com/docs/9.x/upgrade)
- [Guide de migration Laravel 9 → 10](https://laravel.com/docs/10.x/upgrade)
- [Guide de migration Laravel 10 → 11](https://laravel.com/docs/11.x/upgrade)

## ⚠️ Avertissements

1. **Testez d'abord sur un environnement de développement**
2. **Vérifiez la compatibilité de tous vos packages**
3. **Certains packages peuvent ne plus être maintenus**
4. **Des modifications de code seront nécessaires**
5. **Les tests devront être mis à jour**

## 🎯 Prochaines étapes

1. Décidez de la stratégie de migration (progressive ou directe)
2. Exécutez le script de vérification de compatibilité
3. Suivez le guide de migration choisi
4. Testez l'application après chaque étape

