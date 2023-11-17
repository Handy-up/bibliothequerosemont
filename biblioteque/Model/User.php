<?php
class User
{
    private int $id;
    private string $lastName;
    private string $firstName;
    private string $password;
    private ?string $profilePhoto;
    private string $shareCode;
    private string $registrationKey;
    private string $registrationDate;
    private bool $status;
    private String $fonction;

    /**
     * @param string $lastName
     * @param string $firstName
     * @param string $password
     * @param string|null $profilePhoto
     * @param string $shareCode
     * @param string $registrationKey
     * @param string|null $registrationDate
     * @param bool $status
     */
    public function __construct(
        int $id_user,
        string $lastName,
        string $firstName,
        string $password,
        string $profilePhoto = null,
        string $shareCode,
        string $registrationKey,
        string $registrationDate = null,
        bool $status = true,
        string $fonction)
    {
        $this->id =$id_user;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->password = $password;
        $this->profilePhoto = $profilePhoto;
        $this->shareCode = $shareCode;
        $this->registrationKey = $registrationKey;
        $this->registrationDate = $registrationDate;
        $this->status = $status;
        $this->fonction = $fonction;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getProfilePhoto(): ?string
    {
        return $this->profilePhoto;
    }

    public function setProfilePhoto(?string $profilePhoto): void
    {
        $this->profilePhoto = $profilePhoto;
    }

    public function getShareCode(): string
    {
        return $this->shareCode;
    }

    public function setShareCode(string $shareCode): void
    {
        $this->shareCode = $shareCode;
    }

    public function getRegistrationKey(): string
    {
        return $this->registrationKey;
    }

    public function setRegistrationKey(string $registrationKey): void
    {
        $this->registrationKey = $registrationKey;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    public function getRegistrationDate(): string
    {
        return $this->registrationDate;
    }

    public function connecter($connexion,$id,$pass_word){
        // implémentation
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFonction(): string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): void
    {
        $this->fonction = $fonction;
    }



    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return "[code de partage : $this->shareCode ] Nom : $this->firstName Prénom : $this->lastName Validité du compte : " . ($this->status ? "Compte valide" : "Compte non valide");

    }

}