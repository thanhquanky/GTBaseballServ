<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('player_model');
    	echo json_encode($this->player_model->get_all());
	}

	public function get_all_from_team() 
	{
		$team_id = $this->input->post('team_id', TRUE);
		$this->load->model('team_model');
		$this->load->model('player_model');

		$all_players = $this->player_model->get_all();
		$players = array();
		foreach($all_players as $player) {
			if ($player->team_id === $team_id) {
				array_push($players,$player);
			}
		}
		echo json_encode($players);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
