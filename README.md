# 🚀 Projet Symfony - Food

## 📖 Description  

**Food** est une application web développée avec **Symfony** qui permet aux utilisateurs de :

- ✅ **Créer des plats** pour chaque jour de la semaine
- ⭐ **Avoir les ingredients** pour chaque plat
- ⭐ **Avoir la liste de courses** associée aux ingrédients de la semaine

---

## 👥 Collaborateurs  

- **Maoulida Raoul** 
- **Giordano Yoann** 

---

## ⚙️ Installation et Configuration  

Suivez ces étapes pour installer et exécuter le projet **Food** sur votre environnement local.  

### 📥 1. Cloner le dépôt  
Ouvrez un terminal et exécutez la commande suivante :
```bash
git clone https://github.com/GIORDANO-yoann-2225038a/Food.git
cd Food
```
### ⚙️ 2. Installation
```bash
composer install
```
### 🔧 3. Installer les dépendances JavaScript 
```bash
npm install
npm run dev
```
### 🎨 4. Si vous avez pas tailwind d'installer   
```bash
composer require symfonycasts/tailwind-bundle
php bin/console tailwind:init
```
### 📦 5. Sinon, installation des dépendances 
```bash
php bin/console tailwind:build
```
### 🎨 6.  Build Tailwind 
```bash
php bin/console tailwind:build
```
### 📡 7. Installation et configuration de l’API Platform
```bash
composer require api
```
### 🗄️ 8. Exécuter les migrations de base de données 
```bash
php bin/console doctrine:migrations:migrate
```
### 🗂️ 9. Charger les données de test 
```bash
 php bin/console doctrine:fixtures:load
 ```
⚠️ Attention : Cette commande réinitialisera les données existantes en base !

### 🚀 10.  Démarrez le serveur 
```bash
symfony serve
```
