# LaRuche

Application de pronostics sportifs.

---

## Démarrage en mode dev

### Prérequis

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installé et lancé

### Démarrer le container

```bash
docker compose up -d --build
```

lien : **http://localhost:8080**

Compte admin :
- pseudo : **admin**
- mot de passe : **admin**

### Commandes utiles

```bash
docker compose logs app
```

```bash
docker compose logs db
```

```bash
docker compose down
```

Arrêter et supprimer la base de données :

```bash
docker compose down -v
```

### Accès à la base de données

Depuis TablePlus, DBeaver ou un autre client MySQL :

| Paramètre    | Valeur          |
|--------------|-----------------|
| Hôte         | `127.0.0.1`     |
| Port         | `3307`          |
| Base         | `laruchxsabine` |
| Utilisateur  | `laruche`       |
| Mot de passe | `laruche`       |

> Le port 3307 est utilisé pour éviter les conflits avec un MySQL local sur 3306.
