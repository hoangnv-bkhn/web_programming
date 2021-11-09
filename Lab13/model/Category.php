<?php
class Category {
    public string $id;
    public string $title;

    public function __construct(string $id, string $category) {
        $this->id = $id;
        $this->title = $category;
    }

    public function __toString() {
        return $this->id . " " . $this->title;
    }

    public function getId(): string {
        return $this->id;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function getCategory(): string {
        return $this->title;
    }

    public function setCategory(string $category): void {
        $this->title = $category;
    }
}