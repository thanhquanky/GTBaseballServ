<?php
class Player_model extends CI_Model {

    private $number   = '';
    private $name = '';
    private $school_id = '';
    private $position = '';
    private $award = '';
    private $story = '';
    private $dob = '';

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
    }

    function get_all()
    {
        $query = $this->db->get('players');
        return $query->result();
    }

    function get_last_ten_entries()
    {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

    function login()
    {
        //$query
    }

    function generate_token() {
        return md5(time() * rand() * rand() * microtime() + 'AWEQX#EQEqc3cqc1E212X');
    }

    function insert()
    {
        $this->token = generate_token();
        $this->db->insert('users',
                          array(
                            'email' => $this->email,
                            'password' => md5($this->password),
                            'name' => $this->name,
                            'token' => generate_token()
                          )
                         );

    }
}
