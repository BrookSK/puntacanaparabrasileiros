<?php
/**
 * Controller de Transfer (público)
 */
class TransferController extends Controller
{
    public function index()
    {
        // Servir o HTML original do WordPress para transfer
        require_once VIEWS_PATH . '/site/transfer-wp.php';
    }

    public function search()
    {
        $tripType = $this->input('trip_type', 'roundtrip'); // roundtrip, oneway, multiple
        $originId = (int)$this->input('origin_id');
        $destinationId = (int)$this->input('destination_id');
        $departureDate = $this->input('departure_date');
        $departureTime = $this->input('departure_time');
        $returnDate = $this->input('return_date');
        $returnTime = $this->input('return_time');
        $adults = (int)$this->input('adults', 1);
        $children = (int)$this->input('children', 0);
        $babies = (int)$this->input('babies', 0);
        $serviceType = $this->input('service_type', ''); // private, shared

        $totalPassengers = $adults + $children;

        // Buscar rotas disponíveis
        $where = "r.origin_id = :origin AND r.destination_id = :destination AND r.status = 'active' AND v.max_passengers >= :passengers";
        $params = [
            ':origin' => $originId,
            ':destination' => $destinationId,
            ':passengers' => $totalPassengers,
        ];

        if (!empty($serviceType)) {
            $where .= " AND r.service_type = :service_type";
            $params[':service_type'] = $serviceType;
        }

        $sql = "SELECT r.*, v.name as vehicle_name, v.type as vehicle_type, v.max_passengers, 
                       v.max_luggage, v.image_url as vehicle_image, v.description as vehicle_description,
                       v.amenities, o.name as origin_name, d.name as destination_name
                FROM transfer_routes r
                JOIN transfer_vehicles v ON r.vehicle_id = v.id
                JOIN transfer_locations o ON r.origin_id = o.id
                JOIN transfer_locations d ON r.destination_id = d.id
                WHERE {$where}
                ORDER BY r.price ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll();

        // Calcular valores de ida e volta
        foreach ($results as &$route) {
            $route['one_way_price'] = $route['price'];
            $route['round_trip_price'] = $route['price'] * 2;
            $route['total_price'] = ($tripType === 'roundtrip') ? $route['price'] * 2 : $route['price'];
        }

        // Buscar locais para o formulário
        $stmt = $this->db->query("SELECT * FROM transfer_locations WHERE status = 'active' ORDER BY name");
        $locations = $stmt->fetchAll();

        $this->view('site.transfer.results', [
            'pageTitle' => 'Resultados de Transfer - Punta Cana para Brasileiros',
            'results' => $results,
            'locations' => $locations,
            'searchParams' => [
                'trip_type' => $tripType,
                'origin_id' => $originId,
                'destination_id' => $destinationId,
                'departure_date' => $departureDate,
                'departure_time' => $departureTime,
                'return_date' => $returnDate,
                'return_time' => $returnTime,
                'adults' => $adults,
                'children' => $children,
                'babies' => $babies,
                'service_type' => $serviceType,
            ],
        ]);
    }
}
