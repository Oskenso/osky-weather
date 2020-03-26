FROM php:7.2-fpm

RUN docker-php-ext-install pdo pdo_mysql


#If you would rather add in your source to the container
#use this block instead of the current permissions hack
#ADD ./src /var/www
#RUN chmod -R 775 /var/www && \
#    chown -R www-data:www-data /var/www
#RUN apk --no-cache add shadow && umask 775 /var/

ARG USER_ID
ARG GROUP_ID

RUN deluser www-data
RUN addgroup --gid $GROUP_ID www-data
RUN adduser --disabled-password --gecos '' --uid $USER_ID --gid $GROUP_ID www-data
        
USER www-data
