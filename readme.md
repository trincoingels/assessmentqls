# Assessment QLS

### Installatie

1. Clone the repository:
   ~~~bash
   git clone <your-repo-url>
   cd <your-repo-directory>
   ~~~

2. Install dependencies:
   ~~~bash
   composer install
   ~~~

3. Kopieer het .env bestand
   ~~~bash
   cp .env.example .env
   ~~~
   En voeg de volgende variabelen toe en vul aan:
   ~~~bash
    QLS_API_HOST=
    QLS_API_USERNAME=
    QLS_API_PASSWORD=
    QLS_API_COMPANYID=
    QLS_API_BRANDID=
   ~~~   

3. Start the development server:
   ~~~bash
   php artisan serve
   ~~~

4. Access the shipping label generator at:
   ~~~
   http://localhost:8000/order/958201
   ~~~

### Keuzes en verantwoording

1. Order

   Order informatie zit in een JSON bestand in de storage folder

2. Producten

   Product informatie (eenmalige call) heb ik ook opgeslagen in een JSON bestand in de storage folder. Deze data veranderd, in de (test) situatie niet meer.
   Ook voor nu alleen de eerste combinatie aangehouden.

3. Pakbon

   Er van uitgegaan dat de pakbon altijd een A4 is met aan de linkerkant ordergegevens en aan de rechterkant een afneembaar stickervel. Pakbon kan maar 1 keer gegeneerd worden. Eenmaal aanwezig op de server, dan zal deze geserveerd worden bij een nieuwe printjob.


---
