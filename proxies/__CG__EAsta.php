<?php

namespace Proxies\__CG__;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class EAsta extends \EAsta implements \Doctrine\ORM\Proxy\InternalProxy
{
     use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as __load;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'data_creazione' => [parent::class, 'data_creazione', null],
        "\0".parent::class."\0".'data_fine' => [parent::class, 'data_fine', null],
        "\0".parent::class."\0".'id_asta' => [parent::class, 'id_asta', null],
        "\0".parent::class."\0".'usato' => [parent::class, 'usato', null],
        "\0".parent::class."\0".'venditore' => [parent::class, 'venditore', null],
        'data_creazione' => [parent::class, 'data_creazione', null],
        'data_fine' => [parent::class, 'data_fine', null],
        'id_asta' => [parent::class, 'id_asta', null],
        'usato' => [parent::class, 'usato', null],
        'venditore' => [parent::class, 'venditore', null],
    ];

    public function __isInitialized(): bool
    {
        return isset($this->lazyObjectState) && $this->isLazyObjectInitialized();
    }

    public function __serialize(): array
    {
        $properties = (array) $this;
        unset($properties["\0" . self::class . "\0lazyObjectState"]);

        return $properties;
    }
}