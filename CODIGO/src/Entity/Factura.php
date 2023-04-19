<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Factura
 *
 * @ORM\Table(name="factura", indexes={@ORM\Index(name="IDX_F9EBA0099714EB84", columns={"id_reservacion"}), @ORM\Index(name="IDX_F9EBA009FCF8192D", columns={"id_usuario"})})
 * @ORM\Entity
 */
class Factura
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_factura", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="factura_id_factura_seq", allocationSize=1, initialValue=1)
     */
    private $idFactura;

    /**
     * @var float|null
     *
     * @ORM\Column(name="total", type="float", precision=10, scale=0, nullable=true)
     */
    private $total;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @var \App\Entity\Reservacion
     *
     * @ORM\ManyToOne(targetEntity="Reservacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reservacion", referencedColumnName="id_reservacion")
     * })
     */
    private $idReservacion;

    /**
     * @var \App\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

    public function getIdFactura(): ?int
    {
        return $this->idFactura;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIdReservacion(): ?Reservacion
    {
        return $this->idReservacion;
    }

    public function setIdReservacion(?Reservacion $idReservacion): self
    {
        $this->idReservacion = $idReservacion;

        return $this;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuario $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    public function __toString(){
        return sprintf($this->idFactura." ".$this->total );
    }
}
