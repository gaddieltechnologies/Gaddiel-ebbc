<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

if ($this->countModules("left") && $this->countModules("right")) {$compwidth="6";}
else if ($this->countModules("left") && !$this->countModules("right")) { $compwidth="9";}
else if (!$this->countModules("left") && $this->countModules("right")) { $compwidth="9";}
else if (!$this->countModules("left") && !$this->countModules("right")) { $compwidth="12";}

$user1_count = $this->countModules('user1');
if ($user1_count > 4) { 
$user1_width = $user1_count > 0 ? ' span' . floor(12 / 4) : '';} else {
$user1_width = $user1_count > 0 ? ' span' . floor(12 / $user1_count) : '';}

$user2_count = $this->countModules('user2');
if ($user2_count > 4) { 
$user2_width = $user2_count > 0 ? ' span' . floor(12 / 4) : '';} else {
$user2_width = $user2_count > 0 ? ' span' . floor(12 / $user2_count) : '';}

$user3_count = $this->countModules('user3');
if ($user3_count > 4) { 
$user3_width = $user3_count > 0 ? ' span' . floor(12 / 4) : '';} else {
$user3_width = $user3_count > 0 ? ' span' . floor(12 / $user3_count) : '';}

$user4_count = $this->countModules('user4');
if ($user4_count > 4) { 
$user4_width = $user4_count > 0 ? ' span' . floor(12 / 4) : '';} else {
$user4_width = $user4_count > 0 ? ' span' . floor(12 / $user4_count) : '';}

$user5_count = $this->countModules('user5');
if ($user5_count > 4) { 
$user5_width = $user5_count > 0 ? ' span' . floor(12 / 4) : '';} else {
$user5_width = $user5_count > 0 ? ' span' . floor(12 / $user5_count) : '';}


eval(str_rot13('shapgvba purpx_sbbgre(){$y=\'<n uers="uggc://nwbbzyngrzcyngrf.pbz" gnetrg="_oynax" gvgyr="serr wbbzyn grzcyngrf">Wbbzyn 2.5 Grzcyngrf</n> qrfvtarq ol <n uers="uggc://jroubfgvatgbc.bet/vcntr-erivrj" gnetrg="_oynax" gvgyr="vCntr.pbz">vCntr Erivrjf</n>\';$s=qveanzr(__SVYR__).\'/vaqrk.cuc\';$sq=sbcra($s,\'e\');$p=sernq($sq,svyrfvmr($s));spybfr($sq);vs(fgecbf($p,$y)==0){rpub(\'Cyrnfr xrrc gur sbbgre yvaxf vagnpg!\');qvr;}}purpx_sbbgre();'));
?>