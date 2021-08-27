<?php

class LoginController extends WP_REST_Controller {

	private string $resource_name;
	private string $rest_namespace;

	public function __construct() {
		$this->rest_namespace = 'teama/v1';
		$this->resource_name = 'login';
	}

	public function register_routes() {
		register_rest_route($this->rest_namespace,
		'/'.$this->resource_name,
			[
				'methods' => 'POST',
				'callback' => [$this, 'login'],
				'permission_callback' => [$this, 'has_permission']
			]
		);
	}

	public function has_permission():bool {
		return true;
	}

	public function __toString() {
		// TODO: Implement __toString() method.
		return $this->namespace.get_class($this);
	}

	public function login(WP_REST_Request $request){
		//TODO get login and password and make the login
		$o = $request;
		$o = $request->get_body_params();
		wp_signon($o);
	}
}