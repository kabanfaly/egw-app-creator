<?php

/* * ************************************************************************\
 * eGroupWare - Knowledge Base                                              *
 * http://www.egroupware.org                                                *
 * -----------------------------------------------                          *
 *  This program is free software; you can redistribute it and/or modify it *
 *  under the terms of the GNU General Public License as published by the   *
 *  Free Software Foundation; either version 2 of the License, or (at your  *
 *  option) any later version.                                              *
  \************************************************************************* */

/* $Id: hook_sidebox_menu.inc.php 18864 2005-07-23 09:44:46Z milosch $ */ {
    $menu_title = $GLOBALS['egw_info']['apps'][$appname]['title'] . ' ' . lang('Menu');
    $file = Array(
        'home' => $GLOBALS['egw']->link('/index.php', 'menuaction=TO_CHANGE.ui_TO_CHANGE.index'),
        
    );
    /*
     * uncomment the line below to display the menu
     */
    //display_sidebox($appname,$menu_title,$file);

    if ($GLOBALS['egw_info']['user']['apps']['preferences']) {
        $menu_title = lang('Preferences');
        $file = Array(
            'Preferences' => $GLOBALS['egw']->link('/index.php', 'menuaction=TO_CHANGE.ui_TO_CHANGE.index&appname=preference'),
        );
        /*
         * uncomment the line below to display the menu
         */
        //display_sidebox($appname, $menu_title, $file);
    }

    if ($GLOBALS['egw_info']['user']['apps']['admin']) {
        $menu_title = 'Administration';
        $file = Array(
            'Configuration' => $GLOBALS['egw']->link('/index.php', 'menuaction=TO_CHANGE.ui_TO_CHANGE.index&appname=admin'),
        );
        /*
         * uncomment the line below to display the menu
         */
        //display_sidebox($appname, $menu_title, $file);
    }
}
?>