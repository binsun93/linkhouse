<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
    public  $table_name="";
    /**
     *
     * @var CI_DB_mysql_driver 
     */
    public $db_master=null;
    /**
     *
     * @var CI_DB_mysql_driver 
     */
    public $db_slave=null;
    function __construct() {
        parent::__construct();
        $this->db_master = $this->load->database('master', TRUE);
        $this->db_slave = $this->load->database('slave', TRUE);
        
    }

    ///////////////   ***** FUNCTIONS USE DB SLAVE *****   ///////////////
//
//    /**
//     * Select
//     *
//     * Generates the SELECT portion of the query
//     *
//     * @param	string
//     * @return	object
//     */
//    public function select($select = '*', $escape = NULL) {
//        $this->db = $this->db_slave;
//        return $this->db->select($select, $escape);
//    }
//
//    /**
//     * Select Max
//     *
//     * Generates a SELECT MAX(field) portion of a query
//     *
//     * @param	string	the field
//     * @param	string	an alias
//     * @return	object
//     */
//    public function select_max($select = '', $alias = '') {
//        $this->db = $this->db_slave;
//        return $this->db->select_max($select, $alias);
//    }
//
//    /**
//     * Select Min
//     *
//     * Generates a SELECT MIN(field) portion of a query
//     *
//     * @param	string	the field
//     * @param	string	an alias
//     * @return	object
//     */
//    public function select_min($select = '', $alias = '') {
//        $this->db = $this->db_slave;
//        return $this->db->select_min($select, $alias);
//    }
//
//    /**
//     * Select Average
//     *
//     * Generates a SELECT AVG(field) portion of a query
//     *
//     * @param	string	the field
//     * @param	string	an alias
//     * @return	object
//     */
//    public function select_avg($select = '', $alias = '') {
//        $this->db = $this->db_slave;
//        return $this->db->select_avg($select, $alias);
//    }
//
//    /**
//     * Select Sum
//     *
//     * Generates a SELECT SUM(field) portion of a query
//     *
//     * @param	string	the field
//     * @param	string	an alias
//     * @return	object
//     */
//    public function select_sum($select = '', $alias = '') {
//        $this->db = $this->db_slave;
//        return $this->db->select_sum($select, $alias);
//    }
//
//    /**
//     * DISTINCT
//     *
//     * Sets a flag which tells the query string compiler to add DISTINCT
//     *
//     * @param	bool
//     * @return	object
//     */
//    public function distinct($val = TRUE) {
//        $this->db = $this->db_slave;
//        return $this->db->distinct($val);
//    }
//
//    /**
//     * Get
//     *
//     * Compiles the select statement based on the other functions called
//     * and runs the query
//     *
//     * @param	string	the table
//     * @param	string	the limit clause
//     * @param	string	the offset clause
//     * @return	object
//     */
//    function get($table = '', $limit = null, $offset = null) {
//        if (!isset($this->db->ar_select) || $this->db->ar_select == null) {
//            $this->db = $this->db_slave;
//        }
//        return $this->db->get($table, $limit, $offset);
//    }
//
//    /**
//     * Get_Where
//     *
//     * Allows the where clause, limit and offset to be added directly
//     *
//     * @param	string	the where clause
//     * @param	string	the limit clause
//     * @param	string	the offset clause
//     * @return	object
//     */
//    public function get_where($table = '', $where = null, $limit = null, $offset = null) {
//        if (!isset($this->db->ar_select) || $this->db->ar_select == null) {
//            $this->db = $this->db_slave;
//        }
//        return $this->db->get_where($table, $where, $limit, $offset);
//    }
//
//    /**
//     * "Count All Results" query
//     *
//     * Generates a platform-specific query string that counts all records
//     * returned by an Active Record query.
//     *
//     * @param	string
//     * @return	string
//     */
//    public function count_all_results($table = '') {
//        if (!isset($this->db->ar_select) || $this->db->ar_select == null) {
//            $this->db = $this->db_slave;
//        }
//        return $this->db->count_all_results($table);
//    }
//
//    /**
//     * "Count All" query
//     *
//     * Generates a platform-specific query string that counts all records in
//     * the specified database
//     *
//     * @access	public
//     * @param	string
//     * @return	string
//     */
//    function count_all($table = '') {
//        if (!isset($this->db->ar_select) || $this->db->ar_select == null) {
//            $this->db = $this->db_slave;
//        }
//        return $this->db->count_all($table);
//    }
//
//    /**
//     * Execute the query
//     *
//     * Accepts an SQL string as input and returns a result object upon
//     * successful execution of a "read" type query.  Returns boolean TRUE
//     * upon successful execution of a "write" type query. Returns boolean
//     * FALSE upon failure, and if the $db_debug variable is set to TRUE
//     * will raise an error.
//     *
//     * @access	public
//     * @param	string	An SQL query string
//     * @param	array	An array of binding data
//     * @return	mixed
//     */
//    function query($sql, $binds = FALSE, $return_object = TRUE) {
//        if (strtolower(substr(trim($sql), 0, 6)) == "select") {
//            $this->db = $this->db_slave;
//        }
//        return $this->db->query($sql, $binds, $return_object);
//    }
//
//    ///////////////   ***** FUNCTIONS USE DB MASTER *****  ///////////////
//
//    /**
//     * Insert
//     *
//     * Compiles an insert string and runs the query
//     *
//     * @param	string	the table to insert data into
//     * @param	array	an associative array of insert values
//     * @return	object
//     */
//    function insert($table = '', $set = NULL) {
//        $this->db = $this->db_master;
//        return $this->db->insert($table, $set);
//    }
//
//    /**
//     * Insert_Batch
//     *
//     * Compiles batch insert strings and runs the queries
//     *
//     * @param	string	the table to retrieve the results from
//     * @param	array	an associative array of insert values
//     * @return	object
//     */
//    public function insert_batch($table = '', $set = NULL) {
//        $this->db = $this->db_master;
//        return $this->db->insert_batch($table, $set);
//    }
//
//    /**
//     * The "set" function.  Allows key/value pairs to be set for inserting or updating
//     *
//     * @param	mixed
//     * @param	string
//     * @param	boolean
//     * @return	object
//     */
//    public function set($key, $value = '', $escape = TRUE) {
//        $this->db = $this->db_master;
//        return $this->db->set($key, $value, $escape);
//    }
//
//    /**
//     * Update
//     *
//     * Compiles an update string and runs the query
//     *
//     * @param	string	the table to retrieve the results from
//     * @param	array	an associative array of update values
//     * @param	mixed	the where clause
//     * @return	object
//     */
//    public function update($table = '', $set = NULL, $where = NULL, $limit = NULL) {
//        $this->db = $this->db_master;
//        return $this->db->update($table, $set, $where, $limit);
//    }
//
//    /**
//     * Update_Batch
//     *
//     * Compiles an update string and runs the query
//     *
//     * @param	string	the table to retrieve the results from
//     * @param	array	an associative array of update values
//     * @param	string	the where key
//     * @return	object
//     */
//    public function update_batch($table = '', $set = NULL, $index = NULL) {
//        $this->db = $this->db_master;
//        return $this->db->update_batch($table, $set, $index);
//    }
//
//    /**
//     * Where (use for update function (before update function))
//     *
//     * Generates the WHERE portion of the query. Separates
//     * multiple calls with AND
//     *
//     * @param	mixed
//     * @param	mixed
//     * @return	object
//     */
//    public function where($key, $value = NULL, $escape = TRUE) {
//        $this->db = $this->db_master;
//        return $this->db->where($key, $value, $escape);
//    }
//
//    /**
//     * Delete
//     *
//     * Compiles a delete string and runs the query
//     *
//     * @param	mixed	the table(s) to delete from. String or array
//     * @param	mixed	the where clause
//     * @param	mixed	the limit clause
//     * @param	boolean
//     * @return	object
//     */
//    public function delete($table = '', $where = '', $limit = NULL, $reset_data = TRUE) {
//        $this->db = $this->db_master;
//        return $this->db->delete($table, $where, $limit, $reset_data);
//    }
//
//    /**
//     * Empty Table
//     *
//     * Compiles a delete string and runs "DELETE FROM table"
//     *
//     * @param	string	the table to empty
//     * @return	object
//     */
//    public function empty_table($table = '') {
//        $this->db = $this->db_master;
//        return $this->db->empty_table($table);
//    }
//
//    /**
//     * Truncate
//     *
//     * Compiles a truncate string and runs the query
//     * If the database does not support the truncate() command
//     * This function maps to "DELETE FROM table"
//     *
//     * @param	string	the table to truncate
//     * @return	object
//     */
//    public function truncate($table = '') {
//        $this->db = $this->db_master;
//        return $this->db->truncate($table);
//    }
    function select($select = '*', $escape = NULL){
        return $this->getDB()->select($select, $escape);
    }
    public $_from="";
    function from($from){
        $this->_from=$from;
        return $this->getDB()->from($from);
    }
    function join($table, $cond, $type = ''){
        return $this->getDB()->join($table, $cond, $type);
    }
    function limit($value, $offset = ''){
        return $this->getDB()->limit($value, $offset);
    }
    public function like($field, $match = '', $side = 'both')
	{
		return $this->getDB()->like($field, $match, $side);
	}
        function where($key, $value = NULL, $escape = TRUE){
        return $this->getDB()->where($key, $value, $escape);
    }
    function where_in($key = NULL, $values = NULL){
        return $this->getDB()->where_in($key, $values);
    }
    
    
    public function or_where_not_in($key = NULL, $values = NULL)
	{
		return $this->getDB()->or_where_not_in($key, $values);
	}
    function order_by($orderby, $direction = ''){
        return $this->getDB()->order_by($orderby, $direction );
    }
    public function having($key, $value = '', $escape = TRUE)
	{
		return $this->getDB()->having($key, $value , $escape);
	}
        function group_by($by){
            $this->getDB()->group_by($by);
        }
    function get(){
        if(!$this->getDB()->ar_from){
            $this->getDB()->from($this->table_name);
        }
        return $this->getDB()->get();
    }
    
    

}