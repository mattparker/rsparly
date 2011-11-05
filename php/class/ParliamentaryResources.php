<?php
// Pass a comma-separated list of search words to as GET param q=monkey,butler


require_once 'db.inc.php';



class ParliamentaryResources {


	/**
	 * Database connection
	 */
	protected $_conn;

	/**
	 * Paramaters to search for, once they've been escaped etc.
	 * @var array
	 */
	protected $_params;

	/**
	 * Paging for the query 
	 */
	protected $_offset = 0;
	protected $_limit = 20;

	/**
	 * Constructor
	 * @param String	Comma-separated list of search terms you'll want to search for
	 *
	 */
	public function __construct ($searchTerms) {

		$this->_setDb();
		$this->setSearchTerms($searchTerms);

	}


	/**
	 * Sets up the db connection
	 */
	protected function _setDb () {

		// TODO Globals set by require'd file
		$rs = mysql_connect(PARLY_SERVER, PARLY_USER, PARLY_PASSWORD);
		$this->_conn = mysql_select_db(PARLY_DB);

	}


	/**
	 * Cleans up the search terms 
	 * @param String
	 * @return ParliamentaryResources
	 */
	public function setSearchTerms ($searchTerms) {

		$conn = $this->_conn;
	

		if (strstr($searchTerms, ',')) {
			$dirtyParams = explode(',', $searchTerms);
		} else {
			$dirtyParams = array($searchTerms);
		}

		$cleanParams = array();
		foreach ($dirtyParams as $p) {
			$cleanParams[] = mysql_real_escape_string($p, $conn);
		}

		$this->_params = $cleanParams;

		return $this;

	}

	public function getSearchTerms () {
		return $this->_params;
	}


	/**
	 * Builds the sql statement
	 * @return String
	 */
	protected function _buildSql () {

		$params = $this->_params;

		// Build the query

		$match = '';

		if ($params && count($params) > 0) {
			$match = " MATCH (title, summary) AGAINST "
				. "(" . implode($params, ' ') . ") IN BOOLEAN MODE";
		}

		$query = "SELECT * ";
	        if ($match != '') {
			$query .= ", " . $match . " as matchscore";
		}
		$query .= " FROM parly_resources ";

		if ($match != '') {
			$query .= " WHERE " . $match;
		}

		$query .= " LIMIT " . $this->_offset . " " . $this->_limit;

		if ($match != '') {
			$query .= " ORDER BY matchscore DESC ";
		}

		return $query;

	}

	/**
	 * Searches the database
	 * @return Array | false
	 */
	public function search () {

		$sql = $this->_buildSql();
		$rs = mysql_query($sql, $this->_conn);
		$ret = array();

		if (mysql_num_rows($rs) == 0) {
			return false;
		}

		while ($row = mysql_fetch_assoc($rs)) {
			$ret[] = $row;
		}
		
		return $ret;

	}

}










