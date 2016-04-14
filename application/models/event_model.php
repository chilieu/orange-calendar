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

    function getByLeaderId($leader_id)
    {
        $this->db->from($this->table);
        $this->db->where('leader_id', $leader_id);
        $this->db->order_by("creation_date", "desc");
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
        $this->db->join('room', 'room.id = event.room_id');
        $this->db->join('contact', 'contact.id = event.contact_id');
        $this->db->where('approval', 1);
        $this->db->order_by("date", "asc");
        return $this->db->get();
    }

    function getAllUnApproval()
    {
        $this->db->from( $this->table );
        $this->db->join('room', 'room.id = event.room_id');
        $this->db->join('contact', 'contact.id = event.contact_id');
        $this->db->where('approval', 0);
        $this->db->order_by("date", "asc");
        return $this->db->get();
    }

    function get()
    {
        $this->db->from( $this->table );
        $this->db->join('room', 'room.id = event.room_id');
        $this->db->join('contact', 'contact.id = event.contact_id');
        $this->db->order_by("date", "asc");
        return $this->db->get();
    }

    function approve($id)
    {
        if( !$id ) return;
        $this->db->where('id', $id);
        return $this->db->update($this->table, array('approval' => 1) );
    }

    function deny($id)
    {
        if( !$id ) return;
        $this->db->where('id', $id);
        return $this->db->update($this->table, array('approval' => 0) );
    }

}