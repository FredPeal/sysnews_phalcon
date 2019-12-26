service mysql start &&  \
/etc/init.d/php7.2-fpm start && \
service nginx start && \
mysql -u root --execute="CREATE DATABASE sysnews;" && \
mysql -u root --database="sysnews" -p < "/app/docker/user.sql" 
bash