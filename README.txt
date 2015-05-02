Welcome to Egroupware Console Line Tool

RELEASE INFORMATION
-------------------
Release on January 2011
Author KABA N'faly


This tool has been made to help Egroupware users to create easily Egroupware
applications. Before using this tool you'd better know how to create an
application under Egroupware and how to manage it.

Runnable only on Windows Linux and MacOS


HOW DOES IT WORK?
--------------
Go first to the EgwAppCreator folder.

For help, type:

- Linux & MacOS:
	    egw -h
- windows: 
	    php.exe -d safe_mode=Off -f "egw.php" -- -h

To create a new egroupware application run command below:

- Linux & MacOS:
	    egw -c <YOUR_APPLICATION_NAME> --install_dir=<PATH_TO_INSTALL_APPLICATION>
- Windows:
	    php.exe -d safe_mode=Off -f "egw.php" -- -c <YOUR_APPLICATION_NAME> --install_dir=<PATH_TO_INSTALL_APPLICATION>



