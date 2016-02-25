<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Event_model extends CI_Model {

	var $table;

    function __construct()
    {
        parent::__construct();

        $this->table = 'event';
    }


    function insert($data)
    {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
    }

    function getByEvent($name)
    {
    	$name = trim($name);
    	if( empty($name) ) return;

    	$this->db->from($this->table);
    	$this->db->where('event', $name);
    	$query = $this->db->get();
    }

    function getById($id)
    {
    	$this->db->from($this->table);
    	$this->db->where('id', $id);
    	$query = $this->db->get();
    }

    function getAll()
    {
        $this->db->from( $this->table );
        $this->db->join('room', 'room.id = event.room_id');
        $this->db->join('contact', 'contact.id = event.contact_id');
        $this->db->order_by("date", "asc");
        return $this->db->get();
    }

}