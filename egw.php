<?php

/**
 * Description of egw
 *
 * @author KABA N'faly
 */
class egw
{

    /**
     * Create a new application folder into egroupware
     */
    public static function createApplication($application_name, $install_dir='.')
    {

        if (!is_dir($install_dir))
        {
            throw new Exception("Directory '$install_dir' doesn't exist");
        }

        $application_folder = "$install_dir/$application_name";

        $no_error = true;

        if (!is_dir($application_folder))
        {

            if (mkdir($application_folder, 0755, TRUE))
            {

                printf("\nDir:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath($application_folder));

                if (self::createIndex($application_name, $application_folder))
                {

                    printf("\nFile:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath($application_folder) . '/index.php');
                } else
                {

                    $no_error = false;

                    printf("\nFile:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath($application_folder) . '/index.php');
                }
            }

            if (mkdir("$application_folder/inc", 0755, TRUE))
            {

                if (self::createDefaultClass($application_name, $application_folder))
                {

                    printf("\nFile:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath($application_folder) . "/inc/class.ui_$application_name" . ".inc.php");
                } else
                {
                    $no_error = false;

                    printf("\nFile:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath($application_folder) . "/inc/class.ui_$application_name" . ".inc.php");
                }
                if (self::createHook($application_name, $application_folder))
                {
                    printf("\nFile:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath($application_folder) . '/inc/inc/hook_sidebox_menu.inc.php');
                } else
                {
                    $no_error = false;

                    printf("\nFile:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath($application_folder) . '/inc/inc/hook_sidebox_menu.inc.php');
                }
            } else
            {
                printf("\nDir:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath($application_folder) . '/inc');

                $no_error = false;
            }
            if (mkdir("$application_folder/setup", 0755, TRUE))
            {
                printf("\nDir:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath("$application_folder/setup"));

                if (self::createSetup($application_name, $application_folder))
                {
                    printf("\nFile:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath($application_folder) . '/setup/setup.inc.php');
                } else
                {
                    printf("\nFile:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath($application_folder) . '/setup/setup.inc.php');
                    $no_error = false;
                }
            } else
            {
                printf("\nDir:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath("$application_folder/templates/setup"));
                $no_error = false;
            }
            if (mkdir("$application_folder/lang", 0755, TRUE))
            {
                printf("\nDir:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath("$application_folder/lang"));
            } else
            {
                printf("\nDir:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath("$application_folder/lang"));
                $no_error = false;
            }
            if (mkdir("$application_folder/templates/default", 0755, TRUE))
            {
                printf("\nDir:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath("$application_folder/templates/default"));
            } else
            {
                printf("\nDir:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath("$application_folder/templates/default"));
                $no_error = false;
            }
            if (mkdir("$application_folder/templates/default/images", 0755, TRUE))
            {

                printf("\nDir:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath("$application_folder/templates/default/images"));
            } else
            {

                printf("\nDir:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath("$application_folder/templates/default/images"));
                $no_error = false;
            }


            if ($no_error)
            {

                printf("\033[37;01;42m The application '$application_name' has been successfully created !!! \n           \033[00m\033[37;42mapplication path: %s        \033[0m \n\n", realpath($application_folder));
            } else
            {
                printf("\033[37;01;41m                     An Error Has Occured                 \n           \033[00m\033[37;41mThe application has not been completely created \033[0m \n\n", realpath($application_folder));
            }
        } else
        {

            printf("\033[37;01;41m                     An Error Has Occured                 \n           \033[00m\033[37;41mThe folder '%s' already exists             \033[0m \n\n", realpath($application_folder));
        }
        exit;
    }

    /**
     * Create a default class for the new application
     * @param string $application_name
     * @return boolean
     */
    public static function createDefaultClass($application_name, $application_path='.')
    {

        if (file_exists(realpath(__DIR__) . '/files/class.inc.php'))
        {

            $file_content = file_get_contents(realpath(__DIR__) . '/files/class.inc.php');
            $file_content = str_replace('TO_CHANGE', $application_name, $file_content);

            $f = fopen(realpath(__DIR__) . "/$application_path/inc/class.ui_$application_name" . ".inc.php", 'w+');

            fwrite($f, $file_content);
            fclose($f);

            return true;
        } else
        {
            return false;
        }
    }

    /**
     * Create the setup file for the new application
     * @param string $application_name
     * @return boolean
     */
    public static function createSetup($application_name, $application_path='.')
    {
        if (file_exists(realpath(__DIR__) . '/files/setup.inc.php'))
        {

            $file_content = file_get_contents(realpath(__DIR__) . '/files/setup.inc.php');
            $file_content = str_replace('TO_CHANGE', $application_name, $file_content);

            $f = fopen(realpath(__DIR__) . "/$application_path/setup/setup.inc.php", 'w+');

            fwrite($f, $file_content);
            fclose($f);
            return true;
        } else
        {
            return false;
        }
    }

    /**
     * Create the hook file (use to display the side box menu) for the new application
     * @param string $application_name
     * @return boolean
     */
    public static function createHook($application_name, $application_path='.')
    {
        if (file_exists(realpath(__DIR__) . '/files/hook_sidebox_menu.inc.php'))
        {

            $file_content = file_get_contents(realpath(__DIR__) . '/files/hook_sidebox_menu.inc.php');
            $file_content = str_replace('TO_CHANGE', $application_name, $file_content);

            $f = fopen(realpath(__DIR__) . "/$application_path/inc/hook_sidebox_menu.inc.php", 'w+');
            fwrite($f, $file_content);
            fclose($f);

            return true;
        } else
        {
            return false;
        }
    }

    /**
     * Create the index file for the new application
     * @param string $application_name
     * @return boolean
     */
    public static function createIndex($application_name, $application_pat='.')
    {

        if (file_exists(realpath(__DIR__) . '/files/index.php'))
        {

            $file_content = file_get_contents(realpath(__DIR__) . '/files/index.php');
            $file_content = str_replace('TO_CHANGE', $application_name, $file_content);

            $f = fopen(realpath(__DIR__) . "/$application_path/index.php", 'w+');
            fwrite($f, $file_content);
            fclose($f);

            return true;
        } else
        {
            return false;
        }
    }

    /**
     * Display an error message if both action and provider are spicified
     */
    public static function error()
    {

        printf("\033[37;01;41m                     An Error Has Occured                 \n           \033[00m\033[37;41mAn action and provider is required             \033[0m \n\n");
        self::help();
    }

    /**
     * Display an error message if the installation directory name is not specified
     */
    public static function noInstallDirName()
    {

        printf("\033[37;01;41m                     An Error Has Occured                 \n           \033[00m\033[37;41mAn installation directory path is required              \033[0m \n\n");
        self::help();
    }

    /**
     * Display an error message if the application name is not specified
     */
    public static function noApplicationName()
    {

        printf("\033[37;01;41m                     An Error Has Occured                 \n           \033[00m\033[37;41mAn application name is required                         \033[0m \n\n");
        self::help();
    }

    /**
     * Display help for egw usage
     */
    public static function help()
    {

        printf("\n\033[37;01mEgroupware \033[00m  Command Line Console Tool\033[00m\n");
        printf("\n\033[33mUsage:\033[00m \n \033[0;01megw \033[33m-c \033[00m<YOUR_APPLICATION_NAME> --install_dir=<PATH_TO_INSTALL_APPLICATION>\n");
        printf("The default install_dir is '.' (current directory where the command is run)\n\n");
        printf("\033[0m");
        exit;
    }

}

$options = getopt('c:h', array('install_dir:'));

if (isset($options['h']))
{
    egw::help();
}
if (isset($options['c']) && isset($options['install_dir']))
{

    if (!$options['c'])
    {
        egw::noApplicationName();
    }    

    try
    {
        egw::createApplication($options['c'], $options['install_dir']);
        
    } catch (Exception $e)
    {
        print $e->getMessage() . "\n";
        exit;
    }
}

egw::error();
