To run this program locally:
Clone the reopository into your desiered location
Open a terminal window navigate to the project folder
RUN composer install
RUN npm install
RUN npm run dev
RUN cp .env.example .env
RUN php artisan key:generate
RUN php artisan serve
GO to localhost:8000
