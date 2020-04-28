<?php
$ipAddress=$_SERVER['REMOTE_ADDR'];
$macAddr=false;

function getMac($ip){
    echo PHP_OS;

    $pramPos = [[0,1],[1,3]];

    $WIN = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? true : false;

    $arp=exec('arp -a '.$ip);
    if($arp == "") return false;
    $arp = mb_convert_encoding($arp, "UTF-8", "SJIS");
    var_dump($arp);
    $lines=explode("\n", $arp);
    #look for the output line describing our IP address
    if((strpos($arp, 'ARP エントリが見つかりませんでした。') === FALSE)&&(strpos($arp, '無効な引数') === FALSE)){
        foreach($lines as $line)
        {
            $cols = uExplodeSpace($line);
            var_dump($cols);
            $ipPos = $WIN == true ? $cols[$pramPos[0][0]] : substr(sscanf($cols[$pramPos[1][0]],"($s)")[0], 0, -1);
            echo sscanf($cols[$pramPos[1][0]],"($s)")[0];
            if($ipPos == $ip) {
                $macAddr = $WIN == true ? $cols[$pramPos[0][1]] : $cols[$pramPos[1][1]];
                break;
            }
        }
        return $macAddr;
    }else{
        return false;
    }
}

getMac($ipAddress);

var_dump($macAddr);

function uExplodeSpace($data) {
    $data = preg_replace('/[\n\r\t]/', ' ', $data);
    $data = preg_replace('/\s(?=\s)/', '', $data); // 複数スペースを一つへ
    $data = trim($data);
    //echo "data=" . htmlspecialchars($data) . "<br>\n";
    return explode(" ", $data);
}