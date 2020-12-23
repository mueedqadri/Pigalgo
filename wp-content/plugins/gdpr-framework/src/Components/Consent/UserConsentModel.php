<?php

namespace Codelight\GDPR\Components\Consent;

use DateTime;

/**
 * Class UserConsentModel
 *
 * @package Codelight\GDPR\Components\Consent
 */
class UserConsentModel
{
	/* @var string */
	public $tableName;

	/* @var string */
	public $logtableName;

	/* @var string */
	public $version = '1.0';

	/* @var string */
	public $primaryKey = 'id';

	/**
	 * UserConsentModel constructor.
	 */
	public function __construct()
	{ 
		$this->setTableName();
		$this->setUserLogTableName();
		$this->setClassiDocsCallback();
		// todo: cleanup
		// global $wpdb;
		//$wpdb->query('TRUNCATE TABLE wp_gdpr_consent');
	}

	/**
	 * Set the table name with wpdb-s prefix
	 */
	protected function setTableName()
	{
		global $wpdb;
		$this->tableName = $wpdb->prefix . 'gdpr_consent';
	}

	/**
	 * Set the table name with wpdb-s prefix
	 */
	protected function setUserLogTableName()
	{
		global $wpdb;
		$this->logtableName = $wpdb->prefix . 'gdpr_userlogs';
	}
	
	/**
	 * Set the table name with wpdb-s prefix
	 */
	protected function setClassiDocsCallback()
	{
		global $wpdb;
		$this->ClassiDocsCallback = $wpdb->prefix . 'gdpr_ClassiDocsCallback';
	}

	/**
	 * Check if a user has given a consent
	 *
	 * @param $email
	 * @param $consent
	 * @return int
	 */
	public function given($email, $consent)
	{
		global $wpdb;

		return count( $wpdb->get_results( $wpdb->prepare(
			"SELECT * FROM {$this->tableName} WHERE email = %s AND consent = %s AND status = 1;",
			$email,
			$consent->consent
		) ) );
		
	}

	/**
	 * Check if a user has withdrawn a consent
	 *
	 * @param $email
	 * @param $consent
	 * @return int
	 */
	public function withdrawn($email, $consent)
	{
		global $wpdb;

		return count($wpdb->get_results($wpdb->prepare(
			"SELECT * FROM {$this->tableName} WHERE email = %s AND consent = %s AND status = 0;",
			$email,
			$consent
		)));
	}

	/**
	 * Check if a consent exists in the database
	 *
	 * @param $email
	 * @param $consent
	 * @return array|null|object
	 */
	public function exists($email, $consent)
	{
		global $wpdb;

		return count($wpdb->get_results($wpdb->prepare(
			"SELECT * FROM {$this->tableName} WHERE email = %s AND consent = %s;",
			$email,
			$consent
		)));
	}

	/**
	 * Set a consent to 'given'
	 *
	 * @param $email
	 * @param $consent
	 * @param $status
	 * @return false|int
	 */
	public function give($email, $consent, $valid_until)
	{
		$this->set($email, $consent, 1, $valid_until);
	}

	/**
	 * Set a consent to 'withdrawn'
	 *
	 * @param $email
	 * @param $consent
	 * @param $status
	 * @return false|int
	 */
	public function withdraw($email, $consent)
	{
		$this->set($email, $consent, 0);
	}

