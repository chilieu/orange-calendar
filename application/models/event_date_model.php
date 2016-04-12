<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Event_date_model extends CI_Model {

    var $table;

    function __construct()
    {
        parent::__construct();

        $this->table = 'event_date';
    }


    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
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