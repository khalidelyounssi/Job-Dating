# Job-Dating
# 💼 Plateforme Job Dating

Une application moderne de Job Dating construite en **PHP Natif** utilisant une **Architecture MVC** personnalisée. Cette plateforme connecte les recruteurs aux candidats, facilitant la publication d'offres et le processus de candidature.

![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

## 🚀 Fonctionnalités

- **Architecture MVC :** Construite de zéro (Routeur, Contrôleur, Modèle, Vue).
- **Système d'Authentification :** Inscription, Connexion et Déconnexion sécurisées.
- **Sécurité :**
  - Protection CSRF (Cross-Site Request Forgery).
  - Protection contre les Injections SQL (via requêtes préparées PDO).
  - Protection XSS (Nettoyage des entrées).
  - Hachage des mots de passe (Bcrypt).
- **Interface Utilisateur :** Design moderne et responsive utilisant **Tailwind CSS**.
- **Base de Données :** Connexion MySQL avec le pattern Singleton.

## 🛠️ Technologies Utilisées

- **Backend :** PHP 8+ (Orienté Objet)
- **Frontend :** HTML5, Tailwind CSS (CDN)
- **Base de données :** MySQL
- **Gestionnaire de dépendances :** Composer

## 📂 Structure du Projet

```bash
Job-Dating/
├── app/
│   ├── Controllers/   # Logique (Auth, Home...)
│   ├── Core/          # Cœur du framework (Routeur, Base de données, Validateur...)
│   ├── Models/        # Interactions BDD (User, Job...)
│   └── Views/         # Templates HTML
├── public/            # Point d'entrée (index.php) & Assets
├── config/            # Fichiers de configuration
├── vendor/            # Dépendances Composer
└── README.md