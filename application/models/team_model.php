<?php
class Team_model extends CI_Model {

    private $team_id   = '';
    private $name = '';
    private $school = '';
    private $coach = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function initialize($game_id, $player_id, $user_id)
    {
    }

    function get_all()
    {
        $query = $this->db->get('teams');
        return $query->result();
    }

    function get_by_id($team_id) {
        $query = $this->db->get_where('teams', array('team_id' => $team_id));
        return $query->row();
    }

    function insert()
    {
        $this->db->insert('teams',
                          array(
                            'name' => $this->name,
                            'school' => $this->school,
                            'coach' => $this->coach
                          )
                         );

    }
}
