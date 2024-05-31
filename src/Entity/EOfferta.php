<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('offerta')]
class EOfferta{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id_offerta;

    #[ORM\Column(type: 'integer', columnDefinition:'DOUBLE(5,2)')]
    private $importo;

    #[ORM\Column(type: 'datetime')]
    private $data;

    #[ORM\ManyToOne(targetEntity: EAcquirente::class, inversedBy:'offerte')]
    #[ORM\JoinColumn(name:'acquirente', referencedColumnName:'id_acquirente')]
    private EAcquirente|null $acquirente = null;

    public function __construct($id_offerta,$importo,$data) {
        $this->id_offerta = $id_offerta;
        $this->importo=$importo;
        $this->data=$data;

    }

    /**
     * Get the value of id_offerta
     *
     * @return $id_offerta
     */
    public function getIdOfferta()
    {
        return $this->id_offerta;
    }

    /**
    * Set the value of id_offerta
    *
    * @param $id_offerta
    */   
    public function setIdOfferta($id_offerta)
    {
        $this->id_offerta = $id_offerta;

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
     * Get the value of data
     *
     * @return $data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
    * Set the value of data
    *
    * @param $data
    */   
    public function setData($data)
    {
        $this->data = $data;

    }

    /**
     * Get the value of acquirente
     *
     * @return $acquirente
     */
    public function getAcquirente()
    {
        return $this->acquirente;
    }

    /**
     * Set the value of acquirente
     *
     * @param $acquirente
     */
    public function setAcquirente($acquirente)
    {
        $this->acquirente = $acquirente;
    }
}