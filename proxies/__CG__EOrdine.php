<?php

namespace Proxies\__CG__;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class EOrdine extends \EOrdine implements \Doctrine\ORM\Proxy\InternalProxy
{
     use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as __load;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'acquirente' => [parent::class, 'acquirente', null],
        "\0".parent::class."\0".'carta_ordine' => [parent::class, 'carta_ordine', null],
        "\0".parent::class."\0".'data' => [parent::class, 'data', null],
        "\0".parent::class."\0".'id_ordine' => [parent::class, 'id_ordine', null],
        "\0".parent::class."\0".'importo_tot' => [parent::class, 'importo_tot', null],
        "\0".parent::class."\0".'indirizzi' => [parent::class, 'indirizzi', null],
        "\0".parent::class."\0".'q_prodotto_ordine' => [parent::class, 'q_prodotto_ordine', null],
        "\0".parent::class."\0".'quantita_prodotto' => [parent::class, 'quantita_prodotto', null],
        "\0".parent::class."\0".'stato' => [parent::class, 'stato', null],
        'acquirente' => [parent::class, 'acquirente', null],
        'carta_ordine' => [parent::class, 'carta_ordine', null],
        'data' => [parent::class, 'data', null],
        'id_ordine' => [parent::class, 'id_ordine', null],
        'importo_tot' => [parent::class, 'importo_tot', null],
        'indirizzi' => [parent::class, 'indirizzi', null],
        'q_prodotto_ordine' => [parent::class, 'q_prodotto_ordine', null],
        'quantita_prodotto' => [parent::class, 'quantita_prodotto', null],
        'stato' => [parent::class, 'stato', null],
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
