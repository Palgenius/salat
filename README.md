# Salat

[![youtube link](http://img.youtube.com/vi/G2iqbx1pft8/0.jpg)](https://www.youtube.com/watch?v=G2iqbx1pft8) 
# https://www.youtube.com/watch?v=G2iqbx1pft8


Salat is a laravel php website project, which uses both Raspberry pi 3 and Ds1307, to show prayer times on a screen connected to the Raspberry pi by wifi. Moreover, it has two main screens the first one, which is shown on the screen, and the other one is an admin page, which is on the localhost of the Raspberry pi, to control the videos, images and sounds that are put on the screen. 

# Wifi SETUP
In order to use the Raspberry pi, you need to connect it to wifi and here is the link
https://www.raspberrypi.org/documentation/configuration/wireless/access-point.md
<a href="https://ibb.co/GH8c4pc"><img src="https://i.ibb.co/wcPMFgM/pi-ds1307.jpg" alt="pi-ds1307" border="0"></a><br /><br />

# DS1307  SETUP steps
Ds1307 is a raspberry pi module that is used to control and precise the time of the raspberry, and it has some prior steps and here is a link for it

https://learn.adafruit.com/adding-a-real-time-clock-to-raspberry-pi/set-rtc-time

# Laravel Prerequisite setup
Now, you have  to go to laravel website and download laravel with its requirement, which are the last version of php and its most common libraries, also apache2, then install composer.

https://www.tal.org/tutorials/raspberrypi_php_apache

https://getcomposer.org/download/


## Installation

```
$ git clone https://github.com/Palgenius/salat.git
$ cd salat
$ composer update
$ cp .env.example .env
$ php artisan key:generate
```



