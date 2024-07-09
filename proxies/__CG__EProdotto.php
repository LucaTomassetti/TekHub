<?php

namespace Proxies\__CG__;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class EProdotto extends \EProdotto implements \Doctrine\ORM\Proxy\InternalProxy
{
     use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as __load;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'category_name' => [parent::class, 'category_name', null],
        "\0".parent::class."\0".'colore' => [parent::class, 'colore', null],
        "\0".parent::class."\0".'descrizione' => [parent::class, 'descrizione', null],
        "\0".parent::class."\0".'id_prodotto' => [parent::class, 'id_prodotto', null],
        "\0".parent::class."\0".'immagini' => [parent::class, 'immagini', null],
        "\0".parent::class."\0".'marca' => [parent::class, 'marca', null],
        "\0".parent::class."\0".'modello' => [parent::class, 'modello', null],
        "\0".parent::class."\0".'nome' => [parent::class, 'nome', null],
        "\0".parent::class."\0".'q_prodotto_ordine' => [parent::class, 'q_prodotto_ordine', null],
        "\0".parent::class."\0".'recensioni' => [parent::class, 'recensioni', null],
        "\0".parent::class."\0".'resi' => [parent::class, 'resi', null],
        "\0".parent::class."\0".'rimborsi' => [parent::class, 'rimborsi', null],
        "\0".parent::class."\0".'venditore' => [parent::class, 'venditore', null],
        'category_name' => [parent::class, 'category_name', null],
        'colore' => [parent::class, 'colore', null],
        'descrizione' => [parent::class, 'descrizione', null],
        'discr' => [parent::class, 'discr', null],
        'id_prodotto' => [parent::class, 'id_prodotto', null],
        'immagini' => [parent::class, 'immagini', null],
        'marca' => [parent::class, 'marca', null],
        'modello' => [parent::class, 'modello', null],
        'nome' => [parent::class, 'nome', null],
        'q_prodotto_ordine' => [parent::class, 'q_prodotto_ordine', null],
        'recensioni' => [parent::class, 'recensioni', null],
        'resi' => [parent::class, 'resi', null],
        'rimborsi' => [parent::class, 'rimborsi', null],
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
