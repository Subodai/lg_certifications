<?php
/* 
	===========================================================================
	Author	:	Mark Thompson
	Desc	:	Wordpress based class to enable the creation of certificates, 
				ranks, mission, training and rewards for LG Members
	Date	: 	2014-07-03
	===========================================================================
	Updated :	2014-07-03 - File created
				2014-07-03 - Added skeleton methods for planning purposes

 */

Class This Extends That 
{
	/* Initialiser etc */
	public function init(){

	}


	/* Create Mission Form */
	public function create_mission_form()
	{
		/* The form that will be output for a mission creation */
		$html  = "<form method=\"POST\" action=\"/create_mission/\">";

		$html .= "</form>";
		/* End of the form */

		return $html;
	}

	/* Create mission handler */
	public function create_mission()
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