CREATE USER 'sysnews' IDENTIFIED BY 'nosenose';
GRANT USAGE ON *.* TO 'sysnews'@localhost IDENTIFIED BY 'nosenose';
GRANT USAGE ON *.* TO 'sysnews'@'%' IDENTIFIED BY 'nosenose';
GRANT ALL privileges ON `sysnews`.* TO 'sysnews'@localhost;