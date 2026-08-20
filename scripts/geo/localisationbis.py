import sys
import json
from geopy.distance import geodesic
from geopy.geocoders import Nominatim


def get_coordonnees(adresse):
    geolocator = Nominatim(user_agent="my_geocoder")
    location = geolocator.geocode(adresse)
    if location is None:
        return None
    return (location.latitude, location.longitude)

def calculer_distance_km(coord1, coord2):
    return geodesic(coord1, coord2).km

if __name__ == "__main__":
    adresse_livraison = sys.argv[1]
    coordonnees_maison = (44.8545292, -0.5694775)
    
    coord_livraison = get_coordonnees(adresse_livraison)
    if coord_livraison is None:
        resultat = {"success": False, "distance": None}
    else:
        distance = calculer_distance_km(coordonnees_maison, coord_livraison)
        resultat = {"success": True, "distance": distance}

    print(json.dumps(resultat))





