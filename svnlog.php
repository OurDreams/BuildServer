

<?php
$svn_url=isset($_GET['url']) ? $_GET['url'] : '';
$log = shell_exec('svn log -l 5 '.$svn_url);
$log = mb_convert_encoding($log, "UTF-8", "GBK");

preg_match_all("|\nr(.*?)\s\|\s(.*?)\s\|\s(.*?)\s\+.*?\n\n(.*?)\n|", $log, $out, PREG_PATTERN_ORDER);
for ($i = 0; $i < count($out[0]); $i++)
{
    // print_r($out[1][$i] . '<br>' . $out[2][$i] . '<br><br>');
?>
    <option value="<?php echo($out[1][$i]);?>"><?php echo($out[1][$i] . ' | ' . $out[2][$i] . ' | ' . $out[3][$i] . ' | ' . mb_substr($out[4][$i], 0, 25, 'utf-8') . '...');?></option>
<?php
}


// print_r(nl2br(mb_convert_encoding($log, "GBK", "GBK")));
?> 
