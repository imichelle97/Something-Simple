# CS160-OFS
CS 160 Project - Something Simple

ABOUT US: Something Simple is a grocery delivery company that delivers fresh produce right to your doorsteps using our cutting-edge drone technology. Our two locations are based in downtown San Jose and San Mateo. Our delivery services are available in Santa Clara County and San Mateo County as of now.  Once an order is made, our drones will launch from the nearest location to deliver your order.  

SERVER CONFIGURATION: Something Simple is actually deployed on its own server.  You may explore our website by going to the following link:
http://something-simple.bitnamiapp.com/cs160/. If you would like to watch our server configuration video, you can view it here: https://youtu.be/AEFqWkakcPg

LOCAL CONFIGURATION: If you would like to run Something Simple on your local machine, you can download our source files at our GitHub: https://github.com/imichelle97/Something-Simple. Our application uses the LAMP Stack (Linux, Apache, MySQL, PHP). We would recommend the following steps to ensure a successful installation of our application:

1. Download our source files from the above GitHub Repository link.
2. Download XAMPP for your operating system (https://www.apachefriends.org/index.html)
3. Once you get XAMPP installed, you should now access to the control panel.  Make sure that Apache Web Server and MySQL Database are running. 
4. Go to your browser, and type in 'localhost'.  You should then be taken to the home page of XAMPP.
5. Click on phpMyAdmin
6. Click on User Accounts.  **The next few steps are really important to set up correctly.  Our source code has specific user account and password for security purposes for our database**
7. Click on ‘Add a new user’ towards the bottom of the page.  Input in the following information:
    **User name: OFS
    Host name: localhost (remove the % that is already inputted in that field)
    Password: sesame
    Make sure to check on ‘Create database with same name and grant all privileges’**
8. Now you created the database needed for Something Simple.  Now you can click on OFS on the left side panel.  There should be no tables yet in the OFS database. 
9. The next step is to import the SQL dump.  In our GitHub repository, there is a file called OFS.sql.  
10. Click ‘Import’, browse to the OFS.sql file, and import to the database.  Now you should be able to see six tables.  You now successfully imported our database. 
11. The next step is to transfer our source files to the correct directory.  You will need to navigate through XAMPP until you reach htdocs.  
    For Mac, it should be Applications/XAMPP/htdocs
    For Windows, it should be C:\xampp\htdocs
12. Create a folder called “Something-Simple” in htdocs.  
13. Within that folder, copy over all the source files (including the images folder, all the php files).
14. Now from your browser, you should be able to navigate to Something Simple by typing in http://localhost/something-simple/. 

    











