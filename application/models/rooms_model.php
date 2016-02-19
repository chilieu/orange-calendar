<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Rooms_model extends CI_Model {

	var $table;

    function __construct()
    {
        parent::__construct();

        $this->table = 'rooms';
    }

    function insertIfNotExists($data)
    {
    	$name = $data['room'];
    	$q = $this->getByRoom($name);
    	if( $q->num_rows() > 0 )
    	{
    		$r = $q->row_array();
    		return $r['id'];
    	} else {
    		return $this->insert($data);
    	}
    }

    function insert($data)
    {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
    }

    function getByRoom($name)
    {
    	$this->db->from($this->table);
    	$this->db->where('room', $name);
    	$query = $this->db->get();
    }

    function getById($id)
    {
    	$this->db->from($this->table);
    	$this->db->where('id', $id);
    	$query = $this->db->get();
    }

}