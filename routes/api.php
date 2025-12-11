<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Specilaltes
    Route::apiResource('specilaltes', 'SpecilalteApiController');

    // Grades
    Route::apiResource('grades', 'GradeApiController');

    // Medecins
    Route::apiResource('medecins', 'MedecinsApiController');

    // Categories
    Route::apiResource('categories', 'CategorieApiController');

    // Articles
    Route::apiResource('articles', 'ArticlesApiController');

    // Genres
    Route::apiResource('genres', 'GenreApiController');

    // Type Consultations
    Route::apiResource('type-consultations', 'TypeConsultationApiController');

    // Consultation Prices
    Route::apiResource('consultation-prices', 'ConsultationPriceApiController');

    // Patients
    Route::apiResource('patients', 'PatientApiController');

    // Type Visites
    Route::apiResource('type-visites', 'TypeVisiteApiController');

    // Rdv Statuses
    Route::apiResource('rdv-statuses', 'RdvStatusApiController');

    // Type Prises
    Route::apiResource('appointment-canals', 'AppointmentCanalApiController');

    // Ordonnances
    Route::post('ordonnances/media', 'OrdonnanceApiController@storeMedia')->name('ordonnances.storeMedia');
    Route::apiResource('ordonnances', 'OrdonnanceApiController');

    // Forme Medicaments
    Route::apiResource('forme-medicaments', 'FormeMedicamentApiController');

    // Consultations
    Route::apiResource('consultations', 'ConsultationApiController');

    // Consultation Statuses
    Route::apiResource('consultation-statuses', 'ConsultationStatusApiController');

    // Factures
    Route::apiResource('factures', 'FactureApiController');

    // Facture Statuses
    Route::apiResource('facture-statuses', 'FactureStatusApiController');

    // Paiement Statuses
    Route::apiResource('paiement-statuses', 'PaiementStatusApiController');

    // Paiements
    Route::apiResource('paiements', 'PaiementsApiController');

    // Ordonnance Details
    Route::apiResource('ordonnance-details', 'OrdonnanceDetailsApiController');

    // Commandes
    Route::apiResource('commandes', 'CommandesApiController');

    // Commande Details
    Route::apiResource('commande-details', 'CommandeDetailsApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Soins
    Route::apiResource('soins', 'SoinsApiController');

    // Analysis
    Route::post('analysis/media', 'AnalysesApiController@storeMedia')->name('analysis.storeMedia');
    Route::apiResource('analysis', 'AnalysesApiController');

    // Cash Registers
    Route::apiResource('cash-registers', 'CashRegistersApiController');

    // Operation Cashes
    Route::apiResource('operation-cashes', 'OperationCashsApiController');

    // Appointments
    Route::apiResource('appointments', 'AppointmentsApiController');
});
