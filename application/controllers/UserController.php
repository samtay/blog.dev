<?php

/**
 * Class UserController
 *
 * Class for controlling user actions such as logging in or registering.
 * Once I learn how to use session variables, they will probably be used
 * here. NEED TO REFACTOR REDIRECTS!
 */
class UserController extends FrontController {

	public function __construct() {}

	/**
	 * Default to login page
	 */
	public function index() {
		$this->login();
	}


	/**
	 * Register a new user. First loads the register form, then that form
	 * redirects here for validation, which leads either back to the form
	 * or to model for db insertion.
	 */
	public function register() {
		// If request is not POST, get UserRegisterView
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			Factory::getView(str_replace('Controller', '', __CLASS__) . ucwords(__FUNCTION__));

		// Else call on UserModel to handle POST data
		} else {
			$data = Factory::getModel(str_replace('Controller', '', __CLASS__))->register();

			// If registration is successful, login and send to home page.
			if ($data['success']) {
				Factory::getModel(str_replace('Controller', '', __CLASS__))->login();
				header('location:'.BASE_URL);
			}
			// If unsuccessful, send back to form UserRegisterView with error message
			else {
				Factory::getView(str_replace('Controller', '', __CLASS__) . ucwords(__FUNCTION__), $data);
			}
		}
	}

	public function login() {
		// If request is not POST, get UserLoginView
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			Factory::getView(str_replace('Controller', '', __CLASS__) . ucwords(__FUNCTION__));

		// Else call on UserModel to handle POST data
		} else {
			$data = Factory::getModel(str_replace('Controller', '', __CLASS__))->login();

			// Load the page the user was visiting before login!
			if ($data['success']) {
				header('location:'.$_SERVER['HTTP_REFERER']);
			} else {
				Factory::getView(str_replace('Controller', '', __CLASS__) . ucwords(__FUNCTION__), $data);
			}
		}
	}

	public function logout() {
		unset($_SESSION['user']);
		$_SESSION['msg'] = 'You&rsquo;ve successfully logged out.';
		header('location:'.$_SERVER['HTTP_REFERER']);
	}



}