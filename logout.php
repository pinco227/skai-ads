<?php
session_start();
session_destroy();
session_unset();
if(isset($_SERVER['HTTP_REFERER']))
{
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$_SERVER['HTTP_REFERER'].'">';
}
else
{
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=index.php">';
}
