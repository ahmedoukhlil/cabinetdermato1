# Guide pour changer la version PHP dans WAMP64

## Problème
Votre projet Laravel 7 nécessite PHP ^7.2.5, mais PHP 8.3.14 est actuellement actif dans WAMP.

## Solution : Changer vers PHP 7.4.33

### Méthode 1 : Via l'interface WAMP (Recommandé)

1. **Cliquez sur l'icône WAMP** dans la barre des tâches Windows
2. Allez dans **PHP** → **Version PHP**
3. Sélectionnez **php7.4.33** dans la liste
4. WAMP redémarrera automatiquement les services
5. Vérifiez la version avec : `php -v`

### Méthode 2 : Via PowerShell (Script automatique)

Exécutez le script `changer_php.ps1` :
```powershell
.\changer_php.ps1
```

Le script va :
- Lister les versions PHP disponibles
- Changer vers PHP 7.4.33
- Vérifier que le changement a été effectué

### Vérification

Après avoir changé la version PHP :

1. **Vérifiez la version en ligne de commande** :
   ```bash
   php -v
   ```
   Vous devriez voir : `PHP 7.4.33`

2. **Vérifiez dans phpMyAdmin** :
   - Ouvrez phpMyAdmin
   - La version PHP affichée devrait être 7.4.33

3. **Testez votre application Laravel** :
   - Les erreurs de compatibilité devraient disparaître
   - Vous pouvez maintenant installer les dépendances avec `composer install`

## Versions PHP disponibles dans WAMP

D'après votre installation WAMP64, les versions suivantes sont disponibles :
- php7.4.33 ✅ (Recommandé pour Laravel 7)
- php8.0.30
- php8.1.31
- php8.2.26
- php8.3.14 (Actuellement actif)
- php8.4.0

## Notes importantes

- **Laravel 7** est compatible avec PHP 7.2.5 à 7.4.x
- **PHP 7.4.33** est la dernière version de la série 7.4 et est recommandée pour Laravel 7
- Après le changement, **redémarrez votre application** si elle était en cours d'exécution
- Si vous souhaitez utiliser PHP 8.x, vous devrez mettre à jour Laravel vers la version 8 ou 9

## Alternative : Mettre à jour vers Laravel 8/9 (pour PHP 8.x)

Si vous préférez utiliser PHP 8.3, vous devrez :
1. Mettre à jour Laravel 7 vers Laravel 8 ou 9
2. Mettre à jour toutes les dépendances
3. Adapter le code aux changements de version

**⚠️ Attention :** Cette mise à jour peut nécessiter des modifications importantes du code.

