<?php

namespace Proxies\__CG__;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class EOrdineProdotto extends \EOrdineProdotto implements \Doctrine\ORM\Proxy\InternalProxy
{
     use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as __load;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'ordine_id' => [parent::class, 'ordine_id', null],
        "\0".parent::class."\0".'prodotto_id' => [parent::class, 'prodotto_id', null],
        "\0".parent::class."\0".'quantita_ordinata_prodotto' => [parent::class, 'quantita_ordinata_prodotto', null],
        'ordine_id' => [parent::class, 'ordine_id', null],
        'prodotto_id' => [parent::class, 'prodotto_id', null],
        'quantita_ordinata_prodotto' => [parent::class, 'quantita_ordinata_prodotto', null],
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