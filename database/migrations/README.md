#  Système de Gestion de Boutique — Laravel
---
# CAHIER DE CHARGE
---
> Projet réalisé dans le cadre du cours de **Programmation Web Dynamique** — 2025/2026

---

## Table des Matières

- [Présentation](#présentation)
- [Objectifs](#objectifs)
- [Fonctionnalités](#fonctionnalités)
- [Architecture Technique](#architecture-technique)
- [Modèle Conceptuel de Données](#modèle-conceptuel-de-données)
- [Structure de la Base de Données](#structure-de-la-base-de-données)
- [Installation](#installation)
- [Utilisation](#utilisation)
- [Captures d'écran](#captures-décran)

---

## Présentation

Monsieur Ali est propriétaire d'une boutique commerciale dont la gestion est entièrement manuelle. Ce projet vise à informatiser ses activités grâce à une application web développée avec **Laravel**.

### Problèmes identifiés
- Risques élevés d'erreurs humaines
- Pertes de données
- Suivi difficile des ventes et des stocks
- Perte de temps dans la gestion quotidienne

---

## 🎯 Objectifs

Le système permet à l'administrateur (Monsieur Ali) de :

- ✅ Enregistrer et gérer les informations des clients
- ✅ Enregistrer et gérer les produits de la boutique
- ✅ Enregistrer les commandes effectuées par les clients
- ✅ Calculer automatiquement les montants des commandes
- ✅ Mettre à jour le stock automatiquement après chaque commande
- ✅ Générer et télécharger les factures au format PDF
- ✅ Consulter l'historique des ventes et des commandes

---

## ⚙️ Fonctionnalités

### 👤 Gestion des Clients
| Action | Description |
|--------|-------------|
| Ajouter | Enregistrer un nouveau client |
| Modifier | Mettre à jour les informations d'un client |
| Supprimer | Supprimer un client du système |
| Lister | Consulter la liste complète des clients |

**Informations client :** Identifiant, Nom, Prénom, Téléphone, Adresse, Email

---

### 📦 Gestion des Produits
| Action | Description |
|--------|-------------|
| Ajouter | Enregistrer un nouveau produit |
| Modifier | Mettre à jour les informations d'un produit |
| Supprimer | Retirer un produit du catalogue |
| Lister | Consulter le catalogue avec indicateur de stock |

**Informations produit :** Référence, Désignation, Prix unitaire, Quantité en stock, Description

---

### 🧾Gestion des Commandes
| Action | Description |
|--------|-------------|
| Créer | Créer une commande pour un client |
| Ajouter des produits | Sélectionner plusieurs produits par commande |
| Calcul automatique | Montant total calculé automatiquement |
| Mise à jour stock | Stock mis à jour après validation |
| Historique | Consulter toutes les commandes passées |

**Informations commande :** Numéro, Date, Client, Produits commandés, Quantités, Prix unitaires, Montant total

---

### Génération de Factures PDF
- Génération automatique après validation d'une commande
- Affichage détaillé des produits achetés
- Calcul automatique du total à payer
- Téléchargement au format PDF

---

## Architecture Technique

### Technologies Utilisées

| Composant | Technologie | Version |
|-----------|-------------|---------|
| Backend | Laravel (PHP) | 13.x |
| Frontend | Bootstrap | 5.3 |
| Base de données | MySQL (XAMPP) | 8.x |
| ORM | Eloquent | Inclus Laravel |
| Génération PDF | DomPDF | barryvdh/laravel-dompdf |
| Serveur de dev | PHP Artisan | Inclus Laravel |

### Architecture MVC

```
app/
├── Http/
│   └── Controllers/
│       ├── ClientController.php
│       ├── ProduitController.php
│       └── CommandeController.php
├── Models/
│   ├── Client.php
│   ├── Produit.php
│   ├── Commande.php
│   └── LigneCommande.php
resources/
└── views/
    ├── layouts/
    │   └── app.blade.php
    ├── clients/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── edit.blade.php
    ├── produits/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── edit.blade.php
    └── commandes/
        ├── index.blade.php
        ├── create.blade.php
        ├── show.blade.php
        └── pdf.blade.php
routes/
└── web.php
database/
└── migrations/
    ├── create_clients_table.php
    ├── create_produits_table.php
    ├── create_commandes_table.php
    └── create_ligne_commandes_table.php
```

---

## Modèle Conceptuel de Données

```
┌─────────────┐         ┌─────────────┐         ┌──────────────────┐         ┌─────────────┐
│   CLIENT    │  1,1    │  COMMANDE   │  1,N    │  LIGNE_COMMANDE  │  1,1    │   PRODUIT   │
│─────────────│────────>│─────────────│────────>│──────────────────│────────>│─────────────│
│ #id_client  │  PASSE  │ #id_commande│ CONTIENT│ #id              │ CONCERNE│ #id_produit │
│ nom         │         │ date        │         │ commande_id (FK) │         │ reference   │
│ prenom      │  0,N    │ client_id   │  1,1    │ produit_id (FK)  │  1,N    │ designation │
│ telephone   │         │ montant_total         │ quantite         │         │ prix_unit.. │
│ adresse     │         └─────────────┘         │ prix_unitaire    │         │ qte_stock   │
│ email       │                                 │ sous_total       │         │ description │
└─────────────┘                                 └──────────────────┘         └─────────────┘
```

### Relations
- Un **CLIENT** passe **0 ou plusieurs COMMANDES** (1,1 — 0,N)
- Une **COMMANDE** contient **1 ou plusieurs LIGNES** (1,1 — 1,N)
- Une **LIGNE_COMMANDE** concerne **1 PRODUIT** (1,N — 1,1)

---

## 🗄️ Structure de la Base de Données

### Table `clients`
```sql
id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
nom         VARCHAR(255) NOT NULL
prenom      VARCHAR(255) NOT NULL
telephone   VARCHAR(255) NOT NULL
adresse     VARCHAR(255) NOT NULL
email       VARCHAR(255) UNIQUE NOT NULL
created_at  TIMESTAMP
updated_at  TIMESTAMP
```

### Table `produits`
```sql
id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
reference       VARCHAR(255) UNIQUE NOT NULL
designation     VARCHAR(255) NOT NULL
prix_unitaire   DECIMAL(10,2) NOT NULL
quantite_stock  INT DEFAULT 0
description     TEXT
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

### Table `commandes`
```sql
id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
date_commande   DATE NOT NULL
client_id       BIGINT UNSIGNED (FK → clients.id)
montant_total   DECIMAL(10,2) DEFAULT 0
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

### Table `ligne_commandes`
```sql
id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
commande_id     BIGINT UNSIGNED (FK → commandes.id)
produit_id      BIGINT UNSIGNED (FK → produits.id)
quantite        INT NOT NULL
prix_unitaire   DECIMAL(10,2) NOT NULL
sous_total      DECIMAL(10,2) NOT NULL
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

---

## Installation

### Prérequis
- PHP 8.x
- Composer
- MySQL (XAMPP)
- Node.js (optionnel)

### Étapes

**1. Cloner le projet**
```bash
git clone https://github.com/votre-username/ges_boutique.git
cd ges_boutique
```

**2. Installer les dépendances**
```bash
composer install
```

**3. Configurer l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Configurer la base de données dans `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ges_boutique
DB_USERNAME=root
DB_PASSWORD=
```

**5. Créer la base de données et migrer**
```bash
php artisan migrate
```

**6. Lancer le serveur**
```bash
php artisan serve
```

**7. Accéder à l'application**
```
http://localhost:8000
```

---

## 📖 Utilisation

### Routes Disponibles

| Méthode | Route | Description |
|---------|-------|-------------|
| GET | `/clients` | Liste des clients |
| GET | `/clients/create` | Formulaire d'ajout |
| POST | `/clients` | Enregistrer un client |
| GET | `/clients/{id}/edit` | Formulaire de modification |
| PUT | `/clients/{id}` | Mettre à jour un client |
| DELETE | `/clients/{id}` | Supprimer un client |
| GET | `/produits` | Catalogue des produits |
| GET | `/commandes` | Liste des commandes |
| GET | `/commandes/{id}` | Détails d'une commande |
| GET | `/commandes/{id}/pdf` | Télécharger la facture PDF |

---

## Commandes Artisan Utiles

```bash
# Migrations
php artisan migrate
php artisan migrate:fresh      # Recrée toutes les tables

# Créer un modèle + migration
php artisan make:model NomModele -m

# Créer un contrôleur
php artisan make:controller NomController

# Lister les routes
php artisan route:list

# Vider le cache
php artisan optimize:clear
```

---

## 👨‍💻 Auteur

Projet réalisé par **Madjiyengar Axel Joseph** 

Génie Inbformatique Licence 2 - CEFOD Business School