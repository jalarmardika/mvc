<?php 
namespace App\Core;

class Message {

	public static function has(string $name): bool
	{
		if (isset($_SESSION['flash'])) {
			return $_SESSION['flash']['name'] == $name;
		}
		return false;
	}
	public static function setFlash(string $name, string $message): void
	{
		$_SESSION['flash'] = [
			'name' => $name,
			'message' => $message
		];
	}
	public static function flash(string $name): void
	{
		if (isset($_SESSION['flash'])) {
			if ($_SESSION['flash']['name'] == $name) {
				echo $_SESSION['flash']['message'];
			}
			
			unset($_SESSION['flash']);
		}
	}

}
