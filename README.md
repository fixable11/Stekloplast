## Установка 

#### Внимание!!! На компьютере должен быть установлен докер

1. `git clone https://github.com/fixable11/Stekloplast.git ./ `
2. `make init` <br>

3. `cp .env.example .env`
4. `make bash` и затем пишем внутри контейнера
```
composer dumpautoload
php artisan key:generate
php artisan migrate
php artisan storage:link
```

5. `make frontend-bash` и затем пишем внутри контейнера
```
cd ./client
npm i
npm run dev
```
6. `sudo chmod 777 -R ./storage/`

Адрес фронта: http://localhost:8080/ <br>
Админка: http://localhost:8082/admin <br>
Phpmyadmin: http://localhost:8081/ (login: root; password: root) <br>
Mailer: http://localhost:8083/

Весь фронт находится в папке client

### Полезные команды

`make up` - запуск докер контейнера <br>
`make down` - остановка докер контейнера <br>
`make bash` - доступ php-fmp контейнеру <br>
`make perm` - изменение прав доступа к файлам (чтобы их можно было редактировать) <br>
`make sniff` - запуск снифера <br>
