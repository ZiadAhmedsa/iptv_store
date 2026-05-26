<?php

use App\Models\GuideStep;

try {
    $steps = GuideStep::take(5)->get();
    foreach ($steps as $step) {
        echo "ID: {$step->id}, Path: {$step->image_path}, Full: {$step->full_image_url}\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
