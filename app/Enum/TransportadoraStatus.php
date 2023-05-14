<?php

namespace App\Enum;

enum TransportadoraStatus
{
    case ATIVADO;
    case INATIVADO;

    public function status(){
        return match ($this){
            $this::ATIVADO => 1,
            $this::INATIVADO => 0,
        };
    }
}
