# SneakerMVC

Deze handleiding beschrijft de stappen om de SneakerMVC Laravel-applicatie lokaal op te starten voor ontwikkelingsdoeleinden/beoordeling. Zorg ervoor dat je alle vereisten hebt geïnstalleerd voordat je begint. Ook is er een uitleg beschikbaar van wat de applicatie kan

## Functies applicatie
### User
- Volledige CRUD om sneakers te managen
- Mogelijk om sneakers te verkopen op het platform
- Mogelijk om sneaker te kopen op het platform
- Advertenties aan/uit zetten
- Winst bekijken per sneaker
- Account gegevens aanpassen

### Admin
- Mogelijkheid om advertenties te goedkeuren en afkeuren

### Algemeen
- Filteren op advertenties



## Vereisten

- PHP = 8.2.11
- Composer (https://getcomposer.org/)
- Node.js en NPM (https://nodejs.org/)
- Een Postgresql database of het gebruik van docker

## Installatie

1. **Kloon het project vanaf de Git-repository:**

    ```bash
    git clone <repository-url> <project-map>
    ```

2. **Navigeer naar de projectmap:**

    ```bash
    cd <project-map>
    ```

3. **Installeer PHP-afhankelijkheden met Composer:**

    ```bash
    composer install
    ```

4. **Maak een kopie van het .env-bestand:**

    ```bash
    cp .env.example .env
    ```

5. **Genereer een applicatiesleutel:**

    ```bash
    php artisan key:generate
    ```

6. **Bewerk het .env-bestand:**

    Pas de database-instellingen in het .env-bestand aan met de juiste gegevens voor jouw lokale omgeving, zoals database-naam, gebruikersnaam en wachtwoord. Ook kan je hier je docker configureren als een image gebruikt zoals aline/pgsql

7. **Voer de database-migraties uit:**

    ```bash
    php artisan migrate
    ```

8. **Start de ingebouwde ontwikkelingsserver:**

    ```bash
    php artisan serve
    ```

   De applicatie is nu toegankelijk op http://localhost:8000.

9. **Compileer assets (CSS en JavaScript):**

    ```bash
    npm install
    npm run dev
    ```

   Hiermee worden assets gecompileerd en bijgewerkt.

## Gebruik

Je kunt nu de Laravel-applicatie openen in je webbrowser op http://localhost:8000 en beginnen met ontwikkelen. Zorg ervoor dat je ook de [Laravel-documentatie](https://laravel.com/docs) raadpleegt voor meer informatie over het werken met Laravel.

## Probleemoplossing

- Als je problemen ondervindt, controleer dan de webserver- en database-instellingen in het .env-bestand.
- Zorg ervoor dat de vereiste extensies zijn ingeschakeld in je PHP-configuratie.
- Als je aangepaste omgevingsvariabelen hebt, pas deze dan aan in het .env-bestand.
- Zorg ervoor dat je de juiste permissies hebt ingesteld voor mappen en bestanden die door de applicatie worden gebruikt.

