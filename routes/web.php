<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // employe
    //Route::resource('employees', 'EmployeesController');
    
    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::post('employees/ckmedia', 'EmployeesController@storeCKEditorImages')->name('employees.storeCKEditorImages');
    Route::resource('employees', 'EmployeesController');

    // Emploi
    Route::delete('emplois/destroy', 'EmploiController@massDestroy')->name('emplois.massDestroy');
    Route::resource('emplois', 'EmploiController');

    // Charges
    Route::delete('charges/destroy', 'ChargesController@massDestroy')->name('charges.massDestroy');
    Route::resource('charges', 'ChargesController');

    // Motif Charges
    Route::delete('motif-charges/destroy', 'MotifChargesController@massDestroy')->name('motif-charges.massDestroy');
    Route::resource('motif-charges', 'MotifChargesController');

    // Specilaltes
    Route::delete('specilaltes/destroy', 'SpecilalteController@massDestroy')->name('specilaltes.massDestroy');
    Route::resource('specilaltes', 'SpecilalteController');

    // Grades
    Route::delete('grades/destroy', 'GradeController@massDestroy')->name('grades.massDestroy');
    Route::resource('grades', 'GradeController');

    // Medecins
    Route::delete('medecins/destroy', 'MedecinsController@massDestroy')->name('medecins.massDestroy');
    Route::resource('medecins', 'MedecinsController');

    // Categories
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');
    Route::get('categories/{id}/articles', 'CategoryController@articles')->name('categories.articles');

    // Articles
    Route::delete('articles/destroy', 'ArticlesController@massDestroy')->name('articles.massDestroy');
    Route::resource('articles', 'ArticlesController');
    Route::get('articles/{article}/price', 'ArticlesController@price')->name('articles.price');
    Route::get('articles/{category}/{forme}/list', 'ArticlesController@getList')->name('articles.getList');

    // Genres
    Route::delete('genres/destroy', 'GenreController@massDestroy')->name('genres.massDestroy');
    Route::resource('genres', 'GenreController');

    // Patients
    Route::delete('patients/destroy', 'PatientController@massDestroy')->name('patients.massDestroy');
    Route::resource('patients', 'PatientController');

    // Type Visites
    Route::delete('type-visites/destroy', 'TypeVisiteController@massDestroy')->name('type-visites.massDestroy');
    Route::resource('type-visites', 'TypeVisiteController');

    // Rdv Statuses
    Route::delete('rdv-statuses/destroy', 'RdvStatusController@massDestroy')->name('rdv-statuses.massDestroy');
    Route::resource('rdv-statuses', 'RdvStatusController');

    // Type Prises
    Route::delete('appointment-canals/destroy', 'AppointmentCanalsController@massDestroy')->name('appointment-canals.massDestroy');
    Route::resource('appointment-canals', 'AppointmentCanalsController');
    // Appointment Canals
