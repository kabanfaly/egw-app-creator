<?php

class ui_TO_CHANGE {

    /**
     * Public functions callable via menuaction
     *
     * @var array
     */
    var $public_functions = array(
        'index' => True,
    );

    function __construct() {
        $GLOBALS['egw_info']['flags']['app_header'] = 'TO_CHANGE';

        $this->tmpl = & CreateObject('etemplate.etemplate', 'TO_CHANGE.index');


        $this->html = & $GLOBALS['egw']->html;
        if (!@is_object($GLOBALS['egw']->js)) {
            $GLOBALS['egw']->js = & CreateObject('phpgwapi.javascript');
        }
    }



    public function create_footer() {
        $GLOBALS['egw']->common->egw_footer();
    }

    /**
     * Display the application home content
     */
    public function index($content = NULL) {

        if (isset($_GET['appname'])) {

            if ($_GET['appname'] == 'admin') {

                echo '<center><h2>admin</h2></center>';
            } elseif (($_GET['appname'] == 'preference')) {

                echo '<center><h2>preference</h2></center>';
            }
        } else {

            echo '<center><h2>Welcome to TO_CHANGE</h2></center>';
        }
        $this->create_footer();
    }

    /**
     * Useful for the side box menu.
     * For any change on this function's name, you should alter the link into inc/hook_side_box_menu.inc.php file
     */
    public function preference() {

        $this->create_header();



        $this->create_footer();
    }

    /**
     * Useful for the side box menu.
     * For any change on this function's name, you should alter the link into inc/hook_side_box_menu.inc.php file
     */
    public function admin() {

        $this->create_header();



        $this->create_footer();
    }

}

?>