<?php
class Vote_model extends CI_Model {

    private $vote_id   = '';
    private $game_id = '';
    private $player_id = '';
    private $user_id = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function initialize($game_id, $player_id, $user_id)
    {
        $this->game_id = $game_id;
        $this->player_id = $player_id;
        $this->user_id = $user_id;
    }

    function get_all()
    {
        $query = $this->db->get('players');
        return $query->result();
    }

    function get_all_by_game($game_id) {
        $query = $this->db->get_where('players', array('game_id' => $game_id));
        return $query->result();
    }

    function insert()
    {
        $this->db->insert('votes',
                          array(
                            'game_id' => $this->game_id,
                            'player_id' => $this->player_id,
                            'user_id' => $this->user_id
                          )
                         );

    }
}
