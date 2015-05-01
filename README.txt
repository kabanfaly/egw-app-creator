Welcome to Egroupware Console Line Tool

RELEASE INFORMATION
-------------------
Release on January 2011
Author KABA N'faly


This tool has been made to help Egroupware users to create easily Egroupware
applications. Before using this tool you'd better know how to create an
application under Egroupware and how to manage it.

Runnable only on Windows Linux and MacOS

INSTALL (Linux & MacOS):
------------
1- Put the bin folder into your Egroupware root path as follow:
    <YOUR_EGW_DIR_PATH>/bin

2- Change directory:
    cd <YOUR_EGW_DIR_PATH>/bin

3- Change your classpath as follow:
    export PATH=$PATH:<YOUR_EGW_DIR_PATH>/bin

4- Create an alias as follow:
    alias egw='egw.sh'


INSTALL (Windows):
1- Put the bin folder into your Egroupware root path as follow:
    <YOUR_EGW_DIR_PATH>\bin

2- Change directory:
    cd <YOUR_EGW_DIR_PATH>\bin

3- Change your classpath as follow:
    SET PATH=%PATH%;<YOUR_EGW_DIR_PATH>\bin;<YOUR_PHP_EXECUTABLE_DIR_PATH>


HOW DOES IT WORK?
--------------
For help, type:

- Linux & MacOS:
	    egw -h
- windows: 
	    php.exe -d safe_mode=Off -f "egw.php" -- -h

To create a new egroupware application:
- Linux & MacOS:
	    egw create application <YOUR_APPLICATION_NAME>
- Windows:
	    php.exe -d safe_mode=Off -f "egw.php" -- create application <YOUR_APPLICATION_NAME>


