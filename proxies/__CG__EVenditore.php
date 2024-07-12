<?php

namespace Proxies\__CG__;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class EVenditore extends \EVenditore implements \Doctrine\ORM\Proxy\InternalProxy
{
    use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as __load;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'aste' => [parent::class, 'aste', null],
        "\0".parent::class."\0".'cellulare' => [parent::class, 'cellulare', null],
        "\0".parent::class."\0".'cognome' => [parent::class, 'cognome', null],
        "\0".parent::class."\0".'email' => [parent::class, 'email', null],
        "\0".parent::class."\0".'id_venditore' => [parent::class, 'id_venditore', null],
        "\0".parent::class."\0".'nome' => [parent::class, 'nome', null],
        "\0".parent::class."\0".'partita_iva' => [parent::class, 'partita_iva', null],
        "\0".parent::class."\0".'password' => [parent::class, 'password', null],
        "\0".parent::class."\0".'prodotti' => [parent::class, 'prodotti', null],
        "\0".parent::class."\0".'rimborsi' => [parent::class, 'rimborsi', null],
        "\0".parent::class."\0".'segnalazioni' => [parent::class, 'segnalazioni', null],
        "\0".parent::class."\0".'societa' => [parent::class, 'societa', null],
        "\0".parent::class."\0".'username' => [parent::class, 'username', null],
        'aste' => [parent::class, 'aste', null],
        'cellulare' => [parent::class, 'cellulare', null],
        'cognome' => [parent::class, 'cognome', null],
        'email' => [parent::class, 'email', null],
        'id_venditore' => [parent::class, 'id_venditore', null],
        'nome' => [parent::class, 'nome', null],
        'partita_iva' => [parent::class, 'partita_iva', null],
        'password' => [parent::class, 'password', null],
        'prodotti' => [parent::class, 'prodotti', null],
        'rimborsi' => [parent::class, 'rimborsi', null],
        'segnalazioni' => [parent::class, 'segnalazioni', null],
        'societa' => [parent::class, 'societa', null],
        'username' => [parent::class, 'username', null],
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
