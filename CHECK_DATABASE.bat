@echo off
cd /d c:\xampp\mysql\bin
mysql -u root japlo_db -e "SHOW TABLES;"
echo.
echo Total users:
mysql -u root japlo_db -e "SELECT COUNT(*) as total FROM users;"
echo.
echo Total drivers:
mysql -u root japlo_db -e "SELECT COUNT(*) as total FROM drivers;"
echo.
echo Total orders:
mysql -u root japlo_db -e "SELECT COUNT(*) as total FROM orders;"
pause
