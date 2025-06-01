<?php
session_start();

if (isset($_POST['emocion'])) {
    // Mapeo de emojis a emociones internas
    $emocion_map = [
        "😄 Alegria"     => "feliz",
        "😢 Tristeza"    => "triste",
        "😠 Ira"         => "enojado",
        "😨 Miedo"       => "miedo",
        "😲 Sorpresa"    => "sorprendido",
        "😐 Neutral"     => "neutral",
        "🤢 Asco"        => "asco"
    ];

    $emocion_emoji = $_POST['emocion'];
    $emocion_traducida = $emocion_map[$emocion_emoji] ?? "neutral";

    $_SESSION['emocion'] = $emocion_traducida;

    echo json_encode(["status" => "ok", "emocion" => $emocion_traducida]);
    exit;
} else {
    echo json_encode(["status" => "error", "msg" => "Emoción no recibida"]);
    exit;
}
?>
