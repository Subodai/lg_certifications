<?php
// Pull in the wp-db.php file from wp-includes
include_once('/wp-config.php');
include_once('/wp-includes/wp-db.php');
/* 
	===========================================================================
	Author	:	Mark Thompson
	Desc	:	Wordpress based class to enable the creation of certificates, 
				ranks, mission, training and rewards for LG Members
	Date	: 	2014-07-03
	===========================================================================
	Updated :	2014-07-03 - File created
				2014-07-03 - Added skeleton methods for planning purposes
				2014-07-09 - Pulling into wordpress for testing

 */

Class LG_Mission Extends wpdb {

	public $user_id;

	/* Constructor */
	public function __construct(){
		parent::__construct(DB_USER ,DB_PASSWORD, DB_NAME, DB_HOST);
	}

	/* Initialiser etc */
	public function init(){

		/* Get the user_id from wordpress please */
		$this->user_id = get_current_user_id();
	}

	/* Output the mission list */
	public function mission_list()
	{
		$sql = "SELECT * FROM lg_missions WHERE `date` < NOW() ORDER BY name ASC";
		$result = $this->get_results($sql, ARRAY_A);

		$html = "<h1>Previous Missions</h1>\n";

		foreach($result as $row){

			$html .= "<p><a href='/edit-mission?mission_id={$row['id']}'>{$row['name']}</a></p>\n";
		}

		return $html;
	}


	/* Create Mission Form */
	public function create_mission_form()
	{
		/* The form that will be output for a mission creation */
		$html  = "<form method=\"POST\" action=\"/lg/clone_mission/\">";
		$html .= "<h1>Copy existing mission</h1>\n";

		$sql = "SELECT * FROM lg_missions WHERE `date` < NOW() ORDER BY name ASC";
		$result = $this->get_results($sql, ARRAY_A);

		$html .= "<select name='previous_mission'>\n";

		foreach($result as $row){

			$html .= "<option value='{$row['id']}'>{$row['name']}</option>\n";
		}

		$html .= "</select>\n";
		$html .= "</form>\n";

		$html .= "<form method=\"POST\" action=\"/lg/create_mission/\">";
		$html .= "<p>DISCLAIMER: This form does not do anything yet, please don't try to make a mission yet</p>\n";
		
		$html .= "<h1>Create your mission by filling out the details below</h1>\n";
		$html .= "<label>Mission Name: <input type='text' name='name' value=''/><label>\n";
		$html .= "<label>Mission Date: <input type='text' name='date' value=''/><label>\n";
		
		$html .= "<label>Mission Description: <textarea name='description' rows='10'></textarea><label>\n";
		$html .= "<hr/>\n";

		$html .= "<h3>Gamemaster Requirements</h3>\n";
		$html .= "<label>Game Master: <input type='text' name='gm'/></label>\n";
		$html .= "<label>Game Master Assistants: <input type='text' name='gm'/></label>\n";
		$html .= "<label>Game Master Levies: <input type='text' name='gm'/></label>\n";
		$html .= "<hr/>\n";

		$html .= "<h3>Blufor Requirements</h3>\n";
		$html .= "<p>For each field below, you are entering the number of these you require for blufor</p>\n";

		$html .= "<label>Rifleman: <input type='text' name='blufor_rifleman'/></label>\n";
		$html .= "<label>Machine Gunners: <input type='text' name='blufor_mg'/></label>\n";
		$html .= "<label>Medic: <input type='text' name='blufor_medic'/></label>\n";
		$html .= "<label>AT/AA: <input type='text' name='blufor_at'/></label>\n";
		$html .= "<label>Marksman: <input type='text' name='blufor_marksman'/></label>\n";
		$html .= "<label>FAC Operator: <input type='text' name='blufor_fac'/></label>\n";
		$html .= "<label>Squad Leader: <input type='text' name='blufor_sl'/></label>\n";
		$html .= "<label>Platoon Leader: <input type='text' name='blufor_pl'/></label>\n";
		$html .= "<label>Sniper / Spotter: <input type='text' name='blufor_sniper'/></label>\n";
		$html .= "<label>Mortar Support: <input type='text' name='blufor_mortar'/></label>\n";
		$html .= "<label>Demolitions: <input type='text' name='blufor_demo'/></label>\n";
		$html .= "<label>Tank Gunner: <input type='text' name='blufor_tank_gunner'/></label>\n";
		$html .= "<label>Tank Driver: <input type='text' name='blufor_tank_driver'/></label>\n";
		$html .= "<label>Tank Commander: <input type='text' name='blufor_tank_cmd'/></label>\n";
		$html .= "<label>Transport Crew: <input type='text' name='blufor_trans_crew'/></label>\n";
		$html .= "<label>Transport Pilot: <input type='text' name='blufor_trans_pilot'/></label>\n";
		$html .= "<label>Attack Chopper Crew: <input type='text' name='blufor_heli'/></label>\n";
		$html .= "<label>Fixed Wing Pilot: <input type='text' name='blufor_cas'/></label>\n";
		$html .= "<hr/>\n";

		$html .= "<h3>Opfor Requirements</h3>\n";
		$html .= "<p>For each field below, you are entering the number of these you require for opfor</p>\n";
		
		$html .= "<label>Rifleman: <input type='text' name='opfor_rifleman'/></label>\n";
		$html .= "<label>Machine Gunners: <input type='text' name='opfor_mg'/></label>\n";
		$html .= "<label>Medic: <input type='text' name='opfor_medic'/></label>\n";
		$html .= "<label>AT/AA: <input type='text' name='opfor_at'/></label>\n";
		$html .= "<label>Marksman: <input type='text' name='opfor_marksman'/></label>\n";
		$html .= "<label>FAC Operator: <input type='text' name='opfor_fac'/></label>\n";
		$html .= "<label>Squad Leader: <input type='text' name='opfor_sl'/></label>\n";
		$html .= "<label>Platoon Leader: <input type='text' name='opfor_pl'/></label>\n";
		$html .= "<label>Sniper / Spotter: <input type='text' name='opfor_sniper'/></label>\n";
		$html .= "<label>Mortar Support: <input type='text' name='opfor_mortar'/></label>\n";
		$html .= "<label>Demolitions: <input type='text' name='opfor_demo'/></label>\n";
		$html .= "<label>Tank Gunner: <input type='text' name='opfor_tank_gunner'/></label>\n";
		$html .= "<label>Tank Driver: <input type='text' name='opfor_tank_driver'/></label>\n";
		$html .= "<label>Tank Commander: <input type='text' name='opfor_tank_cmd'/></label>\n";
		$html .= "<label>Transport Crew: <input type='text' name='opfor_trans_crew'/></label>\n";
		$html .= "<label>Transport Pilot: <input type='text' name='opfor_trans_pilot'/></label>\n";
		$html .= "<label>Attack Chopper Crew: <input type='text' name='opfor_heli'/></label>\n";
		$html .= "<label>Fixed Wing Pilot: <input type='text' name='opfor_cas'/></label>\n";
		$html .= "<hr/>\n";

		$html .= "<h3>Independent Requirements</h3>\n";
		$html .= "<p>For each field below, you are entering the number of these you require for independent</p>\n";
		
		$html .= "<label>Rifleman: <input type='text' name='indi_rifleman'/></label>\n";
		$html .= "<label>Machine Gunners: <input type='text' name='indi_mg'/></label>\n";
		$html .= "<label>Medic: <input type='text' name='indi_medic'/></label>\n";
		$html .= "<label>AT/AA: <input type='text' name='indi_at'/></label>\n";
		$html .= "<label>Marksman: <input type='text' name='indi_marksman'/></label>\n";
		$html .= "<label>FAC Operator: <input type='text' name='indi_fac'/></label>\n";
		$html .= "<label>Squad Leader: <input type='text' name='indi_sl'/></label>\n";
		$html .= "<label>Platoon Leader: <input type='text' name='indi_pl'/></label>\n";
		$html .= "<label>Sniper / Spotter: <input type='text' name='indi_sniper'/></label>\n";
		$html .= "<label>Mortar Support: <input type='text' name='indi_mortar'/></label>\n";
		$html .= "<label>Demolitions: <input type='text' name='indi_demo'/></label>\n";
		$html .= "<label>Tank Gunner: <input type='text' name='indi_tank_gunner'/></label>\n";
		$html .= "<label>Tank Driver: <input type='text' name='indi_tank_driver'/></label>\n";
		$html .= "<label>Tank Commander: <input type='text' name='indi_tank_cmd'/></label>\n";
		$html .= "<label>Transport Crew: <input type='text' name='indi_trans_crew'/></label>\n";
		$html .= "<label>Transport Pilot: <input type='text' name='indi_trans_pilot'/></label>\n";
		$html .= "<label>Attack Chopper Crew: <input type='text' name='indi_heli'/></label>\n";
		$html .= "<label>Fixed Wing Pilot: <input type='text' name='indi_cas'/></label>\n";
		$html .= "<hr/>\n";
		

		$html .= "</form>";
		/* End of the form */

		return $html;
	}

	/* Create mission handler */
	public function create_mission()
	{

	}

	/* Clone mission handler */
	public function clone_mission()
	{

	}

	/* Edit mission handler */
	public function edit_mission($id)
	{
		$sql 	= "SELECT * FROM lg_missions WHERE id = {$id}";
		$result = $this->get_results($sql, ARRAY_A);
		$row 	= $result[0];
		/* temporary edit form ignore this for now */

		$html  = "<form method=\"POST\" action=\"/lg/create_mission/\">";
		$html .= "<p>DISCLAIMER: This form does not do anything yet, please don't try to make a mission yet</p>\n";
		
		$html .= "<h1>Create your mission by filling out the details below</h1>\n";
		$html .= "<label>Mission Name: <input type='text' name='name' value='{$row['name']}'/><label>\n";
		$html .= "<label>Mission Date: <input type='text' name='date' value='".date("H:i d-m-Y",strtotime($row['date']))."'/><label>\n";
		
		$html .= "<label>Mission Description: <textarea name='description' rows='10'>{$row['description']}</textarea><label>\n";
		$html .= "<hr/>\n";

		$html .= "<h3>Gamemaster Requirements</h3>\n";
		$html .= "<label>Game Master: <input type='text' name='gm'/></label>\n";
		$html .= "<label>Game Master Assistants: <input type='text' name='gm'/></label>\n";
		$html .= "<label>Game Master Levies: <input type='text' name='gm'/></label>\n";
		$html .= "<hr/>\n";

		$html .= "<h3>Blufor Requirements</h3>\n";
		$html .= "<p>For each field below, you are entering the number of these you require for blufor</p>\n";

		$html .= "<label>Rifleman: <input type='text' name='blufor_rifleman'/></label>\n";
		$html .= "<label>Machine Gunners: <input type='text' name='blufor_mg'/></label>\n";
		$html .= "<label>Medic: <input type='text' name='blufor_medic'/></label>\n";
		$html .= "<label>AT/AA: <input type='text' name='blufor_at'/></label>\n";
		$html .= "<label>Marksman: <input type='text' name='blufor_marksman'/></label>\n";
		$html .= "<label>FAC Operator: <input type='text' name='blufor_fac'/></label>\n";
		$html .= "<label>Squad Leader: <input type='text' name='blufor_sl'/></label>\n";
		$html .= "<label>Platoon Leader: <input type='text' name='blufor_pl'/></label>\n";
		$html .= "<label>Sniper / Spotter: <input type='text' name='blufor_sniper'/></label>\n";
		$html .= "<label>Mortar Support: <input type='text' name='blufor_mortar'/></label>\n";
		$html .= "<label>Demolitions: <input type='text' name='blufor_demo'/></label>\n";
		$html .= "<label>Tank Gunner: <input type='text' name='blufor_tank_gunner'/></label>\n";
		$html .= "<label>Tank Driver: <input type='text' name='blufor_tank_driver'/></label>\n";
		$html .= "<label>Tank Commander: <input type='text' name='blufor_tank_cmd'/></label>\n";
		$html .= "<label>Transport Crew: <input type='text' name='blufor_trans_crew'/></label>\n";
		$html .= "<label>Transport Pilot: <input type='text' name='blufor_trans_pilot'/></label>\n";
		$html .= "<label>Attack Chopper Crew: <input type='text' name='blufor_heli'/></label>\n";
		$html .= "<label>Fixed Wing Pilot: <input type='text' name='blufor_cas'/></label>\n";
		$html .= "<hr/>\n";

		$html .= "<h3>Opfor Requirements</h3>\n";
		$html .= "<p>For each field below, you are entering the number of these you require for opfor</p>\n";
		
		$html .= "<label>Rifleman: <input type='text' name='opfor_rifleman'/></label>\n";
		$html .= "<label>Machine Gunners: <input type='text' name='opfor_mg'/></label>\n";
		$html .= "<label>Medic: <input type='text' name='opfor_medic'/></label>\n";
		$html .= "<label>AT/AA: <input type='text' name='opfor_at'/></label>\n";
		$html .= "<label>Marksman: <input type='text' name='opfor_marksman'/></label>\n";
		$html .= "<label>FAC Operator: <input type='text' name='opfor_fac'/></label>\n";
		$html .= "<label>Squad Leader: <input type='text' name='opfor_sl'/></label>\n";
		$html .= "<label>Platoon Leader: <input type='text' name='opfor_pl'/></label>\n";
		$html .= "<label>Sniper / Spotter: <input type='text' name='opfor_sniper'/></label>\n";
		$html .= "<label>Mortar Support: <input type='text' name='opfor_mortar'/></label>\n";
		$html .= "<label>Demolitions: <input type='text' name='opfor_demo'/></label>\n";
		$html .= "<label>Tank Gunner: <input type='text' name='opfor_tank_gunner'/></label>\n";
		$html .= "<label>Tank Driver: <input type='text' name='opfor_tank_driver'/></label>\n";
		$html .= "<label>Tank Commander: <input type='text' name='opfor_tank_cmd'/></label>\n";
		$html .= "<label>Transport Crew: <input type='text' name='opfor_trans_crew'/></label>\n";
		$html .= "<label>Transport Pilot: <input type='text' name='opfor_trans_pilot'/></label>\n";
		$html .= "<label>Attack Chopper Crew: <input type='text' name='opfor_heli'/></label>\n";
		$html .= "<label>Fixed Wing Pilot: <input type='text' name='opfor_cas'/></label>\n";
		$html .= "<hr/>\n";

		$html .= "<h3>Independent Requirements</h3>\n";
		$html .= "<p>For each field below, you are entering the number of these you require for independent</p>\n";
		
		$html .= "<label>Rifleman: <input type='text' name='indi_rifleman'/></label>\n";
		$html .= "<label>Machine Gunners: <input type='text' name='indi_mg'/></label>\n";
		$html .= "<label>Medic: <input type='text' name='indi_medic'/></label>\n";
		$html .= "<label>AT/AA: <input type='text' name='indi_at'/></label>\n";
		$html .= "<label>Marksman: <input type='text' name='indi_marksman'/></label>\n";
		$html .= "<label>FAC Operator: <input type='text' name='indi_fac'/></label>\n";
		$html .= "<label>Squad Leader: <input type='text' name='indi_sl'/></label>\n";
		$html .= "<label>Platoon Leader: <input type='text' name='indi_pl'/></label>\n";
		$html .= "<label>Sniper / Spotter: <input type='text' name='indi_sniper'/></label>\n";
		$html .= "<label>Mortar Support: <input type='text' name='indi_mortar'/></label>\n";
		$html .= "<label>Demolitions: <input type='text' name='indi_demo'/></label>\n";
		$html .= "<label>Tank Gunner: <input type='text' name='indi_tank_gunner'/></label>\n";
		$html .= "<label>Tank Driver: <input type='text' name='indi_tank_driver'/></label>\n";
		$html .= "<label>Tank Commander: <input type='text' name='indi_tank_cmd'/></label>\n";
		$html .= "<label>Transport Crew: <input type='text' name='indi_trans_crew'/></label>\n";
		$html .= "<label>Transport Pilot: <input type='text' name='indi_trans_pilot'/></label>\n";
		$html .= "<label>Attack Chopper Crew: <input type='text' name='indi_heli'/></label>\n";
		$html .= "<label>Fixed Wing Pilot: <input type='text' name='indi_cas'/></label>\n";
		$html .= "<hr/>\n";
		

		$html .= "</form>";
		/* End of the form */

		return $html;
	}

	/* Save mission handler */
	public function save_mission()
	{

	}


	/* Create training session form */
	public function create_training_form()
	{
		/* The form that will be output for creating a training session */
		$html  = "<form method=\"POST\" action=\"/create_training/\">";

		$html .= "</form>";
		/* End of the form */

		return $html;
	}

	/* Create training handler */
	public function create_training()
	{

	}


	/* Promote Member Form */
	public function promote_member_form()
	{
		/* The form that will be output for member promotion */
		$html  = "<form method=\"POST\" action=\"/promote_member/\">";

		$html .= "</form>";
		/* End of the form */

		return $html;
	}

	/* Promotion handler handler */
	public function promote_member()
	{

	}


	/* Request training session form */
	public function request_training_form()
	{
		/* The form that will be output for creating a training session */
		$html  = "<form method=\"POST\" action=\"/request_training/\">";

		$html .= "</form>";
		/* End of the form */

		return $html;
	}

	/* Training request handler */
	public function request_training()
	{

	}


}