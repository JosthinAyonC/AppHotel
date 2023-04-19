<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservacion
 *
 * @ORM\Table(name="reservacion", indexes={@ORM\Index(name="IDX_8F062673C610874B", columns={"id_reserva"}), @ORM\Index(name="IDX_8F062673FCF8192D", columns={"id_usuario"})})
 * @ORM\Entity
 */
class Reservacion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reservacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="reservacion_id_reservacion_seq", allocationSize=1, initialValue=1)
     */
    private $idReservacion;

    /**
     * @var float|null
     *
     * @ORM\Column(name="precioextra", type="float", precision=10, scale=0, nullable=true)
     */
    private $precioextra;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @var \App\Entity\Reserva
     *
     * @ORM\ManyToOne(targetEntity="Reserva")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reserva", referencedColumnName="id_reserva")
     * })
     */
    private $idReserva;

    /**
     * @var \App\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

    public function getIdReservacion(): ?int
    {
        return $this->idReservacion;
    }

    public function getPrecioextra(): ?float
    {
        return $this->precioextra;
    }

    public function setPrecioextra(?float $precioextra): self
    {
        $this->precioextra = $precioextra;

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

    public function getIdReserva(): ?Reserva
    {
        return $this->idReserva;
    }

    public function setIdReserva(?Reserva $idReserva): self
    {
        $this->idReserva = $idReserva;

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
        return sprintf($this->idReserva);
    }

}
