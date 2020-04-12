C:\xampp\mysql\bin\mysqldump -d --port=3306 -h localhost -u root -pusbw db_grs > "db_structure.sql"
C:\xampp\mysql\bin\mysqldump --port=3306 -h localhost -u root -pusbw --no-create-info db_grs > "db_data.sql"

pause