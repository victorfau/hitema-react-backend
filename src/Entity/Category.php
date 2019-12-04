<?php
/**
 * editor : victor fau
 * contact : victorrfau@gmail.com
 * context : school
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category implements \JsonSerializable {
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;

	/**
	 * @ORM\ManyToMany(targetEntity="App\Entity\Recette", mappedBy="relation")
	 */
	private $recettes;

	public function __construct(){
		$this->recettes = new ArrayCollection();
	}


	public function getId(): ?int{
		return $this->id;
	}

	public function getName(): ?string{
		return $this->name;
	}

	public function setName(string $name): self{
		$this->name = $name;

		return $this;
	}


	/**
	 * @return Collection|Recette[]
	 */
	public function getRecettes(): Collection{
		return $this->recettes;
	}

	public function addRecette(Recette $recette): self{
		if(!$this->recettes->contains($recette)){
			$this->recettes[] = $recette;
			$recette->addRelation($this);
		}

		return $this;
	}

	public function removeRecette(Recette $recette): self{
		if($this->recettes->contains($recette)){
			$this->recettes->removeElement($recette);
			$recette->removeRelation($this);
		}

		return $this;
	}
	public function jsonSerialize(): array{
		return [
			'id' => $this->getId(),
			'name' => $this->getName()
		];
	}
}
