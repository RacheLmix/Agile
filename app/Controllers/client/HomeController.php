<?php

namespace App\Controllers\client;

use App\Controller;
use App\Models\Homestay;
use App\Models\Category;
use App\Models\Room;

class HomeController extends Controller
{
    protected $homestays;
    protected $categories;
    protected $rooms;
    public function __construct()
    {
        $this->homestays = new Homestay();
        $this->rooms = new Room();
        $this->categories = new Category();
    }

    public function index()
    {
        $keyword = trim($_GET['keyword'] ?? '');
        $location = trim($_GET['location'] ?? '');
        $category_id = trim($_GET['category_id'] ?? '');
        $sort = trim($_GET['sort'] ?? 'popular'); // Default sort is by popularity

        $keyword = $keyword ?: null;
        $location = $location ?: null;
        $category_id = $category_id ?: null;

        if ($keyword || $location || $category_id) {
            $homestays = $this->homestays->searchHomestays($keyword, $location, $category_id);
        } else {
            $homestays = $this->homestays->findAllHomestaysWithDetails();
        }

        // Apply sorting
        if (is_array($homestays) && !empty($homestays)) {
            switch ($sort) {
                case 'price_asc':
                    usort($homestays, function($a, $b) {
                        return ($a['price'] ?? 0) - ($b['price'] ?? 0);
                    });
                    break;
                case 'price_desc':
                    usort($homestays, function($a, $b) {
                        return ($b['price'] ?? 0) - ($a['price'] ?? 0);
                    });
                    break;
                case 'rating_desc':
                    usort($homestays, function($a, $b) {
                        return ($b['rating'] ?? 0) - ($a['rating'] ?? 0);
                    });
                    break;
                case 'popular':
                default:
                    // Default sorting (by popularity or whatever is default in your system)
                    break;
            }
        }

        $categories = $this->categories->all();

        return view("client.index", [
            'homestays' => $homestays,
            'location' => $location,
            'keyword' => $keyword,
            'category_id' => $category_id,
            'categories' => $categories,
            'sort' => $sort // Pass the sort parameter to the view
        ]);
    }

public function detail($id){
        // Get the homestay with all related details
        $homestay = $this->homestays->findHomestayWithDetails($id);

        if (!$homestay) {
            // If homestay not found, redirect to homepage
            redirect('/');
        }

        // Get rooms associated with this homestay
        $rooms = $this->rooms->findByHomestay($id);

        // Get similar homestays in the same category or location
        $similar_homestays = $this->homestays->findSimilarHomestays($homestay['category_id'], $homestay['location'], $id, 3);

        // Get categories for sidebar or filters
        $categories = $this->categories->findAll();

        // Pass all data to the view
        return view('client.detail', compact('homestay', 'rooms', 'similar_homestays', 'categories'));
    }
}