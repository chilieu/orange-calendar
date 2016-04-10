<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');


class Area_model extends CI_Model {

    var $table;

    function __construct()
    {
        parent::__construct();

        $this->table = 'area';
    }

    function getAll()
    {
        $this->db->from( $this->table );
        $this->db->order_by("title", "asc");
        return $this->db->get();
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

    function getByArea($area)
    {
        $this->db->from($this->table);
        $this->db->where('area', trim($area) );
        return $this->db->get();
    }

    function getById($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get();
    }

}