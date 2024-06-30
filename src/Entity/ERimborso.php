<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('rimborso')]
class ERimborso{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id_rimborso = null;

    #[ORM\Column(type: 'float', columnDefinition: 'DOUBLE(5,2)')]
    private $importo;

    #[ORM\Column(type: 'date')]
    private $data_erogazione;

    #[ORM\ManyToOne(targetEntity:EAcquirente::class, inversedBy:'rimborsi')]
    #[ORM\JoinColumn(name:'id_cliente_rimborsato', referencedColumnName:'id_acquirente', nullable:true)]
    private EAcquirente|null $cliente_rimborsato = null;

    #[ORM\ManyToOne(targetEntity:EVenditore::class, inversedBy:'rimborsi')]
    #[ORM\JoinColumn(name:'venditore', referencedColumnName:'id_venditore', nullable:true)]
    private EVenditore|null $venditore = null;

    #[ORM\ManyToOne(targetEntity:EProdotto::class, inversedBy:'rimborsi')]
    #[ORM\JoinColumn(name:'prodotto', referencedColumnName:'id_prodotto', nullable:true)]
    private EProdotto|null $prodotto = null;

    public function __construct($importo, $data_erogazione){
        $this->importo = $importo;
        $this->data_erogazione = $data_erogazione;
    }

    /**
     * Get the value of importo
     *
     * @return $importo
     */
    public function getImporto()
    {
        return $this->importo;
    }

    /**
     * Set the value of importo
     *
     * @param $importo
     */
    public function setImporto($importo)
    {
        $this->importo = $importo;
    }

    /**
     * Get the value of data_erogazione
     *
     * @return $data_erogazione
     */
    public function getDataErogazione()
    {
        return $this->data_erogazione;
    }

    /**
     * Set the value of data_erogazione
     *
     * @param $data_erogazione
     */
    public function setDataErogazione($data_erogazione)
    {
        $this->data_erogazione = $data_erogazione;
    }

    /**
     * Get the value of id_rimborso
     */
    public function getIdRimborso(): ?int
    {
        return $this->id_rimborso;
    }

    /**
     * Get the value of cliente_rimborsato
     */
    public function getClienteRimborsato(): ?EAcquirente
    {
        return $this->cliente_rimborsato;
    }

    /**
     * Set the value of cliente_rimborsato
     */
    public function setClienteRimborsato(?EAcquirente $cliente_rimborsato): self
    {
        $this->cliente_rimborsato = $cliente_rimborsato;

        return $this;
    }

    /**
     * Get the value of prodotto
     */
    public function getProdotto(): ?EProdotto
    {
        return $this->prodotto;
    }

    /**
     * Set the value of prodotto
     */
    public function setProdotto(?EProdotto $prodotto): self
    {
        $this->prodotto = $prodotto;

        return $this;
    }

    /**
     * Get the value of venditore
     */
    public function getVenditore(): ?EVenditore
    {
        return $this->venditore;
    }

    /**
     * Set the value of venditore
     */
    public function setVenditore(?EVenditore $venditore): self
    {
        $this->venditore = $venditore;

        return $this;
    }
}
?>