	/**
	 * Set a consent to 'given' or 'withdrawn'
	 *
	 * @param $email
	 * @param $consent
	 * @param $status
	 * @return false|int
	 */
	protected function set($email, $consent, $status, $valid_until, $version = 1)
	{
		global $wpdb;

		if( $valid_until !== null && $valid_until !== '' ) {
			$future_date = new DateTime( current_time( 'mysql' ) );
			date_add( $future_date, date_interval_create_from_date_string( $valid_until . 'months' ) );
			$future_date = date_format($future_date, 'Y-m-d H:i:s');
		}else{
			$future_date = '9999-12-31 23:59:59';
		}

		

		if ($this->exists($email, $consent)) {
			return $wpdb->update(
				$this->tableName,
				[
					'version'     => $version,
					'consent'     => $consent,
					'status'      => $status,
					'updated_at'  => current_time( 'mysql' ),
					'ip'          => $_SERVER['REMOTE_ADDR'],
					'valid_until' => $future_date,
				],
				[
					'email'   => $email,
					'consent' => $consent,
				]
			);
		} else {
			return $wpdb->insert(
				$this->tableName,
				[
					'email'       => $email,
					'version'     => $version,
					'consent'     => $consent,
					'status'      => $status,
					'updated_at'  => current_time( 'mysql' ),
					'ip'          => $_SERVER['REMOTE_ADDR'],
					'valid_until' => $future_date,
				]
			);
		}
	}

	/**
	 * Set a userlog
	 *
	 * @param $email
	 * @param $userlog
	 */
	public function savelog($email, $userlog)
	{
		
		$this->savelog_gdpr($email, $userlog);
	}

	/**
	 * Set a userlog to show previous data
	 *
	 * @param $userid
	 * @param $userlog
	 */
	protected function savelog_gdpr($user_id,$userlog)
	{
		global $wpdb;
		if (!empty($user_id) && !empty($userlog)) {
			$sa= $wpdb->insert(
				$this->logtableName,
				[
					'user_id'    => $user_id,
					'userlog'    => $userlog,
					'updated_at' => current_time( 'mysql' ),
					'ip'         => $_SERVER['REMOTE_ADDR'],
				]
			);
		}
	}

	/**
	 * Get all consent given by data subject
	 *
	 * @param $email
	 */
	public function getAll($email)
	{
		global $wpdb;

		/**
		 * Workaround to an issue with array_column in PHP5.6 - thanks @paulnewson
		 */
		if (version_compare(PHP_VERSION, '7') >= 0) {
			return $wpdb->get_results( $wpdb->prepare(
				"SELECT * FROM {$this->tableName} WHERE email = %s and status = 1;",
				$email
			));
		} else {
			return json_decode( json_encode( $wpdb->get_results($wpdb->prepare(
				"SELECT * FROM {$this->tableName} WHERE email = %s and status = 1;",
				$email
			))), true);
		}
		/**
         * Workaround to an issue with array_column in PHP5.6 - thanks @paulnewson
         */
        // if (version_compare(PHP_VERSION, '7') >= 0) {
        //     return array_column($wpdb->get_results($wpdb->prepare(
        //         "SELECT * FROM {$this->tableName} WHERE email = %s and status = 1;",
        //         $email
        //     )), 'consent');
        // } else {
        //     return array_column(json_decode(json_encode($wpdb->get_results($wpdb->prepare(
        //         "SELECT * FROM {$this->tableName} WHERE email = %s and status = 1;",
        //         $email
        //     ))), true), 'consent');
        // }
	}

	
	/**
	 * Get all consent given by data subject with data
	 *
	 * @param $email
	 */
	public function getAllwithdetails($email)
	{
		global $wpdb;

		/**
		 * Workaround to an issue with array_column in PHP5.6 - thanks @paulnewson
		 */
		if (version_compare(PHP_VERSION, '7') >= 0) {
			return $wpdb->get_results($wpdb->prepare(
				"SELECT * FROM {$this->tableName} WHERE email = %s and status = 1;",
				$email
			));
		} else {
			return json_decode(json_encode($wpdb->get_results($wpdb->prepare(
				"SELECT * FROM {$this->tableName} WHERE email = %s and status = 1;",
				$email
			))), true);
		}
	}

