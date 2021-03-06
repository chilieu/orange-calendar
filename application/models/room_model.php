<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Room_model extends CI_Model {

	var $table;

    function __construct()
    {
        parent::__construct();

        $this->table = 'room';
    }

    function insertIfNotExists($data)
    {
    	$name = trim($data['room']);
    	if( empty($name) ) return;

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

    function delete($id)
    {
        return $this->db->delete($this->table , array('id' => $id));
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function getByRoom($name)
    {
    	$this->db->from($this->table);
    	$this->db->where('room', trim($name) );
    	return $this->db->get();
    }

    function getById($id)
    {
    	$this->db->from($this->table);
    	$this->db->where('id', $id);
    	return $this->db->get();
    }

    function getAll()
    {
        $this->db->from( $this->table );
        $this->db->order_by("order", "asc");
        return $this->db->get();
    }

    function getAllOnSite()
    {
        $this->db->from( $this->table );
        $this->db->where('onsite', 'onsite');
        $this->db->order_by("order", "asc");
        return $this->db->get();
    }

    function getAllOffSite()
    {
        $this->db->from( $this->table );
        $this->db->where('onsite', 'offsite');
        $this->db->order_by("order", "asc");
        return $this->db->get();
    }

}