<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $num_permis
 * @property string $categorie
 * @property string $date_delivrance
 * @property string $date_expiration
 * @property int $annee_experience
 * @property int $is_permis_valide
 * @property string $image
 * @property int|null $vehicule_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Location> $locations
 * @property-read int|null $locations_count
 * @property-read \App\Models\Vehicule|null $vehicule
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereAnneeExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereCategorie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereDateDelivrance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereDateExpiration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereIsPermisValide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereNumPermis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chauffeur whereVehiculeId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperChauffeur {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $salaire
 * @property string $duree_contrat
 * @property string $type_contrat
 * @property int $etat_contrat
 * @property string $date_embauche
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Chauffeur|null $chauffeur
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereDateEmbauche($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereDureeContrat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereEtatContrat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereSalaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereTypeContrat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperContrat {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $heure_depart
 * @property string $heure_arrivee
 * @property string $date_location
 * @property string $lieu_depart
 * @property string $lieu_destination
 * @property int $prix_estime
 * @property int $chauffeur_id
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereChauffeurId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDateLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereHeureArrivee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereHeureDepart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLieuDepart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLieuDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location wherePrixEstime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperLocation {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $mode
 * @property int $location_id
 * @property int $montant
 * @property string $date_paiement
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Location $location
 * @method static \Illuminate\Database\Eloquent\Builder|Payement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereDatePaiement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPayement {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRoleUser {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nom
 * @property string|null $prenom
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $telephone
 * @property string|null $adresse
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $role_user_id
 * @property int|null $chauffeur_id
 * @property-read \App\Models\Chauffeur|null $chauffeurs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Location> $locations
 * @property-read int|null $locations_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\RoleUser|null $role_user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereChauffeurId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $matricule
 * @property string $image_vehicule
 * @property string $date_achat
 * @property int $km_defaut
 * @property int $km_actuel
 * @property string $statut
 * @property string $categorie
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Chauffeur|null $chauffeur
 * @method static \Database\Factories\VehiculeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereCategorie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereDateAchat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereImageVehicule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereKmActuel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereKmDefaut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereMatricule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperVehicule {}
}

