C:\xampp\mysql\bin\mysqldump -d --port=3306 -h localhost -u root db_grs > "C:\xampp\htdocs\dev\offlinegrs\db_structure.sql"
C:\xampp\mysql\bin\mysqldump --port=3306 -h localhost -u root --no-create-info db_grs > "C:\xampp\htdocs\dev\offlinegrs\db_data.sql"

pause