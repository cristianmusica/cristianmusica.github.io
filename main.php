<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Prueba</title>
</head>
<body>
    <h1>Página de Prueba</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $api_url = "https://api-pasarela-sandbox.mcdesaqa.cl/payment-gateway/v1/orders";
        $api_key = "mKaTZ4yBm3rVFapqNctziKCvXsjD6fDO";

        $monto = $_POST["monto"];
        $tarjeta = $_POST["tarjeta"];

        $data = array(
            'monto' => $monto,
            'tarjeta' => $tarjeta,
            // Agregar otros datos necesarios para la transacción
        );

        $headers = array(
            "Content-Type: application/json",
            "Apikey: $api_key"
        );

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if ($response === false) {
            echo "Error de cURL: " . curl_error($ch);
        } else {
            $decoded_response = json_decode($response, true);
            echo "<p>Respuesta de la API:</p>";
            echo "<pre>" . print_r($decoded_response, true) . "</pre>";
        }

        curl_close($ch);
    }
    ?>

    <form method="post" action="">
        <label for="monto">Monto:</label>
        <input type="text" name="monto" id="monto" required>

        <br>

        <label for="tarjeta">Número de Tarjeta:</label>
        <input type="text" name="tarjeta" id="tarjeta" required>

        <br>

        <button type="submit">Realizar Pago</button>
    </form>
</body>
</html>
