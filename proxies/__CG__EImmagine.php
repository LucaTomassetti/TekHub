<?php

namespace Proxies\__CG__;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class EImmagine extends \EImmagine implements \Doctrine\ORM\Proxy\InternalProxy
{
    use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as __load;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'id_image' => [parent::class, 'id_image', null],
        "\0".parent::class."\0".'imageData' => [parent::class, 'imageData', null],
        "\0".parent::class."\0".'name' => [parent::class, 'name', null],
        "\0".parent::class."\0".'prodotto' => [parent::class, 'prodotto', null],
        "\0".parent::class."\0".'size' => [parent::class, 'size', null],
        "\0".parent::class."\0".'type' => [parent::class, 'type', null],
        'id_image' => [parent::class, 'id_image', null],
        'imageData' => [parent::class, 'imageData', null],
        'name' => [parent::class, 'name', null],
        'prodotto' => [parent::class, 'prodotto', null],
        'size' => [parent::class, 'size', null],
        'type' => [parent::class, 'type', null],
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
