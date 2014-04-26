<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Auth extends CI_Controller {

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

  /**
  * Function to handle log in process
  * Take email and password user type in, see if they match email and password of an "user" object in database.
  *@access public
  */

  public function login()
  {
    //Take the email, password string input by user and store it in the corresponding variable
    $email = $this->input->post('email', TRUE);
    $password = $this->input->post('password', TRUE);
    //Change the password of string into hash value
    $password = md5($password);
    // Load user model 
    $this->load->model('user_model');
    $matched_user = $this->user_model->get_by_email($email);
    var_dump($matched_user);
    $response = array('status' => '', 'data' => '', 'message' => '');

    if (!isset($matched_user))
    {
      $response['status'] = 'failed';
      $response['message'] = 'Email does not exist';
    }
    else if ($password != $matched_user->password)
    {
      $response['status'] = 'failed';
      $response['message'] = 'Invalid password';
    }
    else
    {
      $response['status'] = 'success';
      $response['message'] = 'Success';
      $response['data'] = array(
        'id'       => $matched_user->user_id,
        'email'    => $matched_user->email,
        'token'    => $matched_user->token,
      );
    }

    return json_encode($response);

  }
   /**
  * Function to handle registering process
  * Take a name, an email and a password that user type in, store in an "user" object in database.
  *@access public
  */
  public function register() {
    $email = $this->input->post('email', TRUE);
    $password = $this->input->post('password', TRUE);
    $name = $this->input->post('name', TRUE);

    $this->load->model('user_model');
    $this->user_model->initialize($email, $password, $name);
    $this->user_model->insert();

    $user_info = $this->user_model->get_by_email($email);
    return $email;
  }

  public function index() {
    echo "Auth";

  }
}
