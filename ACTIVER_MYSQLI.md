# Guide pour activer l'extension mysqli dans WAMP64

## Problème
L'extension mysqli n'est pas activée dans votre configuration PHP, ce qui empêche votre application Laravel et phpMyAdmin de se connecter à MySQL.

**Erreur phpMyAdmin :** "Il manque l'extension mysqli. Merci de vérifier la configuration PHP."

## Solution : Activer l'extension mysqli

### Méthode 0 : Correction automatique (Script PowerShell) ⚡

Un script PowerShell est disponible pour corriger automatiquement les problèmes de configuration :

1. **Ouvrez PowerShell en tant qu'administrateur** dans le dossier du projet
2. **Exécutez le script** :
   ```powershell
   .\fix_mysqli.ps1
   ```
3. Le script va :
   - Détecter le fichier php.ini utilisé
   - Créer une sauvegarde automatique
   - Corriger les doublons d'extension mysqli
   - Activer l'extension si elle est désactivée
4. **Redémarrez WAMP** après l'exécution du script

### Méthode 1 : Via l'interface WAMP (Recommandé)

1. **Cliquez sur l'icône WAMP** dans la barre des tâches Windows
2. Allez dans **PHP** → **Extensions PHP**
3. Cochez **php_mysqli** dans la liste des extensions
4. WAMP redémarrera automatiquement les services

### Méthode 2 : Modification manuelle du fichier php.ini

1. **Trouvez votre version PHP** :
   - Cliquez sur l'icône WAMP → **PHP** → **Version PHP**
   - Notez la version active (ex: 7.4.9)

2. **Ouvrez le fichier php.ini** :
   - Chemin typique : `C:\wamp64\bin\php\php[VERSION]\php.ini`
   - Exemple : `C:\wamp64\bin\php\php7.4.9\php.ini`
   - Ouvrez-le avec un éditeur de texte (Notepad++, Visual Studio Code, etc.)

3. **Recherchez toutes les lignes mysqli** :
   - Appuyez sur `Ctrl + F` et cherchez `extension=mysqli` (sans le point-virgule)
   - **IMPORTANT :** Vérifiez qu'il n'y a qu'**UNE SEULE** ligne `extension=mysqli` active (sans `;` au début)
   - Si vous voyez plusieurs lignes `extension=mysqli`, cela peut causer l'erreur "Module mysqli is already loaded"

4. **Activez l'extension** :
   - Si vous voyez `;extension=mysqli` (avec point-virgule), supprimez le `;` pour décommenter :
     ```ini
     extension=mysqli
     ```
   - Si la ligne n'existe pas, ajoutez-la dans la section des extensions (généralement vers la ligne 900-1000)
   - **Si vous voyez plusieurs lignes `extension=mysqli`**, commentez ou supprimez les doublons en laissant UNE SEULE ligne active :
     ```ini
     extension=mysqli
     ;extension=mysqli  ← Commentez ou supprimez cette ligne en double
     ```

5. **Vérifiez aussi l'extension PDO MySQL** (recommandé pour Laravel) :
   - Cherchez `pdo_mysql` et activez-le de la même manière :
     ```ini
     extension=pdo_mysql
     ```

6. **Sauvegardez le fichier** (`Ctrl + S`)

7. **Redémarrez WAMP** :
   - Cliquez sur l'icône WAMP → **Redémarrer tous les services**

### Vérification

Pour vérifier que l'extension est bien activée :

1. Créez un fichier `phpinfo.php` dans votre dossier `public` :
   ```php
   <?php
   phpinfo();
   ?>
   ```

2. Accédez à `http://localhost/Code/public/phpinfo.php` dans votre navigateur

3. Recherchez "mysqli" dans la page. Vous devriez voir une section "mysqli" avec les informations de l'extension.

4. **Supprimez le fichier phpinfo.php** après vérification pour des raisons de sécurité.

### Alternative : Vérification via la ligne de commande

Ouvrez PowerShell ou CMD et exécutez :
```bash
php -m | findstr mysqli
```

Si vous voyez `mysqli` dans la liste, l'extension est activée.

