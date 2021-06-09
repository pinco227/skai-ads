<?php
function pagination($link, $page, $total_pages) {

	$return = "";
//  show first and previous links
//  disable if we're on the first page or if there's only 1 page
	$return .= '<td valign="middle" align="right" width="13%">';
	if ($page != 1 && $total_pages > 1) {
		$return .= "<a href=\"".$link."1\"><img src='images/prima.gif' alt='' align='' /></a>&nbsp;";
		$return .= "&nbsp;<a href=\"".$link.($page - 1)."\"><img src='images/anterioara.gif' alt='' align='' /></a>&nbsp;&nbsp; ";
	} else {
		$return .= "<img src='images/prima2.gif' alt='' align='' />&nbsp;";
		$return .= "&nbsp;<img src='images/anterioara2.gif' alt='' align='' />&nbsp;&nbsp; ";
	}
	$return .= "</td>";
	 
	//  don't bother looping if there's only 1 page
	if ($total_pages == 1) {
		$return .= '<td valign="middle" align="center" width="34%">';
		$return .= "1";
		$return .= "</td>";
	} else {
		$return .= '<td valign="middle" align="center" width="34%">';
	//  placeholders so we know if we've already shown dots already or not
		$dots_before = 0;
		$dots_after = 0;
	//  loop through all the pages starting at 1
		for ($i = 1; $i <= $total_pages; $i++) {
		//  are we at the current page?
			if ($i == $page) {
				if ($i == 1) {  //  if this is page 1, don't put in a comma before the number
					$return .= $i;
				} else {    //  not the first page, put in a comma
					$return .= " | ".$i;
				}
			} else {    //  not at the current page, lets display links
				if (($i <= 2) || ($i < $page && $i >= ($page - 2)) || ($i > $page && $i <= ($page + 2)) || ($i > ($total_pages - 2))) {
					if ($i == 1) {  //  if this is page 1, don't put in a comma before the number
						$return .= "<a href=\"".$link.$i."\">".$i."</a>";
					} else {    //  not the first page, put in a comma
						$return .= " | <a href=\"".$link.$i."\">".$i."</a>";
					}
				} else {
					if ($i < $page) {    //  dots before the current page
						if ($dots_before == 0) {
							$dots_before = 1;
							$return .= " | ...";
						}
					} else if ($i > $page) { //  dots after the current page
						if ($dots_after == 0) {
							$dots_after = 1;
							$return .= " | ...";
						}
					}
				}
			}
		}
		$return .= "</td>";
	}

	 
	//  show next and last links
	//  disable if we're on the last page or if there's only 1 page
	$return .= '<td valign="middle" align="left" width="13%">';
	if ($page != $total_pages && $total_pages > 1) {
		$return .= " &nbsp;&nbsp;<a href=\"".$link.($page + 1)."\"><img src='images/urmatoare.gif' alt='' align='' /></a>&nbsp;";
		$return .= "&nbsp;<a href=\"".$link.$total_pages."\"><img src='images/ultima.gif' alt='' align='' /></a>";
	} else {
		$return .= " &nbsp;&nbsp;<img src='images/urmatoare2.gif' alt='' align='' />&nbsp;";
		$return .= "&nbsp;<img src='images/ultima2.gif' alt='' align='' />";
	}
	$return .= "</td>";
	 
	return $return;
}
