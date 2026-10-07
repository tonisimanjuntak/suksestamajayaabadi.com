<?php

namespace App\Helpers;

class PpnHelper
{
    /**
     * Membulatkan nilai PPN sesuai aturan faktur pajak:
     * - Jika angka desimal < 0,50 → dibulatkan ke bawah (floor)
     * - Jika angka desimal ≥ 0,50 → dibulatkan ke atas (ceil)
     * 
     * @param float|int|string $value
     * @return int
     */
    public static function roundPPN($value)
    {
        return (int) floor((float)$value + 0.5);
    }
}
