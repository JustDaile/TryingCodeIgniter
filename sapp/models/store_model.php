<?php

class Store_model extends CI_Model{
	
	private $genres;
	private $platforms;
	
	public function __construct(){
		$this->load->database();
		// eager loading here
		$this->genres = $this->db->get('genre')->result_array();
		$this->platforms = $this->db->get('platform')->result_array();
	}
	
	// eager loaded properties
	public function get_genres($id = NULL){
        if($id === NULL){
			return $this->genres;
		}
		// return genre-name for id
		foreach($this->genres as $genre){
			if($genre['id'] === $id){
				return $genre['name'];
			}
		}
		return ''; // no genre
	}
	
	public function get_platforms(){
        return $this->platforms;
	}
	
	private function get_game_genres($game){
		$collection = array();
		foreach($this->get_genres() as $genre){
			foreach(explode(',', $game['genre-ids']) as $id){ // genre id's in game as id
				if($genre['id'] === $id){
					$collection[] = $genre['name'];
				}
			}
		}
		return $collection;
	}
	
	// Lazy loading
	public function get_games($platform = 'any', $genre = NULL){
		$games = array();
		$collected_games = array();
		if($platform !== 'any'){
			$games = $this->db->get_where('game', array("platform-id" => $platform))->result_array();
		}else{
			$games = $this->db->get('game')->result_array();
		}
		// Now we either have a list of games on the selected platform or an empty list
		// in the case that no games exist on that platform or no platform was selected
		
		// check if we have games
		// if we have already loaded all possible games from
		// a platform and have none, then skip
		// else we want to insert the genre into the games
		if(!empty($games)){
			foreach($games as $game){
				$genres = $this->get_game_genres($game);
				// if the name of the given genre id is found in genres of the games
				if($genre !== NULL){
					if(in_array($this->get_genres($genre), $genres)){
						$collected_games[] = array_merge($game, array("genres" => $genres));
					}
				}else{
					$collected_games[] = array_merge($game, array("genres" => $genres));
				}
			}
		}

		
		return $collected_games;
	}
	
	public function get_products_details($games){
		$product = array();
		foreach($games as $game){
			$product[$game["product-id"]] = $this->db->get_where("product", array("id" => $game["product-id"]))->row_array();
		}
		return $product;
	}
	
}
