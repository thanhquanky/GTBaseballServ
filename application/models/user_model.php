<?php
class User_model extends CI_Model {

    private $email   = '';
    private $password = '';
    private $name = '';
    private $token = '';
    private $hashed_password = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function initialize($email, $password, $name)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->hashed_password = md5($this->password);
    }


    function login()
    {
        //$query
    }

    function get_by_email($email)
    {
      $query = $this->db->get_where('users', array('email' => $email));
      return $query->row();
    }

    function generate_token() {
        $entropy = time() * rand() * rand() * microtime();
        $salt = 'ADADADQW$Edaq30ci-0q3icrqe';
        $token = md5($salt.$entropy);
        return $token;
    }

    function insert()
    {
        $this->token = $this::generate_token();

        $user_data = array(
                            'email' => $this->email,
                            'password' => $this->hashed_password,
                            'name' => $this->name,
                            'token' => $this->token
                          );

        $this->db->insert('users',$user_data);
        return $this->db->insert_id();

    }
}