//    Route::delete('appointment-canals/destroy', 'AppointmentCanalsController@massDestroy')->name('appointment-canals.massDestroy');
//    Route::resource('appointment-canals', 'AppointmentCanalsController');
    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Ordonnances
    Route::delete('ordonnances/destroy', 'OrdonnanceController@massDestroy')->name('ordonnances.massDestroy');
    Route::post('ordonnances/media', 'OrdonnanceController@storeMedia')->name('ordonnances.storeMedia');
    Route::post('ordonnances/ckmedia', 'OrdonnanceController@storeCKEditorImages')->name('ordonnances.storeCKEditorImages');
    Route::resource('ordonnances', 'OrdonnanceController');
    Route::get('ordonnances/{ordonnance}/print', 'OrdonnanceController@printOrdonnance')->name('ordonnances.print');
    Route::get('ordonnances/{ordonnance}/livraison', 'OrdonnanceController@livraison')->name('ordonnances.livraison');
    Route::post('ordonnances/livraison', 'OrdonnanceController@livraisonStore')->name('ordonnances.livraison.store');

    // Forme Medicaments
    Route::delete('forme-medicaments/destroy', 'FormeMedicamentController@massDestroy')->name('forme-medicaments.massDestroy');
    Route::resource('forme-medicaments', 'FormeMedicamentController');

    // Consultations
    Route::delete('consultations/destroy', 'ConsultationController@massDestroy')->name('consultations.massDestroy');
    Route::resource('consultations', 'ConsultationController')->except(['create']);
    Route::get('consultations/{appointment}/rendez-vous/', 'ConsultationController@create')->name('consultations.create');

    // Consultation Statuses
    Route::delete('consultation-statuses/destroy', 'ConsultationStatusController@massDestroy')->name('consultation-statuses.massDestroy');
    Route::resource('consultation-statuses', 'ConsultationStatusController');

    // Type Consultations
    Route::delete('type-consultations/destroy', 'TypeConsultationController@massDestroy')->name('type-consultations.massDestroy');
    Route::resource('type-consultations', 'TypeConsultationController');

    // Consultation Prices
    Route::delete('consultation-prices/destroy', 'ConsultationPriceController@massDestroy')->name('consultation-prices.massDestroy');
    Route::resource('consultation-prices', 'ConsultationPriceController');

    // Factures
    Route::delete('factures/destroy', 'FactureController@massDestroy')->name('factures.massDestroy');
    Route::resource('factures', 'FactureController');
    Route::post('factures/filter', 'FactureController@filter')->name('factures.filter');

    // Facture Statuses
    Route::delete('facture-statuses/destroy', 'FactureStatusController@massDestroy')->name('facture-statuses.massDestroy');
    Route::resource('facture-statuses', 'FactureStatusController');

    // Paiement Statuses
    Route::delete('paiement-statuses/destroy', 'PaiementStatusController@massDestroy')->name('paiement-statuses.massDestroy');
    Route::resource('paiement-statuses', 'PaiementStatusController');

    // Paiements
    Route::delete('paiements/{id}/destroy/detail', 'PaiementsController@deleteDetail')->name('paiements.delete.detail');
    Route::delete('paiements/destroy', 'PaiementsController@massDestroy')->name('paiements.massDestroy');
    Route::resource('paiements', 'PaiementsController', ['except' => ['create']]);
    Route::get('paiements/{patient}/patient/', 'PaiementsController@create')->name('paiements.create');

    // Ordonnance Details
    Route::delete('ordonnance-details/destroy', 'OrdonnanceDetailsController@massDestroy')->name('ordonnance-details.massDestroy');
    Route::resource('ordonnance-details', 'OrdonnanceDetailsController');

    // Fournisseurs
    Route::delete('fournisseurs/destroy', 'FournisseursController@massDestroy')->name('fournisseurs.massDestroy');
    Route::resource('fournisseurs', 'FournisseursController');
    Route::get('fournisseurs/{fournisseur}/paiement/', 'FournisseursController@paiement')->name('fournisseurs.paiement');
    Route::post('fournisseurs/commandes/paiement/', 'FournisseursController@storePaiement')->name('fournisseurs.save-paiement');

    // Commandes
    Route::delete('commandes/destroy', 'CommandesController@massDestroy')->name('commandes.massDestroy');
    Route::resource('commandes', 'CommandesController');

    // Commande Details
    Route::resource('commande-details', 'CommandeDetailsController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Sales
    Route::get('sales/{sale}/print', 'SalesController@printSale')->name('sales.print');
    Route::delete('sales/destroy', 'SalesController@massDestroy')->name('sales.massDestroy');
    Route::resource('sales', 'SalesController');
    Route::resource('sale-details', 'SaleDetailsController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Type Soins
    Route::delete('type-soins/destroy', 'TypeSoinsController@massDestroy')->name('type-soins.massDestroy');
    Route::resource('type-soins', 'TypeSoinsController');
    Route::get('type-soins/{typeSoin}/price', 'TypeSoinsController@price')->name('type-soins.price');
    // Soins
    Route::delete('soins/destroy', 'SoinsController@massDestroy')->name('soins.massDestroy');
    Route::resource('soins', 'SoinsController');
    Route::get('soins/{patient}/create', 'SoinsController@createWP')->name('soins.create-wp');
    Route::get('soins/{soin}/print', 'SoinsController@soinPrint')->name('soins.print');


//    // Soins
//    Route::delete('soins/destroy', 'SoinsController@massDestroy')->name('soins.massDestroy');
//    Route::resource('soins', 'SoinsController');
    // Analysis
    Route::delete('analysis/destroy', 'AnalysesController@massDestroy')->name('analysis.massDestroy');
    Route::post('analysis/media', 'AnalysesController@storeMedia')->name('analysis.storeMedia');
    Route::post('analysis/ckmedia', 'AnalysesController@storeCKEditorImages')->name('analysis.storeCKEditorImages');
    Route::resource('analysis', 'AnalysesController');
    Route::get('analysis/{analysi}/print', 'AnalysesController@printAnalyse')->name('analysis.print');

    // Analyse Details
    Route::resource('analyse-details', 'AnalyseDetailsController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
    Route::resource('commande-paiements', 'CommandePaiementsController', ['except' => ['create', 'store', 'edit', 'update', 'show']]);

    // Cash Registers
    Route::delete('cash-registers/destroy', 'CashRegistersController@massDestroy')->name('cash-registers.massDestroy');
    Route::resource('cash-registers', 'CashRegistersController');

    // Operation Cashes
    Route::delete('operation-cashes/destroy', 'OperationCashsController@massDestroy')->name('operation-cashes.massDestroy');
    Route::resource('operation-cashes', 'OperationCashsController');
    
    // Notes
    Route::resource('notes', 'NotesController');
    Route::get('notes/{note}/print', 'NotesController@notePrint')->name('notes.print');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentsController', ['except' => ['create']]);
    Route::get('appointment/{patient}/rendez-vous/', 'AppointmentsController@create')->name('appointments.create');

    Route::get('appointment/{appointment}/print', 'AppointmentsController@printAppointment')->name('appointments.print');
    Route::get('appointment/{appointment}/confirm', 'AppointmentsController@confirm')->name('appointments.confirm');
    Route::get('appointment/{appointment}/abandon', 'AppointmentsController@abandon')->name('appointments.abandon');
    Route::get('appointment/{appointment}/cancel', 'AppointmentsController@cancel')->name('appointments.cancel');
    Route::post('appointment/filter', 'AppointmentsController@getAppointment')->name('appointments.filter');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
