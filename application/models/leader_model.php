<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Leader_model extends CI_Model {

    var $table;

    function __construct()
    {
        parent::__construct();

        $this->table = 'leader';
    }

    function getByEmail($email)
    {
        if( !$email ) return;
        $this->db->from( $this->table );
        $this->db->where('email', $email);
        return $this->db->get();
    }

    function getAll()
    {
        $this->db->from( $this->table );
        $this->db->order_by("id", "desc");
        return $this->db->get();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $re = $this->db->update($this->table, $data);
        return $id;
    }

    function getById($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get();
    }

    function delete($id)
    {
        if( !$id ) return;
        return $this->db->delete($this->table, array('id' => $id));
    }

    function softDelete($id)
    {
        if( !$id ) return;
        $this->db->where('id', $id);
        return $this->db->update($this->table, array('deleted' => 1) );
    }

    function unSoftDelete($id)
    {
        if( !$id ) return;
        $this->db->where('id', $id);
        return $this->db->update($this->table, array('deleted' => 0) );
    }


}