**⚠️ Attention :** Si vous voyez l'avertissement `Warning: Module "mysqli" is already loaded`, cela signifie que l'extension est chargée deux fois dans php.ini. Il faut supprimer la duplication (voir étape 3 ci-dessus).

## Solution spécifique pour phpMyAdmin

Si phpMyAdmin affiche toujours l'erreur après avoir activé mysqli :

1. **Vérifiez la version PHP utilisée par phpMyAdmin** :
   - Ouvrez phpMyAdmin dans votre navigateur
   - Allez dans l'onglet "Variables" ou consultez la page d'accueil
   - Notez la version PHP affichée

2. **Vérifiez que phpMyAdmin utilise la même version PHP** :
   - Cliquez sur l'icône WAMP → **PHP** → **Version PHP**
   - Assurez-vous que la version sélectionnée correspond à celle utilisée par phpMyAdmin
   - Si nécessaire, changez la version PHP dans WAMP

3. **Vérifiez le fichier php.ini utilisé** :
   - Exécutez dans PowerShell : `php --ini`
   - Notez le chemin du fichier "Loaded Configuration File"
   - C'est ce fichier que vous devez modifier

4. **Redémarrez complètement WAMP** :
   - Cliquez sur l'icône WAMP → **Redémarrer tous les services**
   - Attendez que tous les services soient démarrés (icône verte)
   - Rafraîchissez phpMyAdmin (Ctrl + F5)

5. **Vérifiez dans phpMyAdmin** :
   - Allez dans l'onglet "Variables" de phpMyAdmin
   - Recherchez "mysqli" dans la liste
   - Vous devriez voir des variables mysqli configurées

## Notes importantes

- **Laravel utilise PDO par défaut**, mais certaines bibliothèques peuvent nécessiter mysqli
- **phpMyAdmin nécessite absolument mysqli** pour fonctionner
- Assurez-vous que **pdo_mysql** est également activé (généralement activé par défaut dans WAMP)
- Si le problème persiste après activation, vérifiez que le fichier `php_mysqli.dll` existe dans le dossier `ext` de PHP :
  - Exemple : `C:\wamp64\bin\php\php8.3.14\ext\php_mysqli.dll`
- **Évitez les doublons** : Ne chargez l'extension mysqli qu'**UNE SEULE FOIS** dans php.ini

## Dépannage avancé

### Vérifier l'état actuel de l'extension

Exécutez ces commandes dans PowerShell pour diagnostiquer :

```bash
# Vérifier si mysqli est chargé
php -m | findstr mysqli

# Vérifier le fichier php.ini utilisé
php --ini

# Vérifier toutes les occurrences de mysqli dans php.ini
findstr /n "extension=mysqli" C:\wamp64\bin\php\php8.3.14\php.ini
```

### Problèmes courants

1. **"Module mysqli is already loaded"** :
   - L'extension est chargée plusieurs fois dans php.ini
   - Solution : Supprimez les doublons, gardez UNE SEULE ligne `extension=mysqli`

2. **phpMyAdmin ne détecte toujours pas mysqli** :
   - Vérifiez que phpMyAdmin utilise la même version PHP que celle configurée dans WAMP
   - Vérifiez que vous avez modifié le BON fichier php.ini (celui retourné par `php --ini`)
   - Redémarrez complètement WAMP (arrêt complet puis démarrage)

3. **Extension chargée mais erreur persiste** :
   - Vérifiez que le fichier DLL existe : `C:\wamp64\bin\php\php[VERSION]\ext\php_mysqli.dll`
   - Vérifiez les permissions du fichier DLL
   - Consultez les logs d'erreur PHP dans WAMP

## Support

Si le problème persiste :
1. Vérifiez les logs d'erreur PHP dans WAMP (icône WAMP → PHP → Logs PHP)
2. Vérifiez que MySQL est bien démarré dans WAMP (icône doit être verte)
3. Assurez-vous que votre version PHP est compatible avec votre version MySQL
4. Utilisez le script de diagnostic : `http://localhost/Code/public/check_extensions.php`