	/**
	 * Get all consent given by data subject
	 *
	 * @param $email
	 */
	public function getuserlogs($userid)
	{
		global $wpdb;
		/**
		 * Workaround to an issue with array_column in PHP5.6 - thanks @paulnewson
		 */
		if (version_compare(PHP_VERSION, '7') >= 0) {
			return $wpdb->get_results($wpdb->prepare(
				"SELECT * FROM {$this->logtableName} WHERE user_id = %s;",
				$userid
			));
		} else {
			return json_decode(json_encode($wpdb->get_results($wpdb->prepare(
				"SELECT * FROM {$this->logtableName} WHERE user_id = %s;",
				$userid
			))), true);
		}
	}

	/**
	 * Remove a log row from the database
	 *
	 * @param $id
	 */
	public function deletelog($id)
	{
		global $wpdb;

		return $wpdb->delete(
			$this->logtableName,
			[
				'user_id'   => $id,
			]
		);
	}

	/**
	 * Remove a consent row from the database
	 *
	 * @param $email
	 * @param $consent
	 * @return false|int
	 */
	public function delete($email, $consent)
	{
		global $wpdb;

		return $wpdb->delete(
			$this->tableName,
			[
				'email'   => $email,
				'consent' => $consent,
			]
		);
	}

	/**
	 * Withdraw consent and anonymize data subject's email
	 *
	 * @param $email
	 * @param $consent
	 * @param $anonymizedId
	 * @return false|int
	 */
	public function anonymize($email, $consent, $anonymizedId)
	{
		global $wpdb;

		if ($this->exists($email, $consent)) {
			return $wpdb->update(
				$this->tableName,
				[
					'email'      => $anonymizedId,
					'consent'    => $consent,
					'status'     => 0,
					'updated_at' => current_time( 'mysql' ),
					'ip'         => $_SERVER['REMOTE_ADDR'],
				],
				[
					'email'   => $email,
					'consent' => $consent,
				]
			);
		}
	}

	/**
	 * Get columns and formats
	 */
	public function getColumns()
	{
		return [
			'id'         => '%d',
			'version'    => '%d',
			'email'      => '%s',
			'consent'    => '%s',
			'status'     => '%d',
			'updated_at' => '%s',
			'ip'         => '%s',
			'valid_until'   => '%s',
		];
	}

	/**
	 * Get default column values
	 */
	public function getColumnDefaults()
	{
		return [
			'id'         => '',
			'version'    => 1,
			'email'      => '',
			'consent'    => '',
			'status'     => '',
			'updated_at' => '',
			'ip'         => '',
			'valid_until'   => '',
		];
	}

	/**
	 * Create the table
	 */
	public function createTable()
	{
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		$sql = "CREATE TABLE " . $this->tableName . " (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			version int NOT NULL,
			email varchar(64) NOT NULL,
			consent varchar(128) NOT NULL,
			status tinyint NOT NULL,
			updated_at TIMESTAMP NULL,
			ip varchar(64) NOT NULL,
			valid_until DATETIME NOT NULL,
			PRIMARY KEY  (id)
			) CHARACTER SET utf8 COLLATE utf8_general_ci;";
		dbDelta($sql);
		update_option($this->tableName . '_db_version', $this->version);
	}
	/**
	 * create table to user logs
	 */
	public function createUserTable()
	{
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		$sql = "CREATE TABLE " . $this->logtableName . " (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			user_id int NOT NULL,
			userlog varchar(4000) NOT NULL,
			updated_at TIMESTAMP NULL,
			ip varchar(64) NOT NULL,
			PRIMARY KEY  (id)
			) CHARACTER SET utf8 COLLATE utf8_general_ci;";
		dbDelta($sql);
		update_option($this->logtableName . '_db_version', $this->version);
	}

	/**
	 * create table for store request from classidocs
	 */
	public function createClassiDocsCallback()
	{ 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		$sql = "CREATE TABLE " . $this->ClassiDocsCallback . " (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			request_number int NOT NULL,
			consent_id int NOT NULL,
			updated_at TIMESTAMP NULL,
			PRIMARY KEY  (id)
			) CHARACTER SET utf8 COLLATE utf8_general_ci;";
		dbDelta($sql);
		update_option($this->ClassiDocsCallback . '_db_version', $this->version);
	}
}