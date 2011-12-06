<?php
require_once 'pre.php';
require_once 'auth.php';
include_once realpath(dirname(__FILE__)) . '/../../../fonctions/authplugins.php';
autorisation('eanmpn');

// Si aucune ref n'est transmise, ou si le produit n'existe pas, on arrête là le massacre!
if(empty($_REQUEST['ref'])) return false;
$produit = new Produit();
if(!$produit->charger(lireParam('ref'))) return false;

// langue
$lang=1;
if(!empty($_GET['lang'])) $lang=$_GET['lang'];

require_once realpath(dirname(__FILE__)) . '/Eanmpn.class.php';

$resul = CacheBase::getCache()->mysql_query('SELECT ean, mpn FROM ' . Produit::TABLE . ' WHERE id=' . $produit->id, $this->link);
$eanmpn = array('ean' => '', 'mpn,' => '');
if(!empty($resul[0]->ean)) $eanmpn['ean'] = $resul[0]->ean;
if(!empty($resul[0]->mpn)) $eanmpn['mpn'] = $resul[0]->mpn;
?>
<script type="text/javascript" src="../client/plugins/eanmpn/js/eanmpn.js"></script>

<div class="entete_liste_config">
    <div class="titre" style="cursor:pointer" onclick="$('#plianteanmpn').show('slow');">EAN & MPN</div>
	<div class="fonction_valider"><a href="#" class="eanmpn_valider">VALIDER LES MODIFICATIONS</a></div>
</div>

<div class="blocs_pliants_prod caracphotos" id="plianteanmpn">
	
	<table width="100%" cellpadding="5" cellspacing="0" style="margin:0">
	<tbody>
	<tr class="claire">
		<td class="designation" width="140">N° EAN</td>
        <td><input name="eanmpn_ean" type="text" class="form_long" value="<?php echo $eanmpn['ean']; ?>"></td>
	</tr>
    <tr class="claire">
        <td class="designation" width="140">N° MPN</td>
        <td><input name="eanmpn_mpn" type="text" class="form_long" value="<?php echo $eanmpn['mpn']; ?>"></td>
    </tr>
    </tbody>
	</table>

    <div class="bloc_fleche" style="cursor:pointer" onclick="$('#plianteanmpn').hide();"><img src="gfx/fleche_accordeon_up.gif"></div>

</div> <!-- /.blocs_pliants_prod .eanmpn -->