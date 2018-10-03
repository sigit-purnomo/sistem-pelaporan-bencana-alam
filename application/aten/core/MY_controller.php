<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {


    function __construct()
    {

        parent::__construct();

        //Initialization code that affects all controllers
    }

}


class Public_Controller extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        //Initialization code that affects Public controllers. Probably not much needed because everyone can access public.
    }

}

class Admin_Controller extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        //Initialization code that affects Admin controllers I.E. redirect and die if not logged in or not an admin
    }

}

class Member_Controller extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        //Initialization code that affects Member controllers. I.E. redirect and die if not logged in
    }

}