# LaRuche — Liste des tâches avant mise en production

> Analyse effectuée le 23/02/2026. Triée par priorité. Le site doit être prêt rapidement.

---

## 🔴 CRITIQUE — Sécurité (à faire ABSOLUMENT avant prod)

### ✅ SEC-1 — Credentials de base de données exposés dans le code
**Fichier :** `back/modules/Connexion.php` (ligne 21-31)
- Les identifiants AWS RDS (`admin / CouCou&85`) sont en clair dans le code source
- Des identifiants de backup sont aussi en commentaire (ligne 47-56)
- **Fix :** Passer par des variables d'environnement ou un fichier `.env` exclu du git
- **Effort :** 30 min

### ✅ SEC-2 — Injections SQL dans le module admin
**Fichier :** `back/modules/mod_admin/modele_admin.php`
- De nombreuses requêtes construisent le SQL par concaténation de variables non sanitisées
- Exemples : lignes 78, 99, 119, 165, 224, 350, 405-406, 530, 568, 668
- **Fix :** Utiliser systématiquement `bindParam()` / requêtes préparées PDO
- **Effort :** 3-4h

### SEC-3 — Upload de fichiers sans validation
**Fichier :** `back/modules/mod_admin/modele_admin.php` (ligne 199-216)
- Aucune vérification du type MIME ni de l'extension
- Un attaquant peut uploader un fichier `.php` et l'exécuter sur le serveur
- **Fix :** Vérifier le MIME type avec `finfo_file()`, whitelist des extensions, nom de fichier aléatoire
- **Effort :** 1-2h

### SEC-4 — Failles XSS (sorties non échappées)
**Fichiers :** `front/profil/EditProfil.php`, `front/connexion/connexion.php` et autres
- Les données utilisateur sont affichées directement sans `htmlspecialchars()`
- **Fix :** Entourer tous les `echo $data[...]` de `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`
- **Effort :** 1-2h

### SEC-5 — Génération de token faible
**Fichier :** `back/modules/mod_admin/modele_admin.php` (ligne 17-28)
- Utilise `rand()` avec `srand(microtime())` — prévisible
- **Fix :** Remplacer par `bin2hex(random_bytes(32))`
- **Effort :** 15 min

---

## 🟠 PROBLÈMES ACTUELS — À corriger pour la stabilité

### BUG-1 — Code de debug laissé en production
**Fichiers :** `modele_admin.php`, `modele_connexion.php`, `modele_scoruche.php`
- Des `console.log('erreur: $e')` exposent la structure SQL en console navigateur
- Des `var_dump($e)` affichent des exceptions directement dans la page (ligne 170 de modele_admin.php)
- **Fix :** Supprimer tous ces appels, ou les remplacer par un logger conditionnel (`APP_DEBUG`)
- **Effort :** 30 min

### BUG-2 — Faute de frappe dans la session (`tempPawword`)
**Fichier :** `back/modules/mod_connexion/modele_connexion.php` (ligne 122)
- `$_SESSION["tempPawword"]` au lieu de `"tempPassword"`
- Risque de casser le fonctionnement si lu ailleurs sous le bon nom
- **Fix :** Corriger et vérifier toutes les références
- **Effort :** 10 min

### BUG-3 — Fonctionnalités admin incomplètes (TODO en production)
**Fichier :** `back/modules/mod_admin/mod_admin.php` (lignes 123, 127)
- Les cases `detailEquipe` et `detailCompetition` affichent `"TODO a coder"` à l'utilisateur
- **Fix :** Implémenter ou masquer ces options en attendant
- **Effort :** 2-4h (implémentation) ou 10 min (masquer)

### BUG-4 — Validation du mot de passe trop permissive
**Fichier :** `back/modules/mod_connexion/cont_connexion.php` (ligne 83-86)
- Seule la longueur > 7 est vérifiée
- **Fix :** Ajouter vérification majuscule + chiffre + caractère spécial (ou au minimum longueur ≥ 8 clairement documentée)
- **Effort :** 20 min

