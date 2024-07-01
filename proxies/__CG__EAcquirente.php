<?php

namespace Proxies\__CG__;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class EAcquirente extends \EAcquirente implements \Doctrine\ORM\Proxy\InternalProxy
{
     use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as __load;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'carte_di_credito' => [parent::class, 'carte_di_credito', null],
        "\0".parent::class."\0".'cellulare' => [parent::class, 'cellulare', null],
        "\0".parent::class."\0".'cognome' => [parent::class, 'cognome', null],
        "\0".parent::class."\0".'email' => [parent::class, 'email', null],
        "\0".parent::class."\0".'id_acquirente' => [parent::class, 'id_acquirente', null],
        "\0".parent::class."\0".'indirizzi' => [parent::class, 'indirizzi', null],
        "\0".parent::class."\0".'nome' => [parent::class, 'nome', null],
        "\0".parent::class."\0".'offerte' => [parent::class, 'offerte', null],
        "\0".parent::class."\0".'ordini' => [parent::class, 'ordini', null],
        "\0".parent::class."\0".'password' => [parent::class, 'password', null],
        "\0".parent::class."\0".'recensioni' => [parent::class, 'recensioni', null],
        "\0".parent::class."\0".'resi' => [parent::class, 'resi', null],
        "\0".parent::class."\0".'rimborsi' => [parent::class, 'rimborsi', null],
        "\0".parent::class."\0".'username' => [parent::class, 'username', null],
        'carte_di_credito' => [parent::class, 'carte_di_credito', null],
        'cellulare' => [parent::class, 'cellulare', null],
        'cognome' => [parent::class, 'cognome', null],
        'email' => [parent::class, 'email', null],
        'id_acquirente' => [parent::class, 'id_acquirente', null],
        'indirizzi' => [parent::class, 'indirizzi', null],
        'nome' => [parent::class, 'nome', null],
        'offerte' => [parent::class, 'offerte', null],
        'ordini' => [parent::class, 'ordini', null],
        'password' => [parent::class, 'password', null],
        'recensioni' => [parent::class, 'recensioni', null],
        'resi' => [parent::class, 'resi', null],
        'rimborsi' => [parent::class, 'rimborsi', null],
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
