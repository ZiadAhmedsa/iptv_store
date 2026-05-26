<?php
$football = 'C:\Users\Zaid\.gemini\antigravity\brain\28556da1-6bc7-4a88-8552-0ceb72887cc9\premium_football_stadium_1779776332957.png';
$cinema = 'C:\Users\Zaid\.gemini\antigravity\brain\28556da1-6bc7-4a88-8552-0ceb72887cc9\premium_cinema_movies_1779776360987.png';

$dest_dir = __DIR__ . '/assets/images';
if (!is_dir($dest_dir)) {
    mkdir($dest_dir, 0777, true);
}

$res1 = copy($football, $dest_dir . '/football_bg.png');
$res2 = copy($cinema, $dest_dir . '/cinema_bg.png');

echo json_encode([
    'football_copied' => $res1,
    'cinema_copied' => $res2,
    'football_exists_source' => file_exists($football),
    'cinema_exists_source' => file_exists($cinema)
]);
