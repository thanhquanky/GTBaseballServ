<?php
class Game_model extends CI_Model {

    private $game_id   = '';
    private $hometeam_id = '';
    private $awayteam_id = '';
    private $date = '';
    private $score = '';
    private $location = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all()
    {
        $this->db->order_by('date', 'asc');
        $query = $this->db->get('games');
        return $query->result();
    }

    function get_latest()
    {
        $query = $this->db->query('
            select *
            from games
            where date < now()
            order by abs(now() - date) desc
            limit 1'
        );
        return $query->row();
    }

    function get_next()
    {
        $query = $this->db->query('
            select *
            from games
            where date >= now()
            order by abs(now() - date) desc
            limit 1'
        );
        return $query->row();
    }

    function get_future()
    {
        $query = $this->db->query('
            select *
            from games
            where date > now()
            order by abs(now() - date) desc'
        );
        return $query->result();
    }
    function insert()
    {
        $this->db->insert('games',
                          array(
                            'hometeam_id' => $this->hometeam_id,
                            'awayteam_id' => $this->awayteam_id,
                            'date'        => $this->date,
                            'score'       => $this->score,
                            'location'    => $this->location
                          )
                         );

    }
}
