# Next Basket Internal Evaluation

### Pre-requisite

1. **Docker Desktop**: For the local environment

### Installation Steps

- Once you're in the root directory, run 
  - For first time running: **docker-compose up -d --build**
  - To run normally: **docker-compose up -d**

### Docker

- To run composer installation
  - docker exec -it php sh -c "cd /var/www/nb/users-service && composer install"
  - docker exec -it php sh -c "cd /var/www/nb/notifications-service && composer install"

- To run docker migrations
  - docker exec -it php sh -c "cd /var/www/nb/users-service && bin/console doctrine:migrations:migrate"

- To run consumer for notifications
  - docker exec -t php sh -c "cd /var/www/nb/notifications-service && bin/console messenger:consume redis"

- To stop worker
  - docker exec -t php sh -c "cd /var/www/nb/notifications-service && bin/console messenger:stop-workers"

- To run Tests
  - docker exec -t php sh -c "cd /var/www/nb/users-service && ./vendor/bin/phpunit"
  - docker exec -t php sh -c "cd /var/www/nb/notifications-service && ./vendor/bin/phpunit"

### Incase errors happening when executing commands(Windows)
- docker exec -u 0 -t php sh -c "apt-get update && apt-get install -y dos2unix"
- docker exec -t php sh -c "dos2unix /var/www/nb/users-service/bin/console"
- docker exec -t php sh -c "dos2unix /var/www/nb/notifications-service/bin/console"
- docker exec -u 0 -t php sh -c "chmod +x /var/www/nb/users-service/bin/console"
- docker exec -u 0 -t php sh -c "chmod +x /var/www/nb/notifications-service/bin/console"

### Virual Host
- For windows
  - Open **Notepad** and run as **Administrator** and open this file **C:\Windows\System32\drivers\etc\hosts**
- For mac
  - Open **/etc/hosts** and update the file using **nano** or **vim**
- Add the **server_name** that you will find in the conf/default.conf

  