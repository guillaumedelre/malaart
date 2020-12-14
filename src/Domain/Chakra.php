<?php

namespace App\Domain;

class Chakra
{
    public const CHAKRA_MULADHARA = 'muladhara';
    public const CHAKRA_SWADHISTANA = 'swadhistana';
    public const CHAKRA_MANIPURA = 'manipura';
    public const CHAKRA_ANAHATA = 'anahata';
    public const CHAKRA_VISHUDA = 'vishuda';
    public const CHAKRA_AJNA = 'ajna';
    public const CHAKRA_SAHASRARA = 'sahasrara';

    public const ALL = [
        self::CHAKRA_MULADHARA,
        self::CHAKRA_SWADHISTANA,
        self::CHAKRA_MANIPURA,
        self::CHAKRA_ANAHATA,
        self::CHAKRA_VISHUDA,
        self::CHAKRA_AJNA,
        self::CHAKRA_SAHASRARA,
    ];

    public const FORM_CHOICES = [
        'Chakra racine (Muladhara)' => self::CHAKRA_MULADHARA,
        'Chakra sacré (Swadhistana)' => self::CHAKRA_SWADHISTANA,
        'Chakra plexus solaire (Manipura)' => self::CHAKRA_MANIPURA,
        'Chakra coeur (Anahata)' => self::CHAKRA_ANAHATA,
        'Chakra gorge (Vishuda)' => self::CHAKRA_VISHUDA,
        'Chakra frontal (Ajna)' => self::CHAKRA_AJNA,
        'Chakra coronal (Sahasrara)' => self::CHAKRA_SAHASRARA,
    ];
}
