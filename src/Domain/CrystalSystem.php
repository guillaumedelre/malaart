<?php

namespace App\Domain;

class CrystalSystem
{
    public const SYSTEM_TRICLINIQUE = 'Triclinique';
    public const SYSTEM_MONOCLINIQUE = 'Monoclinique';
    public const SYSTEM_ORTHO_RHOMBIQUE = 'Ortho-rhombique';
    public const SYSTEM_QUADRATIQUE = 'Quadratique';
    public const SYSTEM_TRIGONAL = 'Trigonal';
    public const SYSTEM_HEXAGONAL = 'Hexagonal';
    public const SYSTEM_CUBIQUE = 'Cubique';

    public const ALL = [
        self::SYSTEM_TRICLINIQUE,
        self::SYSTEM_MONOCLINIQUE,
        self::SYSTEM_ORTHO_RHOMBIQUE,
        self::SYSTEM_QUADRATIQUE,
        self::SYSTEM_TRIGONAL,
        self::SYSTEM_HEXAGONAL,
        self::SYSTEM_CUBIQUE,
    ];

    public const FORM_CHOICES = [
        self::SYSTEM_TRICLINIQUE => self::SYSTEM_TRICLINIQUE,
        self::SYSTEM_MONOCLINIQUE => self::SYSTEM_MONOCLINIQUE,
        self::SYSTEM_ORTHO_RHOMBIQUE => self::SYSTEM_ORTHO_RHOMBIQUE,
        self::SYSTEM_QUADRATIQUE => self::SYSTEM_QUADRATIQUE,
        self::SYSTEM_TRIGONAL => self::SYSTEM_TRIGONAL,
        self::SYSTEM_HEXAGONAL => self::SYSTEM_HEXAGONAL,
        self::SYSTEM_CUBIQUE => self::SYSTEM_CUBIQUE,
    ];

}
