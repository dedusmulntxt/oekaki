<?php

function debug($data, $die = false) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if ($die) {
        die;
    }
}

function flash($type, $text)
{
    $_SESSION['flash_msg']['type'] = $type;
    $_SESSION['flash_msg']['text'] = $text;
}

// function checklen($x, $len, $msg, $loc)
// {
//     if (strlen($x) < $len) {
//         flash('danger', $msg, $loc);
//     }
// }

// function checknum($x, $lowerbound, $upperbound, $msg, $loc)
// {
//     if (!is_numeric($x)) {
//         flash('danger', $msg, $loc);
//     }
//     if ($x < $lowerbound || $x > $upperbound) {
//         flash('danger', $msg, $loc);
//     }
// }


function modify_url_query($url, $mod){  //stack exchange

    $purl = parse_url($url);
    
    $params = array();
    
    if (($query_str=$purl['query']))
    {
        parse_str($query_str, $params);
    
        foreach($params as $name => $value)
        {
            if (isset($mod[$name]))
            {
                $params[$name] = $mod[$name];
                unset($mod[$name]);
            }
        }
    }        
    
    $params = array_merge($params, $mod);
    
    $ret = "";
    
    // if ($purl['scheme'])
    // {
    //     $ret = $purl['scheme'] . "://";
    // }    
    
    // if ($purl['host'])
    // {
    //     $ret .= $purl['host'];
    // }    
    
    // if ($purl['path'])
    // {
    //     $ret .= $purl['path'];
    // }    
    
    if ($params)
    {
        $ret .= '?' . http_build_query($params);
    }    
    
    
    // if ($purl['fragment'])
    // {
    //     $ret .= "#" . $purl['fragment'];
    // }        
    
    return $ret;
    
}