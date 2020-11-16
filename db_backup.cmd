C:\xampp\mysql\bin\mysqldump -d --port=3306 -h localhost -u root -pusbw db_sapgrs > "db_structure.sql"
C:\xampp\mysql\bin\mysqldump --port=3306 -h localhost -u root -pusbw --no-create-info db_sapgrs > "db_data.sql"

pause