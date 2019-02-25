<?
function nfn($n,$d=2) {
	$pror=number_format($n, $d, '.', ' ');
	$ar_pror=explode(".",$pror);
	return $ar_pror[0].'.<span class="fs_ump">'.$ar_pror[1].'</span>';
}
?>