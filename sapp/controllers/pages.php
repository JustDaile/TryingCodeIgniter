<?php

class Pages extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('store_model');
		$this->load->helper('url_helper');
	}
	
	public function filter($platform = 'any', $genre = NULL){
		if(!file_exists(APPPATH . 'views/gameshop/index.php')){
			show_404();
		}
		
		$data["selected_platform_id"] = $platform;
		$data["selected_genre_id"] = $genre;
		$data["genres"] = $this->store_model->get_genres();
		$data["platforms"] = $this->store_model->get_platforms();
		
		$data["games"] = $this->store_model->get_games($platform, $genre);
		$data["products"] = $this->store_model->get_products_details($data["games"]);
			
		$this::showView($data);
	}
	
	private function showView($modelData = NULL){
		$this->load->view('gameshop/header');
		$this->load->view('gameshop/index', $modelData);
		$this->load->view('gameshop/footer');
	}
	
}
