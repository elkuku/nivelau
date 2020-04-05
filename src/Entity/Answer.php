<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswerRepository")
 *
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="answer:list"}}},
 *     itemOperations={"get"},
 *      paginationEnabled=false
 * )
 *
 * @ApiFilter(SearchFilter::class, properties={"question": "partial"})
 */
class Answer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"answer:list", "answer:item"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"answer:list", "answer:item"})
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    public function __toString()
    {
        return substr($this->text, 0, 25).'...';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
