<?php
include_once(realpath(dirname(__FILE__)) . "/../../../classes/PluginsClassiques.class.php");
include_once(realpath(dirname(__FILE__)) . "/../../../classes/Produit.class.php");

class Eanmpn extends PluginsClassiques{

	/**
	 * @see PluginsClassiques::init()
	 */
	function init() {
		$resul = $this->query('ALTER TABLE ' . Produit::TABLE. ' ADD  `ean` VARCHAR( 25 ) NOT NULL');
        $resul = $this->query('ALTER TABLE ' . Produit::TABLE. ' ADD  `mpn` VARCHAR( 25 ) NOT NULL');
	}
	
	/**
	 * Modification d'un produit
	 * @see PluginsClassiques::modprod()
	 */
	function modprod($produit) {
		$lang=$_SESSION["util"]->lang;
		if(!empty($_REQUEST['lang']) && preg_match('/^[0-9]{1,}$/', $_REQUEST['lang'])) $lang=$_REQUEST['lang'];
		if(empty($lang)) $lang=1;
		
		$ean = ((!empty($_POST['eanmpn_ean'])) ? $_POST['eanmpn_ean'] : '');
        $mpn = ((!empty($_POST['eanmpn_mpn'])) ? $_POST['eanmpn_mpn'] : '');
		$this->query('
			UPDATE ' . Produit::TABLE . ' 
			SET ean=\'' . mysql_real_escape_string($ean) . '\',
			    mpn=\'' . mysql_real_escape_string($mpn) . '\'
			WHERE id=' . $produit->id);
		return $this;
	}

}
