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
        return $this->db->update($this->table, array('approval' => 'approved') );
    }

    function deny($id)
    {
        if( !$id ) return;
        $this->db->where('id', $id);
        return $this->db->update($this->table, array('approval' => 'rejected') );
    }

    function checkAvailable($room_id, $start, $end)
    {
        if( empty( $room_id ) || empty( $start ) || empty( $end )) return false;

        //first check if start time is in between any current event
        $this->db->from($this->table);
        $this->db->where("room_id", $room_id);
        $this->db->where("date_from <=", $start);
        $this->db->where("date_to >=", $start);
        $q1 = $this->db->get();
        $array['start'] = $q1->result();

        //second check if end time is in between any current event
        $this->db->from($this->table);
        $this->db->where("room_id", $room_id);
        $this->db->where("date_from <=", $end);
        $this->db->where("date_to >=", $end);
        $q2 = $this->db->get();
        $array['end'] = $q2->result();

        //third check if current event between start and end time
        $this->db->from($this->table);
        $this->db->where("room_id", $room_id);
        $this->db->where("( date_from BETWEEN '{$start}' AND '{$end}' OR date_to BETWEEN '{$start}' AND '{$end}' )");
        $q3 = $this->db->get();
        $array['current_between'] = $q3->result();
        return $array;

    }

}