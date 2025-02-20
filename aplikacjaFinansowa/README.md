# Aplikacja wspomagająca zarządzania finansami osobistymi

## Opis
Aplikacja umożliwia skuteczne zarządzanie finansami osobistymi poprzez planowanie, organizowanie, monitorowanie i kontrolowanie swoich środków finansowych. Pomaga użytkownikom w osiąganiu celów finansowych, takich jak oszczędzanie, kontrolowanie wydatków oraz tworzenie realistycznego budżetu.

## Kluczowe Funkcje

- **Kalkulator wynagrodzeń** – Oblicza wynagrodzenie netto na podstawie wynagrodzenia brutto, wieku i typu umowy (umowa o pracę, umowa zlecenie).
- **Monitorowanie dochodów i wydatków** – Umożliwia dodawanie i śledzenie przychodów oraz wydatków, co pomaga w bieżącej analizie finansów.
- **Ustalanie celu oszczędnościowego** – Pomaga użytkownikowi ustalić cel oszczędnościowy i monitorować postępy w jego realizacji.
- **Limit oszczędnościowy** – Umożliwia ustalenie miesięcznej kwoty, którą użytkownik chce zaoszczędzić.
- **Wykresy i analizy wydatków** – Wizualizuje strukturę wydatków i pomaga w identyfikacji obszarów, w których możliwe są oszczędności.
- **Personalizacja budżetu** – Możliwość dostosowania budżetu do indywidualnych potrzeb użytkownika (wydatki, dochody, składki itp.).

## Wymagania funkcjonalne

1. **Rejestracja i logowanie** – Proces tworzenia konta i dostęp do danych finansowych po zalogowaniu.
2. **Dodawanie transakcji** – Rejestrowanie dochodów i wydatków użytkownika.
3. **Kalkulator pracy** – Obliczenie wynagrodzenia na podstawie liczby przepracowanych dni i formy zatrudnienia.
4. **Ustalanie limitu oszczędnościowego** – Określenie maksymalnej kwoty oszczędności na dany miesiąc.
5. **Ustalanie celu oszczędnościowego** – Definiowanie celu finansowego, np. zakup samochodu, i monitorowanie postępu.

## Wymagania niefunkcjonalne

1. **Intuicyjny interfejs użytkownika** – Łatwy w obsłudze i estetyczny design.
2. **Responsywność** – Aplikacja dostosowuje się do różnych urządzeń i rozdzielczości ekranu.
3. **Wydajność** – Płynne działanie, minimalizowanie opóźnień i zapewnienie szybkości w przetwarzaniu danych.
4. **Optymalizacja zasobów systemowych** – Minimalne zużycie pamięci RAM, procesora i przepustowości sieci.

## Instalacja

1. **Programy do pobrania**:
   - Composer
   - Node.js
   - XAMPP (najbardziej aktualna wersja)

2. **Wykonanie instalacji**:
   - Wypakuj projekt w folderze `htdocs` w folderze instalacyjnym XAMPP (np. `C:\xampp\htdocs`).
   
3. **Konfiguracja bazy danych**:
   - Uruchom XAMPP i włącz serwery Apache oraz MySQL.
   - Otwórz **phpMyAdmin** w przeglądarce (zwykle dostępne pod adresem `http://localhost/phpmyadmin`).
   - Utwórz nową bazę danych o nazwie **fianse**.
   - Zaimportuj plik SQL znajdujący się w projekcie (np. `database.sql`).

4. **Dane logowania**:
   - W bazie danych znajduje się jedno konto:
     - **Login**: Test
     - **Hasło**: P@ssw0rd1

