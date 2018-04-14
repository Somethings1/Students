# Students manage app by php.

### Features: Login, logout, see list of members,...(incoming in future: modify list with admin account)

## How to use:
 1. Download and install XAMPP, download and extract this project from github 
 2. Copy (or cut) the project folder into C:\xampp\htdocs (or in the drive that you installed XAMPP in)
 3. Open XAMPP Control panel, start the Apache server and MySQL
 4. Go to your web broswer (Chrome or Firefox any version, IE 9.0 or above is highly recommended). 
 5. Type in url bar: http://localhost/phpmyadmin. Press tab SQL
 6. Copy from "sql.txt" to the text feild in phpmyadmin>SQL tab. After that, press "GO" button
 7. Type in the url bar: http://localhost/Students
 8. Enjoy :))

**If you can't start apache server, it is because your 80 port is being used by another program. Following these stemp to fix it:**
 1. Open XAMPP Control panel
 2. Config > Service and Port Settings
 3. Change "Main port" value to 81
 4. Open file Explorer, go to xampp folder. From xampp folder, go to apache > conf > httpd.conf. Open it.
 5. On line 58, change the listen port to 81, on line 223, change the content to "ServerName localhost:81"
 6. Save the file
 7. In your web browser, instead of "http://localhost", use "http://localhost:81", or "http://127.0.0.1:81"
 8. That's it!
**To login:**
 If you use all the code in sql.txt, just login with username = "admin", password = "a". You'll have the access as "Exatra admin" (that can use every feature now and in future)


**Update 1.1:**
 - Added register feature 

**Update 2.0:**
 - Added administrators's features: Add, delete, and modify students's informations
 - Added Forgot password feature, that user can use it to get their account back
