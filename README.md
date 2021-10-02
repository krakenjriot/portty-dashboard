 <img src="https://github.com/krakenjriot/portty-dashboard/blob/main/pd.png" width="750"/>   
 <img src="https://github.com/krakenjriot/portty-dashboard/blob/main/help/images/main.png" width="750" />     

## Introduction
PORTTY Command Center is a modified free template dashboard from SB Admin 2 Theme Bootstrap. The template has been modified to provide a free dashboard for portty application members.

The page admin was created to provide users means to monitor, manage and control multiple arduino boards, for switching electrical relays on-demand, through scheduler or trigger by sensors

Primary goal of this project is to develop a complete IoT package solution to people who might not have the resources to create their own.
And so ordinary and non-technical people may enjoy the benifits of the readily avaialble open-source technologies around the world.

This project was intended originally to monitor, control and collect data from remote `farm houses` and now expanding to a more bigger areas of `applied application on farming management

# On part of my customization. All are free to copy, modify and develop on top of this starter package (PORTTY-DASHBOARD)

![](https://img.shields.io/github/downloads/krakenjriot/portty-dashboard/total)

## Table of Contents
- [Prerequisite](#prerequisite)
- [Installation](#installation)

## Prerequisite
* Computer - `PC Compatible Machine` 
* Operating System - `Microsoft Windows`  - (Minimum Windows 8 )  
* PORTTY Hex File - Already included in the package `C:\xampp\htdocs\portty-dashboard\hex`
* Microcontroller Board
  * `Arduino Uno` - need info? [here](https://store.arduino.cc/usa/arduino-uno-rev3)
  * or `Arduino Mega` - need info? [here](https://store.arduino.cc/usa/mega-2560-r3)  
* Softwares
  * `XAMPP` Package - (How to install? [here](https://github.com/krakenjriot/portty-dashboard/blob/main/README-XAMPP-INSTALLATION.md))
  * Arduino Hex Uploader - ([xloader](https://github.com/krakenjriot/xloader)) aready included in the package `C:\xampp\htdocs\portty-dashboard\exe\xloader`


## Installation
* Step 0 Uploade the hex file ([show me how](https://github.com/krakenjriot/portty/blob/main/README-XLOADER.md))
* Step 1 Download `PORTTY Dashboard` package [here](https://github.com/krakenjriot/portty-dashboard/archive/refs/heads/main.zip)
* Step 2 Start  XAMPP  services ( Apache & MySQL`) 

   <img src="https://github.com/krakenjriot/portty-dashboard/blob/main/help/images/s2.png" width="750" />    
     

* Step 3 Go to `C:\xampp\htdocs` directory, and create another folder `portty-dashboard`
* Step 4 Extract the downloded package inside the folder `portty-dashboard`
* Step 5 The final directory should look like this `C:\xampp\htdocs\portty-dashboard` 
   <img src="https://github.com/krakenjriot/portty-dashboard/blob/main/help/images/s5.png" width="750" />      

* Step 6 Open phpMyAdmin link here `http://localhost/phpmyadmin/` or right-click this [[Link](http://localhost/phpmyadmin/)] and select `Open Link in New Tab`
* Now let's create an empty database
* Step 7 Click import and select the database template from the portty-dashboard directory `C:\xampp\htdocs\portty-dashboard\db\db_portty.sql` and after selecting the file `db_portty.sql` click the `Go` button 
   <img src="https://github.com/krakenjriot/portty-dashboard/blob/main/help/images/s7-0.png" width="750" />   
   <img src="https://github.com/krakenjriot/portty-dashboard/blob/main/help/images/s7-1.png" width="750" />
* Step 8 If you recieve no errors then the database creation is considered success

* Step 9 Open the `config` file in text editor and remove the password hash

   <img src="https://github.com/krakenjriot/portty-dashboard/blob/main/help/images/s9-0.png" width="750" />
   <img src="https://github.com/krakenjriot/portty-dashboard/blob/main/help/images/s9-1.png" width="750" />
* Step 10 Almost Done, open now the admin page [here](http://localhost/portty-dashboard/) 
* Congratulations! If you got the same page as shown below then you have successfully completed the setup and configuration of the package

   <img src="https://github.com/krakenjriot/portty-dashboard/blob/main/help/images/s10.png" width="750" />
* To proceed from here you can checkout our videos on youtube [here](https://www.youtube.com/watch?v=X6NLx9EjUtU)

 
