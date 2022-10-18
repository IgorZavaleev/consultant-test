FROM nginx:latest

COPY docker-config/webserver/hosts/localhost.conf /etc/nginx/conf.d/localhost.conf

WORKDIR /www
COPY . .

VOLUME /www

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]