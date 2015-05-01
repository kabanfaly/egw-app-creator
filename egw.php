<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of egw
 *
 * @author jflr9172
 */
class egw {

    /**
     * Create a new application folder into egroupware
     */
    public static function createApplication($application_name) {

        $application_folder = "../$application_name";

        system('chmod 755 ..');

        //system("mkdir -p $application_folder/inc $application_folder/setup $application_folder/templates/default $application_folder/templates/images");

        $no_error = true;

        if (!is_dir($application_folder)) {


            if (mkdir($application_folder, 0755, TRUE)) {

                printf("\nDir:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath($application_folder));

                if (self::createIndex($application_name)) {

                    printf("\nFile:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath($application_folder) . '/index.php');
                } else {

                    $no_error = false;

                    printf("\nFile:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath($application_folder) . '/index.php');
                }
            }

            if (mkdir("$application_folder/inc", 0755, TRUE)) {

                if (self::createDefaultClass($application_name)) {

                    printf("\nFile:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath($application_folder) . "/inc/class.ui_$application_name" . ".inc.php");
                } else {

                    $no_error = false;

                    printf("\nFile:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath($application_folder) . "/inc/class.ui_$application_name" . ".inc.php");
                }
                if (self::createHook($application_name)) {

                    printf("\nFile:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath($application_folder) . '/inc/inc/hook_sidebox_menu.inc.php');
                } else {

                    $no_error = false;

                    printf("\nFile:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath($application_folder) . '/inc/inc/hook_sidebox_menu.inc.php');
                }
            } else {

                printf("\nDir:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath($application_folder) . '/inc');

                $no_error = false;
            }
            if (mkdir("$application_folder/setup", 0755, TRUE)) {

                printf("\nDir:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath("$application_folder/setup"));

                if (self::createSetup($application_name)) {

                    printf("\nFile:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath($application_folder) . '/setup/setup.inc.php');
                } else {

                    printf("\nFile:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath($application_folder) . '/setup/setup.inc.php');

                    $no_error = false;
                }
            } else {

                printf("\nDir:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath("$application_folder/templates/setup"));

                $no_error = false;
            }
            if (mkdir("$application_folder/lang", 0755, TRUE)) {

                printf("\nDir:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath("$application_folder/lang"));
            } else {

                printf("\nDir:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath("$application_folder/lang"));

                $no_error = false;
            }
            if (mkdir("$application_folder/templates/default", 0755, TRUE)) {

                printf("\nDir:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath("$application_folder/templates/default"));
            } else {

                printf("\nDir:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath("$application_folder/templates/default"));

                $no_error = false;
            }
            if (mkdir("$application_folder/templates/default/images", 0755, TRUE)) {

                printf("\nDir:\n \033[32;01;32m%s \033[00m---------> \033[32;32mOK\n\033[00m", realpath("$application_folder/templates/default/images"));
            } else {

                printf("\nDir:\n \033[31;01;31m%s \033[00m---------> \033[31;31mKO\n\033[00m", realpath("$application_folder/templates/default/images"));

                $no_error = false;
            }


            if ($no_error) {

                printf("\033[37;01;42m The application '$application_name' has been successfully created !!! \n           \033[00m\033[37;42mapplication path: %s        \033[0m \n\n", realpath($application_folder));
            } else {
                printf("\033[37;01;41m                     An Error Has Occured                 \n           \033[00m\033[37;41mThe application has not been completely created \033[0m \n\n", realpath($application_folder));
            }
        } else {

            printf("\033[37;01;41m                     An Error Has Occured                 \n           \033[00m\033[37;41mThe folder '%s' already exists             \033[0m \n\n", realpath($application_folder));
        }
    }

    /**
     * Create a default class for the new application
     * @param string $application_name
     * @return boolean
     */
    public static function createDefaultClass($application_name) {

        if (file_exists(realpath(__DIR__) . '/files/class.inc.php')) {

            $file_content = file_get_contents(realpath(__DIR__) . '/files/class.inc.php');
            $file_content = str_replace('TO_CHANGE', $application_name, $file_content);

            $f = fopen(realpath(__DIR__) . "/../$application_name/inc/class.ui_$application_name" . ".inc.php", 'w+');

            fwrite($f, $file_content);

            fclose($f);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Create the setup file for the new application
     * @param string $application_name
     * @return boolean
     */
    public static function createSetup($application_name) {
        if (file_exists(realpath(__DIR__) . '/files/setup.inc.php')) {

            $file_content = file_get_contents(realpath(__DIR__) . '/files/setup.inc.php');
            $file_content = str_replace('TO_CHANGE', $application_name, $file_content);

            $f = fopen(realpath(__DIR__) . "/../$application_name/setup/setup.inc.php", 'w+');

            fwrite($f, $file_content);

            fclose($f);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Create the hook file (use to display the side box menu) for the new application
     * @param string $application_name
     * @return boolean
     */
    public static function createHook($application_name) {
        if (file_exists(realpath(__DIR__) . '/files/hook_sidebox_menu.inc.php')) {

            $file_content = file_get_contents(realpath(__DIR__) . '/files/hook_sidebox_menu.inc.php');
            $file_content = str_replace('TO_CHANGE', $application_name, $file_content);

            $f = fopen(realpath(__DIR__) . "/../$application_name/inc/hook_sidebox_menu.inc.php", 'w+');

            fwrite($f, $file_content);

            fclose($f);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Create the index file for the new application
     * @param string $application_name
     * @return boolean
     */
    public static function createIndex($application_name) {

        if (file_exists(realpath(__DIR__) . '/files/index.php')) {

            $file_content = file_get_contents(realpath(__DIR__) . '/files/index.php');
            $file_content = str_replace('TO_CHANGE', $application_name, $file_content);

            $f = fopen(realpath(__DIR__) . "/../$application_name/index.php", 'w+');

            fwrite($f, $file_content);

            fclose($f);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Display an error message if both action and provider are spicified
     */
    public static function error() {

        printf("\033[37;01;41m                     An Error Has Occured                 \n           \033[00m\033[37;41mAn action and provider is required             \033[0m \n\n");
        self::help();
    }

    /**
     * Display an error message if the action is not valid
     * @param string $action the unknown action
     */
    public static function unrecognizedAction($action) {

        printf("\033[37;01;41m                     An Error Has Occured                 \n           \033[00m\033[37;41mAction '%s' is not a valid action              \033[0m \n\n", $action);
        self::help();
    }

    /**
     * Display an error message if the provider is not valid
     * @param string $provider the unknown provider
     */
    public static function unrecognizedProvider($provider) {

        printf("\033[37;01;41m                     An Error Has Occured                 \n           \033[00m\033[37;41mProvider '%s' is not a valid provider              \033[0m \n\n", $provider);
        self::help();
    }

    /**
     * Display an error message if the provider is not specified
     */
    public static function noProviderError() {

        printf("\033[37;01;41m                     An Error Has Occured                 \n           \033[00m\033[37;41mA provider is required                         \033[0m \n\n");
        self::help();
    }

    /**
     * Display an error message if no provider name is given
     * @param string $provider_type type of provider
     */
    public static function noProviderNameError($provider_type) {

        if ($provider_type == 'application') {

            printf("\033[37;01;41m                     An Error Has Occured                 \n          \033[00m\033[37;41mAn application-name is required                     \033[0m \n\n");
        } elseif ($provider_type == 'class') {

            printf("\033[37;01;41m                     An Error Has Occured                       \n\033[00m\033[37;41m(A class-option), a class-name,  and An application-name are required\033[0m \n\n");
        }
        self::help();
    }

    /**
     * Display help for egw usage
     */
    public static function help() {

        printf("\n\033[37;01mEgroupware \033[00m  Command Line Console Tool\033[00m\n");

        //printf("\n\033[32mUsage:\033[00m \n\033[34m egw \033[33maction-name \033[35mprovider-name \033[00m[--provider-opts] [provider-parameters ...]\n");

        printf("\n\033[33mUsage:\033[00m \n \033[0;01megw \033[33mcreate \033[35mapplication\033[00m application-name\n\n");

        //printf("\n\033[35mClass:\033[00m \n \033[0;01megw \033[33mcreate \033[35mclass\033[00m [-bo|-ui|-so] class-name application-name\n\n");

        printf("\033[0m");
    }

}

if ($argc == 1 || $argv[1] == '-h') {

    if ($argc == 1) {

        egw::error();
    } else {

        egw::help();
    }
} elseif ($argc == 2) {

    if ($argv[1] != 'create') {

        egw::unrecognizedAction($argv[1]);
    } else {
        egw::noProviderError();
    }
} elseif ($argc == 3) {

    if ($argv[1] != 'create') {

        egw::unrecognizedAction($argv[1]);
    } elseif ($argv[2] != 'application') {

        egw::unrecognizedProvider($argv[2]);
    } else {
        egw::noProviderNameError($argv[2]);
    }
} elseif ($argc == 4) {

    if ($argv[1] != 'create') {

        egw::unrecognizedAction($argv[1]);
    } elseif ($argv[2] != 'application') {

        egw::unrecognizedProvider($argv[2]);
    } elseif ($argv[2] == 'application') {

        egw::createApplication($argv[3]);
    }
}