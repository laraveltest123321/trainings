# laravel-test
1. Clone the repo
2. Run composer install command 
3. set the proper permissions on all files 
    Run the foloowing commands
        sudo chgrp -R www-data storage bootstrap/cache
        sudo chmod -R ug+rwx storage bootstrap/cache
4. setup application environment for the project
    Run cp .env.example .env
5. Generate app. key
    Run php artisan key:generate
6. Setup .env file configurations
7. Run migrations and seeds
    php artisan migrate --seed
8. To create the symbolic link to storage folder from public 
   Run php artisan storage:link

9. Add Nginx default virtual host configurations
    Run the following commands..
    sudo cp /etc/nginx/sites-available/default /etc/nginx/sites-available/example.com
    sudo nano /etc/nginx/sites-available/example.com
10. set configs to the file (
    
	server {
		listen 80;
		send_timeout 3600; ## 1 час
		proxy_read_timeout 3600; ## 1 час
		fastcgi_read_timeout 300;
		root /home/lusine/learning/example/public;
		index index.php index.html index.htm;
		server_name example.com;
		client_max_body_size 100m;
		location / {
		        try_files $uri $uri/ /index.php?$query_string;
		}
		location ~ \.php$ {
		        try_files $uri /index.php =404;
		        fastcgi_split_path_info ^(.+\.php)(/.+)$;
		        fastcgi_pass unix:/run/php/php7.2-fpm.sock;
		        fastcgi_index index.php;
		        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
		        include fastcgi_params;
		}
	}
      )
11. Set link to this file
	Run sudo ln -s /etc/nginx/sites-available/example.com /etc/nginx/sites-enabled/
12. Reload Nginx
        sudo systemctl reload nginx
13. Add hostname to hosts file (etc/hosts)
	127.0.0.1 example.com


