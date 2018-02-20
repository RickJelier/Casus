**WARNING - use at own risk**

**Installation:**
1. Clone the project (git clone https://github.com/RickJelier/Casus [directory])
2. cd [directory]
3. composer install
4. Change the .env file configuration to match server configuration (DATABASE_URL=mysql://root@127.0.0.1:3306/casus)
5. php bin/console doctrine:database:create
6. php bin/console doctrine:migrations:migrate
7. php bin/console server:run

You are ready to start.

**Usage:** 
1. Navigate to http://127.0.0.1:8000
2. Type in an amount to insert
3. Wait (this can take very long).
4. Navigate to http://127.0.0.1:8000/admin to show generated data.