<?php
class BizCatComposite {
    private string $id;
    private string $name;
    private string $address;
    private string $city;
    private string $telephone;
    private string $url;
    private string $category_ID;

    public function __construct(string $id, string $name, string $address, string $city, string $telephone, string $url, string $category_ID) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->telephone = $telephone;
        $this->url = $url;
        $this->category_ID = $category_ID;
    }

    public function getCategoryID(): string {
        return $this->category_ID;
    }

    public function setCategoryID(string $category_ID): void {
        $this->category_ID = $category_ID;
    }

    public function getId(): string {
        return $this->id;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function setCity(string $city): void {
        $this->city = $city;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function setUrl(string $url): void {
        $this->url = $url;
    }
}

?>