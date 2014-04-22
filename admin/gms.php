<?php
include("../configs.php");
ini_set("default_charset", "iso-8859-1" );    //For special chars

	mysql_select_db($server_adb);
	$check_query = mysql_query("SELECT account.id,gmlevel from account  inner join account_access on account.id = account_access.id where username = '".strtoupper($_SESSION['username'])."'") or die(mysql_error());
    $login = mysql_fetch_assoc($check_query);
	if($login['gmlevel'] < 3)
	{
		die('
<meta http-equiv="refresh" content="2;url=GTFO.php"/>
		');
	}
?>	
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
		<title>AquaFlame CMS Admin Panel</title>
		<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
		<link href="font/stylesheet.css" rel="stylesheet" type="text/css" media="all" />
		<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/tooltip.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="js/DD_roundies_0.0.2a-min.js"></script>
		<script type="text/javascript" src="js/script-carasoul.js"></script>
		<link href="css/tooltip.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="css/uniform.defaultstyle3.css" type="text/css" media="screen" />
		<script type="text/javascript" charset="utf-8">
      $(function(){
        $("input, select").uniform();
      });
    </script>
	<script type="text/javascript">
 $(document).ready(function(){
     $('.ddm').hover(
	   function(){
		 $('.ddl').slideDown();
	   },
	   function(){
		 $('.ddl').slideUp();
	   }
	 );
 });
	</script>
	<script type="text/javascript">
DD_roundies.addRule('#tabsPanel', '5px 5px 5px 5px', true);
	</script>
	<script type="text/javascript">
	$(document).ready(function()
{
   $( '#checkall' ).live( 'click', function() {
				
				$( '.chkl' ).each( function() {
					$( this ).attr( 'checked', $( this ).is( ':checked' ) ? '' : 'checked' );
				}).trigger( 'change' );
 
			});
  $('#checkall').click(function(){

 $('span').toggleClass('checked');
$('#checkall').toggleClass('clicked');

 }); 
	}); 
	</script> 
	</head>
 <body class="bgc">
	<div id="admin">
    <div id="wrap">
      <div id="head">
        <?php include('header.php'); ?>
      </div>
    <!--Content Start-->
    <div id="content">
		  <img src="images/sepLine.png" alt="" class="sepline" />
    <div class="datalist"> 
	     <div class="heading">
        <h2>Game Masters</h2>
      </div>
      <ul id="lst">
        <li>
	      <p class="editHead"><strong>Edit/Delete</strong></p>
          <p class="title"><strong>Cuenta</strong></p>
          <p class="descripHead">Nivel GM</p>
          <p class="incHead">Ultimo login</p>
        </li>
           <?php
            mysql_select_db($server_db) or die (mysql_error());
            $result = mysql_query("SELECT account.id as id, account.username as usuario, account_access.gmlevel as nivel_gm, account.last_login as ultimo_login from auth.account, auth.account_access where account.id = account_access.id order by gmlevel desc");
            while ($new = mysql_fetch_assoc($result)){
              echo'
            <li>
            <p class="edit"><a href="editgm.php?id='.$new['id'].'"><img src="images/editIco.png" alt="" /></a> <a href="deletegm.php?id='.$new['id'].'"><img src="images/deletIco.png" alt="" /></a></p>
            <p class="title">'.strip_tags($new['usuario']).' ...</p>
            <p class="descrip">'strip_tags($new['nivel_gm']).' ...</p>
            <p class="inc">'.$new['ultimo_login'].'</p>
            </li>';
            }?>
      </ul>
    </div>
    <img src="images/sepLine.png" alt="" class="sepline" />
   </div>
  </div>
  <div class="push"></div>
 </div>
<?php include("footer.php"); ?>
</body>
</html>
