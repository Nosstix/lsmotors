# README — LS Motors


---

## Installation

### 1. Base de données

Importer les  fichiers SQL dans l'ordre :

```bash
sudo mysql < script.sql
sudo mysql < insert.sql
sudo mysql < update_images.sql
ou
sudo mariadb < script.sql
sudo mariadb < insert.sql
sudo mariadb < update_images.sql
```

### 2. Connexion BDD

Dans `bdd/bdd.php`, vérifier les identifiants MySQL et s'assurer que l'utilisateur a les droits sur la base :

```sql
GRANT ALL PRIVILEGES ON ls_motors.* TO 'votre_user_mysql'@'localhost' IDENTIFIED BY 'mdp_user_mysql';
FLUSH PRIVILEGES;
GRANT ALL PRIVILEGES ON ls_motors.* TO 'votre_user_mysql'@'localhost';
FLUSH PRIVILEGES;
``` 

### 3. BASE_URL

Le projet utilise une constante `BASE_URL` définie dans `index.php` pour gérer les chemins selon l'environnement :

```php
define('BASE_URL', dirname($_SERVER['SCRIPT_NAME']) . '/');
```

- Sur **Linux** (projet à la racine) : vaut `/`
- Sur **Windows/WAMP** (projet dans un sous-dossier) : vaut `/lsmotors/`

Aucune modification manuelle n'est nécessaire, c'est détecté automatiquement.

---

## Images des véhicules

Les images viennent du repo GitHub : https://github.com/matthias18771/v-vehicle-images

Elles utilisent les **noms internes GTA V** (spawn names), qui ne correspondent pas forcément aux noms affichés dans le catalogue.

### Problème rencontré

Le code générait le nom du fichier image automatiquement depuis le `NomModele` en supprimant espaces et tirets. Exemple : `Bati 801` → `bati801.png`. Or les fichiers s'appellent `bati.png`, `bati2.png`, etc.

### Solution appliquée

La colonne `Image` de la table `vehicule` a été remplie avec le nom exact du fichier image via le fichier `update_images.sql` :

```bash
sudo mysql ls_motors < update_images.sql (importer le fichier comme dit plus haut)
```

### Correspondances particulières à noter

| NomModele | Image utilisée | Remarque |
|---|---|---|
| 9F | ninef.png | Nom interne GTA |
| 9F Cabrio | ninef2.png | Nom interne GTA |
| Bati 801 | bati.png | Nom interne GTA |
| Bati 801RR | bati2.png | Nom interne GTA |
| ETR1 | sheava.png | Nom interne GTA |
| Elegy RH8 | elegy.png | Nom interne GTA |
| Elegy Retro | elegy2.png | Nom interne GTA |
| Diabolus | diablous.png | Faute de frappe dans le repo |
| Swift Deluxe | swift2.png | Nom interne GTA |
| Growler RR | growler.png |  |

---

