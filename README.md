# Initialization SQL
Check the `backup.sql` file to create a nessecessery structure.


# Docker
> sudo apt install docker docker-compose
> sudo groupadd docker
> sudo isermod -aG docker $USER
> newgrp docker

> docker ps -a
> docker images ls

> docker-compose up // Start docker
> docker-compose stop // Start docker CTRL+C

## Backup
> Example: docker exec CONTAINER /usr/bin/mysqldump -u root --password=root DATABASE > backup.sql
> In my case: docker exec sok_db_1 /usr/bin/mysqldump -u root --password=root test_db > backup.sql

## Restore into empty db
> Example: cat backup.sql | docker exec -i CONTAINER /usr/bin/mysql -u root --password=root DATABASE
> In my case: cat backup.sql | docker exec -i sok_db_1 /usr/bin/mysql -u root --password=root test_db

## Login and Pasword with SIGN UP
> email: test@test.lv
> password: test
