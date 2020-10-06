Doctor
======================

Installation:

1. Clone repository

2. Run composer install

3. Configure your web server

4. Change config params ".env" file in root project directory (MongoDB)
        
        Example:
        MONGODB_URL=mongodb://localhost:27017
        MONGODB_DB=doctor 

5. Run commands:
    
        php bin/console doctrine:mongodb:schema:create
        php bin/console doctrine:mongodb:fixtures:load
        yarn install
        yarn encore dev

6. Done