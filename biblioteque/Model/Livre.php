<?php

namespace Model;

use User;

class Livre
{
    private int $id_livre;
    private String $title;
    private String $author;
    private String $editor;
    private array $key_words;
    private String $description;
    private ?String $url_cover;
    private String $evaluation;
    private int $host_id;
    private int $current_holder_id;
    private ?int $previous_holder_id;
    private bool $status;

    /**
     * @param String $title
     * @param String $author
     * @param String $editor
     * @param array $key_words
     * @param String $description
     * @param string|null $evaluation
     * @param Int $host_id
     * @param int $current_holder_id
     * @param int|null $previous_holder_id
     */
    public function __construct(
        int $id_livre,
        string $title,
        string $author,
        string $editor,
        array  $key_words,
        string $description,
        string $cover = null,
        string $evaluation = null,
        int    $host_id,
        ?int    $current_holder_id,
        ?int $previous_holder_id = null,
        bool   $status = true)
    {
        $this->id_livre = $id_livre;
        $this->title = $title;
        $this->author = $author;
        $this->editor = $editor;
        $this->key_words = $key_words;
        $this->description = $description;
        $this->url_cover = $cover;
        $this->evaluation = $evaluation;
        $this->host_id = $host_id;
        $this->current_holder_id = $current_holder_id;
        $this->previous_holder_id = $previous_holder_id;
        $this->status = $status;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getEditor(): string
    {
        return $this->editor;
    }

    public function setEditor(string $editor): void
    {
        $this->editor = $editor;
    }

    public function getKeyWords(): array
    {
        return $this->key_words;
    }

    public function setKeyWords(array $key_words): void
    {
        $this->key_words = $key_words;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getUrlCover(): ?string
    {
        return $this->url_cover;
    }

    public function setUrlCover(?string $url_cover): void
    {
        $this->url_cover = $url_cover;
    }

    public function getEvaluation(): string
    {
        return $this->evaluation;
    }

    public function setEvaluation(string $evaluation): void
    {
        $this->evaluation = $evaluation;
    }

    public function getHost(): int
    {
        return $this->host_id;
    }

    public function setHost(int $host): void
    {
        $this->host_id = $host;
    }

    public function getCurrentHolder(): int
    {
        return $this->current_holder_id;
    }

    public function setCurrentHolder(int $current_holder): void
    {
        $this->current_holder_id = $current_holder;
    }

    public function getPreviousHolder()
    {
        return $this->previous_holder_id;
    }

    public function setPreviousHolder(int $previous_holder): void
    {
        $this->previous_holder_id = $previous_holder;
    }

    public function getReferenceCode(): int
    {
        return $this->reference_code;
    }

    public function setReferenceCode(int $reference_code): void
    {
        $this->reference_code = $reference_code;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    public function getIdLivre(): int
    {
        return $this->id_livre;
    }
    public function getHostId(): int
    {
        return $this->host_id;
    }

    public function getCurrentHolderId(): int
    {
        return $this->current_holder_id;
    }

    public function getPreviousHolderId(): ?int
    {
        return $this->previous_holder_id;
    }


    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return "[Book]</br>Titre : $this->title</br>Auteur : $this->author</br>Description : $this->description</br> Disponibilité : " . ($this->status ? "disponible" : "non disponible") . "</br>Propriétaire : $this->host_id".var_dump($this->key_words);
    }


}