<?php
namespace Services;

class TarificationService
{
    private const LAT_RESTAURANT = 44.8545292;
    private const LON_RESTAURANT = -0.5694775;
    private const PRIX_MATERIEL = 99;
    private const PRIX_SURPLUS_KM = 1.5;
    private const DISTANCE_GRATUITE_KM = 5;
    private const NOMBRE_PERSONNE_REDUCTION = 5;
    private const REDUCTION = 0.9; // 10% reduction (1 - 0.1)

    public static function calculerDistanceKm(string $adresse): ?float
    {
        $env = parse_ini_file(\ROOT_PATH . '/.env');
        $cle = $env['LOCATIONIQ_KEY'] ?? '';

        $url = 'https://us1.locationiq.com/v1/search?' . http_build_query([
                'key' => $cle,
                'q' => $adresse,
                'format' => 'json',
                'limit' => 1,
            ]);
        $reponse = @file_get_contents($url);
        if ($reponse === false) return null;
        $resultats = json_decode($reponse, true);
        if (empty($resultats[0]['lat']) || empty($resultats[0]['lon'])) return null;

        return self::distanceHaversine((float)$resultats[0]['lat'], (float)$resultats[0]['lon'], self::LAT_RESTAURANT, self::LON_RESTAURANT);
    }

    private static function distanceHaversine(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $rayonTerre = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;
        return $rayonTerre * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }

    public static function calculerPrixLivraison(float $distanceKm, float $prixTotal): array
    {
        $prixMateriel = self::PRIX_MATERIEL;
        $prixSurplusKm = self::PRIX_SURPLUS_KM;

        $prixMaterielStr = (string)$prixMateriel;
        $prixSurplusKmStr = (string)$prixSurplusKm;
        $distanceKmStr = (string)$distanceKm;
        $prixTotalStr = (string)$prixTotal;

        if ($distanceKm > self::DISTANCE_GRATUITE_KM) {
            $distanceSupplementaire = bcsub($distanceKmStr, (string)self::DISTANCE_GRATUITE_KM, 2);
            $prixTotalDistance = bcmul($distanceSupplementaire, $prixSurplusKmStr, 2);
        } else {
            $prixTotalDistance = '0.00';
        }

        $totalAvecMateriel = bcadd(bcadd($prixTotalStr, $prixMaterielStr, 2), $prixTotalDistance, 2);
        $totalSansMateriel = bcadd($prixTotalStr, $prixTotalDistance, 2);

        return [
            'prixMateriel' => $prixMateriel,
            'prixTotalDistance' => (float)$prixTotalDistance,
            'totalAvecMateriel' => (float)$totalAvecMateriel,
            'totalSansMateriel' => (float)$totalSansMateriel
        ];
    }

    public static function appliquerReduction(int $quantite, int $nombrePersonneMinimum, float $prixParPersonne): float
    {
        $prixParPersonneStr = (string)$prixParPersonne;
        $quantiteStr = (string)$quantite;

        if ($quantite >= ($nombrePersonneMinimum + self::NOMBRE_PERSONNE_REDUCTION)) {
            $prixTotal = bcmul(bcmul($prixParPersonneStr, $quantiteStr, 2), (string)self::REDUCTION, 2); // appliquer 10% de réduction
        } else {
            $prixTotal = bcmul($prixParPersonneStr, $quantiteStr, 2);
        }

        return $prixTotal;
    }
}