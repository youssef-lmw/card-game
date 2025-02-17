# Jeu de Cartes

Une application de jeu de cartes avec un backend Symfony et un frontend React.

## Structure du Projet

Le projet est organisé en deux parties principales :

### `/backend`

Backend Symfony qui fournit l'API REST pour :
- Générer une main de cartes aléatoire
- Trier les cartes par couleur et valeur
- Gérer la logique du jeu

### `/frontend`

Frontend React qui :
- Affiche l'interface utilisateur
- Communique avec l'API backend
- Gère l'interaction utilisateur

## Installation

### Backend (Symfony)

```bash
# Aller dans le dossier backend
cd backend

# Installer les dépendances
composer install

# Démarrer le serveur
symfony server:start --port=8000
```

### Frontend (React)

```bash
# Aller dans le dossier frontend
cd frontend

# Installer les dépendances
npm install

# Démarrer l'application
npm start
```

## Utilisation

1. Ouvrir http://localhost:3000 dans le navigateur
2. L'application affiche une main de 10 cartes aléatoires
3. La main initiale montre les cartes dans l'ordre du tirage
4. La main triée montre les cartes dans l'ordre :
   - Par couleur : Carreaux → Cœur → Pique → Trèfle
   - Par valeur : AS → 2 → 3 → ... → 10 → Valet → Dame → Roi
5. Cliquer sur "Tirer une nouvelle main" pour obtenir de nouvelles cartes

## API

### GET /api/draw

Tire une nouvelle main de 10 cartes.

Réponse:
```json
{
  "initial_hand": [
    {"suit": "Coeur", "value": "7"},
    {"suit": "Pique", "value": "AS"}
  ],
  "sorted_hand": [
    {"suit": "Carreaux", "value": "4"},
    {"suit": "Coeur", "value": "7"}
  ]
}
```

## Composants Principaux

### Backend

Le service CardGameService contient 3 méthodes :

1. `generateRandomHand()` : 
   - Crée un deck de 52 cartes
   - Mélange les cartes
   - Retourne 10 cartes

2. `sortHand()` : 
   - Trie les cartes par couleur (Carreaux, Coeur, Pique, Trèfle)
   - Pour une même couleur, trie par valeur (AS, 2, 3, ..., Roi)

3. `generateDeck()` : 
   - Crée les 52 cartes du jeu
   - Combine chaque couleur avec chaque valeur

### Frontend

- `Card.jsx` : Affiche une carte individuelle
- `Game.jsx` : Gère l'affichage des mains et le bouton de tirage
