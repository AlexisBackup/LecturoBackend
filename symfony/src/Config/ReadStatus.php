<?php

namespace App\Config;

enum ReadStatus: string
{
    case TO_READ = "À lire";
    case READING = "En cours";
    case FINISHED = "Terminé";
}
