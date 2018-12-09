<?php
	class interfaces {
		var $title;
		var $footer;
		var $template;	
		var $connect;
		function interfaces($connect) {
			$this->connect = $connect;
		}
		function getFromMySQL($variable) {
			$sql = "select * from interface where variable = '$variable'";
			// echo $sql;
			$this->connect->query($sql);
			$data = $this->connect->getnext();
			return $data->value;
		}
		function getTextFailLogin() {
			return $this->getFromMySQL('fail_login');
		}
		function getTextPleaseLogin() {
			return $this->getFromMySQL('please_login');
		}
		function getTemplate() {
			return $this->getFromMySQL('template_name');
		}
		function getTitle() {
			return $this->getFromMySQL('title');
		}
		function getFooterPopUp() {
			return $this->getFromMySQL('footer_popup');
		}
		function getFooter() {
			return $this->getFromMySQL('footer');
		}

	}
?>
