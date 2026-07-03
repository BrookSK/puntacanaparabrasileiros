<?php
/**
 * Controller do Carrinho de Compras
 */
class CartController extends Controller
{
    public function index()
    {
        $cart = $_SESSION['cart'] ?? [];

        $this->wpView('site/cart/index', [
            'pageTitle' => 'Carrinho - Punta Cana para Brasileiros',
            'cart' => $cart,
        ]);
    }

    public function add()
    {
        if (!$this->isPost()) {
            $this->redirect('carrinho');
            return;
        }

        $itemType = $this->input('item_type'); // tour ou transfer
        $itemId = (int)$this->input('item_id');
        $packageId = (int)$this->input('package_id', 0);
        $date = $this->input('date');
        $timeSlot = $this->input('time_slot');
        $adults = (int)$this->input('adults', 1);
        $children = (int)$this->input('children', 0);
        $babies = (int)$this->input('babies', 0);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Buscar informações do item
        if ($itemType === 'tour') {
            $tourModel = new TourModel($this->db);
            $tour = $tourModel->findById($itemId);
            if (!$tour) {
                flash('error', 'Passeio não encontrado.');
                $this->redirect('experiencias');
                return;
            }

            // Calcular preço total baseado nas faixas etárias
            $totalPrice = 0;
            $packageName = '';

            if ($packageId) {
                $stmt = $this->db->prepare("SELECT * FROM tour_packages WHERE id = :id");
                $stmt->execute([':id' => $packageId]);
                $package = $stmt->fetch();
                $packageName = $package ? $package['name'] : '';

                $ageGroups = $tourModel->getAgeGroups($packageId);
                // Usar o primeiro grupo de adulto e criança para preço
                foreach ($ageGroups as $ag) {
                    if (strpos(strtolower($ag['label']), 'adult') !== false || $ag['min_age'] >= 18) {
                        $totalPrice += $ag['price'] * $adults;
                    } elseif ($ag['min_age'] < 18 && $ag['min_age'] > 2) {
                        $totalPrice += $ag['price'] * $children;
                    }
                }
            } else {
                $totalPrice = $tour['price_from'] * ($adults + $children);
            }

            $cartItem = [
                'id' => uniqid('cart_'),
                'item_type' => 'tour',
                'item_id' => $itemId,
                'name' => $tour['name'],
                'package_id' => $packageId,
                'package_name' => $packageName,
                'date' => $date,
                'time_slot' => $timeSlot,
                'adults' => $adults,
                'children' => $children,
                'babies' => $babies,
                'unit_price' => $tour['price_from'],
                'total_price' => $totalPrice,
                'image_url' => $tour['image_url'],
            ];

        } elseif ($itemType === 'transfer') {
            $routeId = (int)$this->input('route_id');
            $tripType = $this->input('trip_type', 'oneway');

            $stmt = $this->db->prepare(
                "SELECT r.*, v.name as vehicle_name, o.name as origin_name, d.name as destination_name
                 FROM transfer_routes r
                 JOIN transfer_vehicles v ON r.vehicle_id = v.id
                 JOIN transfer_locations o ON r.origin_id = o.id
                 JOIN transfer_locations d ON r.destination_id = d.id
                 WHERE r.id = :id"
            );
            $stmt->execute([':id' => $routeId]);
            $route = $stmt->fetch();

            if (!$route) {
                flash('error', 'Transfer não encontrado.');
                $this->redirect('transfer');
                return;
            }

            $totalPrice = ($tripType === 'roundtrip') ? $route['price'] * 2 : $route['price'];

            $cartItem = [
                'id' => uniqid('cart_'),
                'item_type' => 'transfer',
                'item_id' => $routeId,
                'name' => "Transfer: {$route['origin_name']} → {$route['destination_name']}",
                'package_name' => $route['vehicle_name'] . ' (' . ucfirst($route['service_type']) . ')',
                'date' => $date,
                'time_slot' => $timeSlot,
                'trip_type' => $tripType,
                'adults' => $adults,
                'children' => $children,
                'babies' => $babies,
                'unit_price' => $route['price'],
                'total_price' => $totalPrice,
                'image_url' => '',
            ];
        } else {
            flash('error', 'Tipo de item inválido.');
            $this->redirect('carrinho');
            return;
        }

        $_SESSION['cart'][] = $cartItem;

        // Se for AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            $this->json(['success' => true, 'cart_count' => count($_SESSION['cart'])]);
            return;
        }

        flash('success', 'Item adicionado ao carrinho!');
        $this->redirect('carrinho');
    }

    public function remove()
    {
        $cartId = $this->input('cart_id');

        if (isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($cartId) {
                return $item['id'] !== $cartId;
            });
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }

        flash('success', 'Item removido do carrinho.');
        $this->redirect('carrinho');
    }
}
