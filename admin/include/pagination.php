<?php
function pagination($curpage, $limit, $count, $send=NULL, $range=4, $target="_self"){
	$html = "";
	$total = ceil($count/$limit);
	$start = $curpage-$range;
	$end = $curpage+$range;
	if(!empty($send)) $send = "&".$send;
	if($start <= 0) $start = 1;
	if($end >= $total) $end = $total;
	if($curpage>1){
		$back = $curpage-1;
		if($curpage > 2) $html .=  "\n<li class=\"digit\"><a href=\"?page=1" . $send . "\" target=\"" . $target . "\"> &laquo; </a></li>";
		$html .=  "\n<li class=\"digit\"><a href=\"?page=" . $back . $send . "\" target=\"" . $target . "\"> &#8249; </a></li>";
	}
	for($i = $start; $i <= $end; $i++){
		if($i == $curpage) $html .=  "\n<li class=\"digit current\"><a href=\"?page=" . $i . $send . "\" target=\"" . $target . "\"> $i </a></li>";
		else $html .=  "\n<li class=\"digit\"><a href=\"?page=" . $i . $send . "\" target=\"" . $target . "\"> $i </a></li>";
	}
	if($curpage < $total){
		$next = $curpage+1;
		$html .=  "\n<li class=\"digit\"><a href=\"?page=" . $next . $send . "\" target=\"" . $target . "\"> &#8250; </a></li>";
		if(($curpage+1) < $total) $html .=  "\n<li class=\"digit\"><a href=\"?page=" . $total . $send . "\" target=\"" . $target . "\"> &raquo; </a></li>";
	}
	if($start>$end) $html .=  "\n<li class=\"digit\"><a href=\"?page=" . $curpage . $send . "\" target=\"" . $target . "\"> ". $curpage ." </a></li>";
	return $html;
}
?>