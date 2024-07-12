<?php

namespace Proxies\__CG__;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class EUsato extends \EUsato implements \Doctrine\ORM\Proxy\InternalProxy
{
    use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as __load;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".'EProdotto'."\0".'category_name' => ['EProdotto', 'category_name', null],
        "\0".'EProdotto'."\0".'colore' => ['EProdotto', 'colore', null],
        "\0".'EProdotto'."\0".'descrizione' => ['EProdotto', 'descrizione', null],
        "\0".'EProdotto'."\0".'id_prodotto' => ['EProdotto', 'id_prodotto', null],
        "\0".'EProdotto'."\0".'immagini' => ['EProdotto', 'immagini', null],
        "\0".'EProdotto'."\0".'marca' => ['EProdotto', 'marca', null],
        "\0".'EProdotto'."\0".'modello' => ['EProdotto', 'modello', null],
        "\0".'EProdotto'."\0".'nome' => ['EProdotto', 'nome', null],
        "\0".'EProdotto'."\0".'q_prodotto_ordine' => ['EProdotto', 'q_prodotto_ordine', null],
        "\0".'EProdotto'."\0".'recensioni' => ['EProdotto', 'recensioni', null],
        "\0".'EProdotto'."\0".'resi' => ['EProdotto', 'resi', null],
        "\0".'EProdotto'."\0".'rimborsi' => ['EProdotto', 'rimborsi', null],
        "\0".'EProdotto'."\0".'venditore' => ['EProdotto', 'venditore', null],
        "\0".parent::class."\0".'asta' => [parent::class, 'asta', null],
        "\0".parent::class."\0".'floor_price' => [parent::class, 'floor_price', null],
        "\0".parent::class."\0".'offerte' => [parent::class, 'offerte', null],
        'asta' => [parent::class, 'asta', null],
        'category_name' => ['EProdotto', 'category_name', null],
        'colore' => ['EProdotto', 'colore', null],
        'descrizione' => ['EProdotto', 'descrizione', null],
        'discr' => [parent::class, 'discr', null],
        'floor_price' => [parent::class, 'floor_price', null],
        'id_prodotto' => ['EProdotto', 'id_prodotto', null],
        'immagini' => ['EProdotto', 'immagini', null],
        'marca' => ['EProdotto', 'marca', null],
        'modello' => ['EProdotto', 'modello', null],
        'nome' => ['EProdotto', 'nome', null],
        'offerte' => [parent::class, 'offerte', null],
        'q_prodotto_ordine' => ['EProdotto', 'q_prodotto_ordine', null],
        'recensioni' => ['EProdotto', 'recensioni', null],
        'resi' => ['EProdotto', 'resi', null],
        'rimborsi' => ['EProdotto', 'rimborsi', null],
        'venditore' => ['EProdotto', 'venditore', null],
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
