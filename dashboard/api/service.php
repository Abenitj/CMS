<?php
// service.php
require '../z_db.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$request = isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'], '/')) : [];

switch ($method) {
    case 'GET':
        getService($con, $request);
        break;
    case 'POST':
        createService($con);
        break;
    case 'PUT':
        updateService($con, $request);
        break;
    case 'DELETE':
        deleteService($con, $request);
        break;
    default:
        echo json_encode(['error' => 'Invalid request method']);
        break;
}

function getService($con, $request) {
    if (isset($request[0]) && !empty($request[0])) {
        $id = intval($request[0]);
        $stmt = $con->prepare('SELECT * FROM service WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $service = $result->fetch_assoc();
        if ($service) {
            echo json_encode($service);
        } else {
            echo json_encode(['error' => 'Service not found']);
        }
        $stmt->close();
    } else {
        $result = $con->query('SELECT * FROM service');
        $services = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($services);
    }
}

function createService($con) {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['service_title'], $input['service_desc'], $input['service_detail'], $input['ufile'])) {
        $stmt = $con->prepare('INSERT INTO service (service_title, service_desc, service_detail, ufile, upadated_at) VALUES (?, ?, ?, ?, NOW())');
        $stmt->bind_param('ssss', $input['service_title'], $input['service_desc'], $input['service_detail'], $input['ufile']);
        $stmt->execute();
        echo json_encode(['id' => $con->insert_id]);
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Invalid input']);
    }
}

function updateService($con, $request) {
    if (isset($request[0]) && !empty($request[0])) {
        $id = intval($request[0]);
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (isset($input['service_title'], $input['service_desc'], $input['service_detail'], $input['ufile'])) {
            $stmt = $con->prepare('UPDATE service SET service_title = ?, service_desc = ?, service_detail = ?, ufile = ?, upadated_at = NOW() WHERE id = ?');
            $stmt->bind_param('ssssi', $input['service_title'], $input['service_desc'], $input['service_detail'], $input['ufile'], $id);
            $stmt->execute();
            echo json_encode(['message' => 'Service updated']);
            $stmt->close();
        } else {
            echo json_encode(['error' => 'Invalid input']);
        }
    } else {
        echo json_encode(['error' => 'ID not specified']);
    }
}

function deleteService($con, $request) {
    if (isset($request[0]) && !empty($request[0])) {
        $id = intval($request[0]);
        $stmt = $con->prepare('DELETE FROM service WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        echo json_encode(['message' => 'Service deleted']);
        $stmt->close();
    } else {
        echo json_encode(['error' => 'ID not specified']);
    }
}
?>
