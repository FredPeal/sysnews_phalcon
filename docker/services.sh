service mysql start &&  \
/etc/init.d/php7.2-fpm start && \
service nginx start && \
mysql -u root -psecret --execute="
CREATE DATABASE sysnews;
CREATE USER 'sysnews' IDENTIFIED BY 'D7k6hdN6L6!h';
GRANT USAGE ON *.* TO 'sysnews'@localhost IDENTIFIED BY 'D7k6hdN6L6!h';
GRANT USAGE ON *.* TO 'sysnews'@'%' IDENTIFIED BY 'D7k6hdN6L6!h';
GRANT ALL privileges ON sysnews.* TO 'sysnews'@localhost;
 "