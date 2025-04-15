<?php

namespace app\controllers;

use app\models\Artwork;
use app\views\View;

class ArtworkController {
    private $artwork;
    private $view;

    public function __construct() {
        $this->artwork = new Artwork();
        $this->view = new View();
    }

    public function index() {
        $artworks = $this->artwork->all();
        $this->view->render('artworks/gallery', ['artworks' => $artworks]);
    }

    public function show($id) {
        $artwork = $this->artwork->find($id);
        if (!$artwork) {
            http_response_code(404);
            $this->view->render('errors/404');
            return;
        }
        $this->view->render('artworks/show', ['artwork' => $artwork]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateArtworkData($_POST);
            if ($data) {
                $this->artwork->createArtwork($data);
                header('Location: /artworks');
                exit;
            }
        }
        include __DIR__ . '/../views/artworks/create.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateArtworkData($_POST);
            if ($data) {
                $this->artwork->updateArtwork($id, $data);
                header('Location: /artworks/' . $id);
                exit;
            }
        }
        $artwork = $this->artwork->getArtworkById($id);
        if (!$artwork) {
            include __DIR__ . '/../views/404.php';
            return;
        }
        include __DIR__ . '/../views/artworks/edit.php';
    }

    public function delete($id) {
        $this->artwork->deleteArtwork($id);
        header('Location: /artworks');
        exit;
    }

    public function getArtworksByYear($year) {
        $artworks = $this->artwork->getByYear($year);
        $data = [
            'year' => $year,
            'artworks' => $artworks
        ];
        
        $this->view->render('artworks/year', $data);
    }

    public function getArtworksByClass($class) {
        $artworks = $this->artwork->getByClass($class);
        $data = [
            'class' => $class,
            'artworks' => $artworks
        ];
        
        $this->view->render('artworks/class', $data);
    }

    public function gallery() {
        $artworks = $this->artwork->getAll();
        $years = $this->artwork->getYears();
        $classes = $this->artwork->getClasses();

        $data = [
            'years' => $years,
            'classes' => $classes,
            'artworks' => $artworks
        ];

        $this->view->render('artworks/gallery', $data);
    }

    public function byYear($year) {
        $artworks = $this->artwork->where('year', $year);
        $this->view->render('artworks/gallery', [
            'artworks' => $artworks,
            'currentYear' => $year
        ]);
    }

    public function byClass($class) {
        $artworks = $this->artwork->where('class', $class);
        $this->view->render('artworks/gallery', [
            'artworks' => $artworks,
            'currentClass' => $class
        ]);
    }

    private function generateArtworkCard($artwork) {
        $class = htmlspecialchars($artwork['class_name'] ?? '');
        $imageUrl = htmlspecialchars($artwork['image_url']);
        $title = htmlspecialchars($artwork['title']);
        $medium = htmlspecialchars($artwork['medium']);
        $etsyUrl = htmlspecialchars($artwork['etsy_url'] ?? '');

        $card = "<div class='artwork-card' data-year='{$artwork['year']}' data-class='$class'>";
        $card .= "<div class='artwork-image'>";
        $card .= "<img src='$imageUrl' alt='$title'>";
        $card .= "</div>";
        $card .= "<div class='artwork-info'>";
        $card .= "<h3>$title</h3>";
        $card .= "<p class='year'>{$artwork['year']}</p>";
        
        if ($class) {
            $card .= "<p class='class'>$class</p>";
        }
        
        $card .= "<p class='medium'>$medium</p>";
        $card .= "<div class='artwork-actions'>";
        $card .= "<a href='/artworks/{$artwork['id']}' class='btn btn-primary'>View Details</a>";
        
        if ($etsyUrl) {
            $card .= "<a href='$etsyUrl' class='btn btn-success etsy-link' target='_blank'>View on Etsy</a>";
        }
        
        $card .= "</div></div></div>";
        
        return $card;
    }

    private function validateArtworkData($data) {
        $required = ['title', 'year', 'image_url'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }

        // Sanitize and validate data
        return [
            'title' => htmlspecialchars($data['title']),
            'year' => (int)$data['year'],
            'class_name' => !empty($data['class_name']) ? htmlspecialchars($data['class_name']) : null,
            'image_url' => htmlspecialchars($data['image_url']),
            'description' => !empty($data['description']) ? htmlspecialchars($data['description']) : null,
            'medium' => !empty($data['medium']) ? htmlspecialchars($data['medium']) : null,
            'dimensions' => !empty($data['dimensions']) ? htmlspecialchars($data['dimensions']) : null,
            'price' => !empty($data['price']) ? (float)$data['price'] : null,
            'etsy_url' => !empty($data['etsy_url']) ? htmlspecialchars($data['etsy_url']) : null
        ];
    }
} 