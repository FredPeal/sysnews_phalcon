service mysql start &&  \
/etc/init.d/php7.2-fpm start && \
service nginx start && \
mysql -u root -psecret --execute="CREATE DATABASE sysnews;" && \
mysql -u root -psecret --execute="CREATE USER 'sysnews' IDENTIFIED BY 'nosenose';" && \
mysql -u root -psecret --execute="GRANT USAGE ON *.* TO 'sysnews'@localhost IDENTIFIED BY 'nosenose';" && \
mysql -u root -psecret --execute="GRANT USAGE ON *.* TO 'sysnews'@'%' IDENTIFIED BY 'nosenose';" 
mysql -u root -psecret --execute="GRANT ALL privileges ON `sysnews`.* TO 'sysnews'@localhost;" && \
bash