<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Contact_model extends CI_Model {

	var $table;

    function __construct()
    {
        parent::__construct();

        $this->table = 'contact';
    }

    function insertIfNotExists($data)
    {
    	$name = trim($data['name']);
    	if( empty($name) ) return;

    	$q = $this->getByName($name);
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

    function getByName($name)
    {
    	$this->db->from( $this->table );
    	$this->db->where('name', $name);
    	return $query = $this->db->get();
    }

    function getById($id)
    {
    	$this->db->from($this->table);
    	$this->db->where('id', $id);
    	return $query = $this->db->get();
    }

}