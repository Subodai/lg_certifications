<?php 
/**
 * LG Test file
 */
// Pull in the wp-db.php file from wp-includes
include_once('/wp-config.php');
include_once('/wp-includes/wp-db.php');

// $dbh = new wpdb(DB_USER ,DB_PASSWORD, DB_NAME, DB_HOST);

// $result = $dbh->get_results("SELECT * FROM wp_users ORDER BY ID ASC", ARRAY_A);

// foreach($result as $row)
// {
// 	echo $row['user_login']."<br/>";
// }


Class test_class Extends wpdb {

	public function __construct(){

		parent::__construct(DB_USER ,DB_PASSWORD, DB_NAME, DB_HOST);
	}

	// Test function
	public function test(){
		
		$sql 	= "	SELECT wp_users.display_name, wp_users.ID, lg_certificates.*, lg_ranks.image 
					FROM wp_users
					JOIN lg_user_certs 			ON wp_users.ID = lg_user_certs.user_ref
					JOIN lg_certificates	 	ON lg_user_certs.cert_ref = lg_certificates.id
					LEFT JOIN lg_user_ranks 	ON wp_users.ID = lg_user_ranks.user_id
					LEFT JOIN lg_ranks 			ON lg_ranks.id = lg_user_ranks.rank_id
					ORDER BY wp_users.display_name ASC, lg_certificates.type_ref DESC";
		
		$result = $this->get_results($sql, ARRAY_A);

		foreach($result as $row){
			echo "<div>";
			echo "<p>";
			if($row['image'] != "")
			{
				echo "<img src='/rank-icons/".$row['image']."' height='16px'/>";
			}
			
			$user_id = $_COOKIE['user_id'];

			$sql = "SELECT * FROM lg_certificates
					JOIN lg_user_certs ON lg_user_certs.cert_ref = lg_certificates.id
					JOIN wp_users ON wp_users.ID = lg_user_certs.user_ref
					WHERE wp_users.ID = {$user_id}";

			echo $row['display_name']." is a ".$row['name']."</p>";
			echo "</div>";
		}
	}
}

$lg = new test_class();

$lg->test();