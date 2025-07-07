# ProcurePro Test Setup

## 1. Domain Setup and HTTPS

* Made changes to the nginx server block to handle https traffic. 
* Added self signed certificates to enable https communication. To run this project locally, place your ssl cert under `/config/nginx/ssl/selfsigned.crt` and key under `config/nginx/ssl/selfsigned.key`. To generate self signed certs use - `openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout selfsigned.key -out selfsigned.crt -subj "/C=AU/ST=NSW/L=Sydney/O=Private/CN=app.test"`
* Updated the nginx.conf server_name directive to specify domain name `app.test`
* Updated local hosts file to handle hostname resolution. On MacOS, edit the `/etc/hosts` file to add a new line `127.0.0.1 app.test`. This will map the hostname to localhost(nginx)

## 2. NGINX + PHP-FPM configuration

* Updated nginx.conf with new directive`client_max_body_size`, to allow nginx to handle large request
* Updated the php location block in nginx.conf to apply file size upload limits at php layer
* The changes performed to nginx.conf can be simply brought into effect using `docker-compose exec nginx nginx -s reload` with `zero downtime`

##  3. Centralized Application Logging

* Created a fluentbit container to collect logs from other containers like nginx and php container
* Updated php and nginx docker service to use bind mount to store logs to shared local folder on the host
* Added fluent-bit.conf file to define log sources, enriched the logs with labels like `container-name`, `service-name` for easy log filtering and monitoring