### BUG-5 — Gestion d'erreurs incohérente
- Certaines fonctions retournent `false`, d'autres `-404`, d'autres une `PDOException`, d'autres un tableau
- Rend le débogage difficile et les vérifications côté contrôleur non fiables
- **Fix :** Uniformiser : utiliser des exceptions ou un type de retour cohérent par couche
- **Effort :** 3-4h

---

## 🟡 AMÉLIORATIONS — Rapides et à fort impact

### AMELIO-1 — Ajouter des états vides dans les vues
- Les listes (matchs, compétitions, classements) n'ont probablement pas de message si elles sont vides
- **Fix :** Ajouter un `if (empty($data)) { echo "<p>Aucun résultat.</p>"; }` dans chaque vue liste
- **Effort :** 1h

### AMELIO-2 — Ajouter un feedback visuel pendant les soumissions de formulaire
- Pas de spinner ni de désactivation de bouton lors de l'envoi
- Risque de double-soumission
- **Fix :** Désactiver le bouton submit en JS à la soumission + optionnel : spinner CSS
- **Effort :** 30 min

### AMELIO-3 — Ajouter `intval()` sur les IDs reçus en GET/POST
- Les IDs numériques reçus (`$_GET["id"]`) ne sont pas castés
- Contournement partiel des injections SQL sans refaire toutes les requêtes
- **Fix :** `$id = intval($_GET['id'] ?? 0);` sur tous les paramètres numériques
- **Effort :** 1h (complément de SEC-2, en attendant)

### AMELIO-4 — Page d'erreur admin propre
**Fichier :** `front/admin/tools/erreur.html`
- Il y a un TODO pour créer cette page
- **Fix :** Créer une page d'erreur simple cohérente avec le reste du design
- **Effort :** 30 min

### AMELIO-5 — Supprimer le `console.log` de debug du mini-jeu
**Fichier :** `style/js/mini_jeu/mini-jeu.js` (ligne 32+)
- Nettoyage du code JS avant prod
- **Effort :** 10 min

### AMELIO-6 — Vérifier les labels des formulaires (accessibilité minimale)
- S'assurer que chaque `<input>` a un `<label>` associé ou un attribut `placeholder` + `aria-label`
- **Effort :** 30-45 min

---

## 📋 RÉSUMÉ PRIORITÉ

| # | Tâche | Priorité | Effort estimé |
|---|-------|----------|---------------|
| SEC-1 | Credentials en clair dans le code | 🔴 CRITIQUE | 30 min |
| SEC-5 | Token généré avec rand() faible | 🔴 CRITIQUE | 15 min |
| BUG-2 | Faute de frappe `tempPawword` | 🔴 CRITIQUE | 10 min |
| BUG-1 | Debug logs en production | 🔴 CRITIQUE | 30 min |
| SEC-4 | XSS — sorties non échappées | 🔴 CRITIQUE | 1-2h |
| SEC-3 | Upload fichier sans validation | 🔴 CRITIQUE | 1-2h |
| SEC-2 | Injections SQL admin | 🔴 CRITIQUE | 3-4h |
| BUG-4 | Validation mot de passe trop faible | 🟠 MOYEN | 20 min |
| AMELIO-3 | intval() sur les IDs GET/POST | 🟠 MOYEN | 1h |
| BUG-3 | TODO visibles en prod (admin) | 🟠 MOYEN | 10 min (masquer) |
| AMELIO-2 | Feedback soumission formulaires | 🟡 RAPIDE | 30 min |
| AMELIO-1 | États vides dans les listes | 🟡 RAPIDE | 1h |
| AMELIO-4 | Page erreur admin | 🟡 RAPIDE | 30 min |
| AMELIO-5 | console.log mini-jeu | 🟡 RAPIDE | 10 min |
| AMELIO-6 | Labels accessibilité formulaires | 🟡 RAPIDE | 30-45 min |
| BUG-5 | Uniformiser gestion d'erreurs | 🟠 MOYEN | 3-4h |

**Total critique :** ~8h
**Total rapides :** ~3-4h
**Total complet :** ~12-15h
