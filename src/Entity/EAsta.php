<?php
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity]
#[ORM\Table('asta')]
class EAsta{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id_asta;

    #[ORM\Column(type: 'datetime')]
    private $data_creazione;

    #[ORM\Column(type: 'datetime')]
    private $data_fine;

    #[ORM\OneToOne(targetEntity: EUsato::class, mappedBy: 'asta')]
    private EUsato|null $usato = null;

    //#[ORM\Column(type: 'EOfferta')]
    private $ultima_offerta;

    public function __construct($id_asta,$data_creazione,$data_fine,$ultima_offerta){
        $this->id_asta=$id_asta;
        $this->data_creazione=$data_creazione;
        $this->data_fine=$data_fine;
        $this->ultima_offerta = $ultima_offerta;
    }

    /**
     * Get the value of id_asta
     *
     * @return $id_asta
     */
    public function getIdAsta()
    {
        return $this->id_asta;
    }

    /**
     * Get the value of data_creazione
     *
     * @return $data_creazione
     */
    public function getDataCreazione()
    {
        return $this->data_creazione;
    }

    /**
     * Set the value of data_creazione
     *
     * @param $data_creazione
     */
    public function setDataCreazione($data_creazione)
    {
        $this->data_creazione = $data_creazione;
    }

    /**
     * Get the value of data_fine
     *
     * @return $data_fine
     */
    public function getDataFine()
    {
        return $this->data_fine;
    }

    /**
     * Set the value of data_fine
     *
     * @param $data_fine
     */
    public function setDataFine($data_fine)
    {
        $this->data_fine = $data_fine;
    }
    
    /**
     * Get the value of ultima_offerta
     *
     * @return $ultima_offerta
     */
    public function getUltimaOfferta()
    {
        return $this->ultima_offerta;
    }

    /**
     * Set the value of ultima_offerta
     *
     * @param $ultima_offerta
     */
    public function setUltimaOfferta($ultima_offerta)
    {
        $this->ultima_offerta = $ultima_offerta;
    }
}

?>