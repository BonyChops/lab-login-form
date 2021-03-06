<?php

function getMac($ip){
    $pramPos = [[0,1],[1,3]];

    $WIN = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? true : false;

    $arp=exec('arp -a '.$ip);
    if($arp == "") return false;
    $arp = mb_convert_encoding($arp, "UTF-8", "SJIS");
    $lines=explode("\n", $arp);
    #look for the output line describing our IP address
    if((strpos($arp, 'ARP エントリが見つかりませんでした。') === FALSE)&&(strpos($arp, '無効な引数') === FALSE)){
        foreach($lines as $line){
            $cols = uExplodeSpace($line);
            $ipPos = $WIN == true ? $cols[$pramPos[0][0]] : substr(sscanf($cols[$pramPos[1][0]],'(%s)')[0], 0, -1);
            if($ipPos == $ip){
                return $WIN == true ? $cols[$pramPos[0][1]] : $cols[$pramPos[1][1]];
            }
        }
    }else{
        return false;
    }
}

function uExplodeSpace($data) {
    $data = preg_replace('/[\n\r\t]/', ' ', $data);
    $data = preg_replace('/\s(?=\s)/', '', $data); // 複数スペースを一つへ
    $data = trim($data);
    //echo "data=" . htmlspecialchars($data) . "<br>\n";
    return explode(" ", $data);
}