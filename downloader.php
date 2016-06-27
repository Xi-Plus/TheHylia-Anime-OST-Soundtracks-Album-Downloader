<?php
$u=$_SERVER["argv"][1];
if (!isset($u)) {
	exit("no url");
}
if (isset($_SERVER["argv"][2])) {
	$conut=(int)$_SERVER["argv"][2];
} else {
	$conut=0;
}
$t=file_get_contents($u);
$t=str_replace("\r\n", "", $t);
preg_match('/<table align="center" width="95%" border="0" style="border-collapse: collapse" bordercolor="#000000" cellpadding="3">(.+?)<\/table>/',$t, $m);
$t=$m[1];
preg_match_all('/<a href="(.+?)">.+?<\/a>/', $t, $m);
foreach ($m[1] as $u) {
	if($conut>0){
		$conut--;
		continue;
	}
	$t=file_get_contents($u);
	preg_match('/<a style="color: red;" href="(.+?)">Download to Computer<\/a>/', $t, $m);
	$u=$m[1];
	system("\"C:\Program Files (x86)\GnuWin32\bin\wget.exe\" ".$u);
}
?>
