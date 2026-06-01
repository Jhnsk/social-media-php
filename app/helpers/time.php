<?php

function getTimePost($dateTime){

    $timeStamp = strtotime($dateTime);
    $diference = time() - $timeStamp;

    if($diference < 60){
        return 'Agora mesmo';
    }

    if($diference < 3600){
        $minutes = floor($diference / 60);
        return $minutes.' minuto(s) atrás';
    }

    if($diference < 86400){
        $hours = floor($diference / 3600);
        return $hours.' Horas atrás';
    }

    if($diference < 604800){
        $dias = floor($diference / 86400);
        return $dias.' dias atrás';
    }
    
    return date('d/m/Y H:i', $timeStamp);
}