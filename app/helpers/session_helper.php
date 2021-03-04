<?php
	session_start();
	/**
	 * @return bool
	 * Check si  l'utilisateur est connecté via le cookie dee seession
	 */
	function isLoggedIn() {
		if (isset($_SESSION['user_id'])) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * @return bool
	 * Check si le role de l'utilisateur est anonymous
	 */
	function isAnonymous() {
		if (isset($_SESSION["role"]) && $_SESSION['role'] === "anonymous") {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @return bool
	 * Check si le role de l'utilisateur est user
	 */
	function isUser() {
		if (isset($_SESSION["role"]) && $_SESSION['role'] === "user") {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @return bool
	 * Check si le role de l'utilisateur est author
	 */
	function isAuthor() {
		if (isset($_SESSION["role"]) && $_SESSION['role'] === "author") {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * @return bool
	 * Check si le role de l'utilisateur est admin
	 */
	function isAdmin() {
		if (isset($_SESSION["role"]) && $_SESSION['role'] === "admin") {
			return true;
		} else {
			return false;
		}
	}
