# Couture App - Atelier de Couture sur Mesure

Application Laravel pour la gestion d'un atelier de couture avec réservation de rendez-vous.

## Structure du Projet

```
couture-app/
├── app/
│   ├── Http/Controllers/       # Contrôleurs
│   │   ├── AuthController.php      # Connexion/Déconnexion/Inscription
│   │   ├── AdminController.php  # Routes admin
│   │   ├── CategorieController.php
│   │   ├── VetementController.php
│   │   └── RendezVousController.php
│   └── Models/               # Modèles Eloquent
│       ├── Client.php           # Modèle Client
│       ├── Admin.php           # Modèle Admin
│       ├── Categorie.php       # Catégorie de vetements
│       ├── Vetement.php        # Vetement
│       └── RendezVous.php      # Rendez-vous
├── database/migrations/         # Tables de la BDD
├── resources/views/            # Vues Blade
│   ├── layouts/app.blade.php   # Layout principal
│   └── auth/               # Pages auth
└── config/auth.php           # Configuration des guards
```

## Base de Données

L'application utilise **2 tables séparées** pour l'authentification:

### Table `clients`
| Colonne | Type | Description |
|--------|------|------------|
| id | INTEGER | Clé primaire |
| nom | STRING | Nom du client |
| prenom | STRING | Prénom (optionnel) |
| email | STRING | Email unique |
| telephone | STRING | Téléphone |
| motDePasse | STRING | Mot de passe hashé |
| dateInscription | DATETIME | Date de création |
| remember_token | STRING | Token "se souvenir" |

### Table `admins`
| Colonne | Type | Description |
|--------|------|------------|
| id | INTEGER | Clé primaire |
| nom | STRING | Nom de l'admin |
| email | STRING | Email unique |
| motDePasse | STRING | Mot de passe hashé |
| remember_token | STRING | Token "se souvenir" |

### Autres tables
- `categories` - Catégories de vêtements
- `vetements` - Catalogue de vetements
- `rendez_vouses` - Rendez-vous clients
- `notifications` - Notifications

## Authentification

### Gardes (Guards) configurés dans `config/auth.php`:

- `client` - Pour les clients (table: clients, model: Client)
- `admin` - Pour les administrateurs (table: admins, model: Admin)

### Système unifié
- **Admin et Client utilisent la même page de login** (`/login`)
- Après connexion, tous sont redirigés vers la même page d'accueil (`/home`)
- Le menu s'adapte selon le type d'utilisateur connecté

### Comment ça marche (AuthController.php)

1. L'utilisateur saisit email et mot de passe
2. Le système cherche d'abord dans la table `clients`
3. Si non trouvé, cherche dans la table `admins`
4. Si trouvé, connexion avec le guard `client`
5. Redirection vers la page d'accueil

## Menu Navigation (`layouts/app.blade.php`)

Le menu affiche différemment selon le type d'utilisateur:

```php
@php
    $user = Auth::guard('client')->user();
    $isAdmin = $user instanceof \App\Models\Admin;
    $isClient = $user instanceof \App\Models\Client;
@endphp

@if($isAdmin)
    // Menu Admin: Dashboard, Vêtements, Catégories, Rendez-vous, Clients
@elseif($isClient)
    // Menu Client: Accueil, Collection, Réserver, Mes rendez-vous
@else
    // Visiteur: Connexion, S'inscrire
@endif
```

## Routes Principales

### Pages publiques
- `GET /` - Page d'accueil
- `GET /login` - Formulaire de connexion
- `GET /register` - Formulaire d'inscription

### Routes client (connecté)
- `GET /vetements` - Catalogue vetements
- `GET /rendezvous/create` - Créer un rendez-vous
- `GET /rendezvous` - Mes rendez-vous

### Routes admin
- `GET /admin/dashboard` - Tableau de bord
- `GET /admin/vetements` - Gestion vetements
- `GET /admin/categories` - Gestion catégories
- `GET /admin/rendezvous` - Gestion rendez-vous
- `GET /admin/clients` - Liste des clients

## Commandes Utiles

```bash
# Installer les dépendances
composer install

# Mettre à jour les dépendances
composer update

# Vider le cache
php artisan view:clear
php artisan cache:clear
php artisan config:clear

# Créer un admin manuellement
php artisan tinker
$admin = App\Models\Admin::create(['nom' => 'Admin', 'email' => 'admin@couture.com', 'motDePasse' => bcrypt('motdepasse')]);
```

## Résumé des Modifications Récentes

1. **AuthController.php** - Connexion unifiée pour admin et client
2. **app.blade.php** - Menu dynamique selon type d'utilisateur
3. **Suppression du bouton "Admin"** pour les visiteurs

## License

MIT
