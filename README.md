# 🧠 MemoryGame

Gra memory stworzona w Laravelu i Vue, pozwalająca graczowi ćwiczyć pamięć poprzez dopasowywanie par kart. W grze dostępne są trzy poziomy trudności oraz różne animacje wzbogacające rozgrywkę.

## 🎮 Funkcje

- Trzy poziomy trudności: łatwy, średni, trudny
- Porównywanie kart – pasujące zostają odkryte
- Licznik czasu i licznik ruchów
- Reset gry po wygranej
- Animowane tło i efekty kart
- Ruchome talie przy wyborze poziomu trudności

## 🛠️ Technologie

- [Laravel](https://laravel.com/)
- [Vue.js](https://vuejs.org/)
- HTML, CSS, JavaScript

## 🚀 Jak uruchomić projekt lokalnie

1. **Sklonuj repozytorium**:
   ```bash
   git clone https://github.com/Marianno77/MemoryGame.git
   cd MemoryGame
   ```

2. **Zainstaluj zależności backendowe (Laravel)**:
   ```bash
   composer install
   ```

3. **Zainstaluj zależności frontendowe (Vue)**:
   ```bash
   npm install
   npm run dev
   ```

4. **Uruchom migracje i seedery**:
   ```bash
   php artisan migrate
   php artisan db:seed --class=DeckWithCardsSeeder
   ```

5. **Uruchom serwer aplikacji**:
   ```bash
   php artisan serve
   ```

6. **Otwórz przeglądarkę**:
   - Przejdź do `http://localhost:8000`

## 👤 Autor

Mariusz Bienasz

## 📄 Licencja

Projekt nie posiada przypisanej licencji. Możesz go używać na własną odpowiedzialność. Jeśli chcesz go rozwijać lub wykorzystać komercyjnie – skontaktuj się z autorem.

---

# 🧠 MemoryGame

A memory matching game built using Laravel and Vue that lets players train their memory by matching pairs of cards. The game includes three difficulty levels and is enhanced with smooth animations and interactive effects.

## 🎮 Features

- Three difficulty levels: easy, medium, hard
- Card comparison logic – matched pairs stay revealed
- Time tracking and move counter
- Game reset after winning
- Animated background and card effects
- Animated decks to choose difficulty level

## 🛠️ Technologies

- [Laravel](https://laravel.com/)
- [Vue.js](https://vuejs.org/)
- HTML, CSS, JavaScript

## 🚀 How to Run Locally

1. **Clone the repository**:
   ```bash
   git clone https://github.com/Marianno77/MemoryGame.git
   cd MemoryGame
   ```

2. **Install backend dependencies (Laravel)**:
   ```bash
   composer install
   ```

3. **Install frontend dependencies (Vue)**:
   ```bash
   npm install
   npm run dev
   ```

4. **Run migrations and seed the database**:
   ```bash
   php artisan migrate
   php artisan db:seed --class=DeckWithCardsSeeder
   ```

5. **Start the application server**:
   ```bash
   php artisan serve
   ```

6. **Open the browser**:
   - Go to `http://localhost:8000`

## 👤 Author

Mariusz Bienasz

## 📄 License

This project does not currently have an official license. You may use it at your own risk. For commercial or extended use, please contact the author.

---
