<?php

namespace Model;

use User;

class Livre
{
    private String $title;
    private String $author;
    private String $editor;
    private array $key_words;
    private String $description;
    private String $evaluation;
    private User $host;
    private User $current_holder;
    private User $previous_holder;
    private int $reference_code;
    private bool $status;

    /**
     * @param String $title
     * @param String $author
     * @param String $editor
     * @param array $key_words
     * @param String $description
     * @param string|null $evaluation
     * @param User $host
     * @param User $current_holder
     * @param User|null $previous_holder
     * @param int $reference_code
     */
    public function __construct(
        string $title,
        string $author,
        string $editor,
        array $key_words,
        string $description,
        string $evaluation = null,
        User $host,
        User $current_holder,
        User $previous_holder= null,
        int $reference_code,
        bool $status = true)
    {
        $this->title = $title;
        $this->author = $author;
        $this->editor = $editor;
        $this->key_words = $key_words;
        $this->description = $description;
        $this->evaluation = $evaluation;
        $this->host = $host;
        $this->current_holder = $current_holder;
        $this->previous_holder = $previous_holder;
        $this->reference_code = $reference_code;
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

    public function getEvaluation(): string
    {
        return $this->evaluation;
    }

    public function setEvaluation(string $evaluation): void
    {
        $this->evaluation = $evaluation;
    }

    public function getHost(): User
    {
        return $this->host;
    }

    public function setHost(User $host): void
    {
        $this->host = $host;
    }

    public function getCurrentHolder(): User
    {
        return $this->current_holder;
    }

    public function setCurrentHolder(User $current_holder): void
    {
        $this->current_holder = $current_holder;
    }

    public function getPreviousHolder(): User
    {
        return $this->previous_holder;
    }

    public function setPreviousHolder(User $previous_holder): void
    {
        $this->previous_holder = $previous_holder;
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



    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return "[Code de ref : $this->reference_code] Titre : $this->title Auteur : $this->author Description : $this->description Disponibilité : ".($this->status)?" disponible":" non disponible"." Propriétaire : $this->host";
    }


}