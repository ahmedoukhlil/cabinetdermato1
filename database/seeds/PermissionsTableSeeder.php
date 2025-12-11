<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'specilalte_create',
            ],
            [
                'id'    => '18',
                'title' => 'specilalte_edit',
            ],
            [
                'id'    => '19',
                'title' => 'specilalte_show',
            ],
            [
                'id'    => '20',
                'title' => 'specilalte_delete',
            ],
            [
                'id'    => '21',
                'title' => 'specilalte_access',
            ],
            [
                'id'    => '22',
                'title' => 'administration_access',
            ],
            [
                'id'    => '23',
                'title' => 'grade_create',
            ],
            [
                'id'    => '24',
                'title' => 'grade_edit',
            ],
            [
                'id'    => '25',
                'title' => 'grade_show',
            ],
            [
                'id'    => '26',
                'title' => 'grade_delete',
            ],
            [
                'id'    => '27',
                'title' => 'grade_access',
            ],
            [
                'id'    => '28',
                'title' => 'medecin_create',
            ],
            [
                'id'    => '29',
                'title' => 'medecin_edit',
            ],
            [
                'id'    => '30',
                'title' => 'medecin_show',
            ],
            [
                'id'    => '31',
                'title' => 'medecin_delete',
            ],
            [
                'id'    => '32',
                'title' => 'medecin_access',
            ],
            [
                'id'    => '33',
                'title' => 'produit_access',
            ],
            [
                'id'    => '34',
                'title' => 'category_create',
            ],
            [
                'id'    => '35',
                'title' => 'category_edit',
            ],
            [
                'id'    => '36',
                'title' => 'category_show',
            ],
            [
                'id'    => '37',
                'title' => 'category_delete',
            ],
            [
                'id'    => '38',
                'title' => 'category_access',
            ],
            [
                'id'    => '39',
                'title' => 'article_create',
            ],
            [
                'id'    => '40',
                'title' => 'article_edit',
            ],
            [
                'id'    => '41',
                'title' => 'article_show',
            ],
            [
                'id'    => '42',
                'title' => 'article_delete',
            ],
            [
                'id'    => '43',
                'title' => 'article_access',
            ],
            [
                'id'    => '44',
                'title' => 'genre_create',
            ],
            [
                'id'    => '45',
                'title' => 'genre_edit',
            ],
            [
                'id'    => '46',
                'title' => 'genre_show',
            ],
            [
                'id'    => '47',
                'title' => 'genre_delete',
            ],
            [
                'id'    => '48',
                'title' => 'genre_access',
            ],
            [
                'id'    => '49',
                'title' => 'type_consultation_create',
            ],
            [
                'id'    => '50',
                'title' => 'type_consultation_edit',
            ],
            [
                'id'    => '51',
                'title' => 'type_consultation_show',
            ],
            [
                'id'    => '52',
                'title' => 'type_consultation_delete',
            ],
            [
                'id'    => '53',
                'title' => 'type_consultation_access',
            ],
            [
                'id'    => '54',
                'title' => 'consultation_price_create',
            ],
            [
                'id'    => '55',
                'title' => 'consultation_price_edit',
            ],
            [
                'id'    => '56',
                'title' => 'consultation_price_show',
            ],
            [
                'id'    => '57',
                'title' => 'consultation_price_delete',
            ],
            [
                'id'    => '58',
                'title' => 'consultation_price_access',
            ],
            [
                'id'    => '59',
                'title' => 'patient_create',
            ],
            [
                'id'    => '60',
                'title' => 'patient_edit',
            ],
            [
                'id'    => '61',
                'title' => 'patient_show',
            ],
            [
                'id'    => '62',
                'title' => 'patient_delete',
            ],
            [
                'id'    => '63',
                'title' => 'patient_access',
            ],
            [
                'id'    => '64',
                'title' => 'type_visite_create',
            ],
            [
                'id'    => '65',
                'title' => 'type_visite_edit',
            ],
            [
                'id'    => '66',
                'title' => 'type_visite_show',
            ],
            [
                'id'    => '67',
                'title' => 'type_visite_delete',
            ],
            [
                'id'    => '68',
                'title' => 'type_visite_access',
            ],
            [
                'id'    => '69',
                'title' => 'rdv_status_create',
            ],
            [
                'id'    => '70',
                'title' => 'rdv_status_edit',
            ],
            [
                'id'    => '71',
                'title' => 'rdv_status_show',
            ],
            [
                'id'    => '72',
                'title' => 'rdv_status_delete',
            ],
            [
                'id'    => '73',
                'title' => 'rdv_status_access',
            ],
            [
                'id'    => '74',
                'title' => 'type_prise_create',
            ],
            [
                'id'    => '75',
                'title' => 'type_prise_edit',
            ],
            [
                'id'    => '76',
                'title' => 'type_prise_show',
            ],
            [
                'id'    => '77',
                'title' => 'type_prise_delete',
            ],
            [
                'id'    => '78',
                'title' => 'type_prise_access',
            ],
            [
                'id'    => '79',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '80',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '81',
                'title' => 'ordonnance_create',
            ],
            [
                'id'    => '82',
                'title' => 'ordonnance_edit',
            ],
            [
                'id'    => '83',
                'title' => 'ordonnance_show',
            ],
            [
                'id'    => '84',
                'title' => 'ordonnance_delete',
            ],
            [
                'id'    => '85',
                'title' => 'ordonnance_access',
            ],
            [
                'id'    => '86',
                'title' => 'forme_medicament_create',
            ],
            [
                'id'    => '87',
                'title' => 'forme_medicament_edit',
            ],
            [
                'id'    => '88',
                'title' => 'forme_medicament_show',
            ],
            [
                'id'    => '89',
                'title' => 'forme_medicament_delete',
            ],
            [
                'id'    => '90',
                'title' => 'forme_medicament_access',
            ],
            [
                'id'    => '91',
                'title' => 'consultation_create',
            ],
            [
                'id'    => '92',
                'title' => 'consultation_edit',
            ],
            [
                'id'    => '93',
                'title' => 'consultation_show',
            ],
            [
                'id'    => '94',
                'title' => 'consultation_delete',
            ],
            [
                'id'    => '95',
                'title' => 'consultation_access',
            ],
            [
                'id'    => '96',
                'title' => 'consultation_status_create',
            ],
            [
                'id'    => '97',
                'title' => 'consultation_status_edit',
            ],
            [
                'id'    => '98',
                'title' => 'consultation_status_show',
            ],
            [
                'id'    => '99',
                'title' => 'consultation_status_delete',
            ],
            [
                'id'    => '100',
                'title' => 'consultation_status_access',
            ],
            [
                'id'    => '101',
                'title' => 'facture_create',
            ],
            [
                'id'    => '102',
                'title' => 'facture_edit',
            ],
            [
                'id'    => '103',
                'title' => 'facture_show',
            ],
            [
                'id'    => '104',
                'title' => 'facture_delete',
            ],
            [
                'id'    => '105',
                'title' => 'facture_access',
            ],
            [
                'id'    => '106',
                'title' => 'facture_status_create',
            ],
            [
                'id'    => '107',
                'title' => 'facture_status_edit',
            ],
            [
                'id'    => '108',
                'title' => 'facture_status_show',
            ],
            [
                'id'    => '109',
                'title' => 'facture_status_delete',
            ],
            [
                'id'    => '110',
                'title' => 'facture_status_access',
            ],
            [
                'id'    => '111',
                'title' => 'paiement_status_create',
            ],
            [
                'id'    => '112',
                'title' => 'paiement_status_edit',
            ],
            [
                'id'    => '113',
                'title' => 'paiement_status_show',
            ],
            [
                'id'    => '114',
                'title' => 'paiement_status_delete',
            ],
            [
                'id'    => '115',
                'title' => 'paiement_status_access',
            ],
            [
                'id'    => '116',
                'title' => 'paiement_create',
            ],
            [
                'id'    => '117',
                'title' => 'paiement_edit',
            ],
            [
                'id'    => '118',
                'title' => 'paiement_show',
            ],
            [
                'id'    => '119',
                'title' => 'paiement_delete',
            ],
            [
                'id'    => '120',
                'title' => 'paiement_access',
            ],
            [
                'id'    => '121',
                'title' => 'ordonnance_detail_create',
            ],
            [
                'id'    => '122',
                'title' => 'ordonnance_detail_edit',
            ],
            [
                'id'    => '123',
                'title' => 'ordonnance_detail_show',
            ],
            [
                'id'    => '124',
                'title' => 'ordonnance_detail_delete',
            ],
            [
                'id'    => '125',
                'title' => 'ordonnance_detail_access',
            ],
            [
                'id'    => '126',
                'title' => 'commande_create',
            ],
            [
                'id'    => '127',
                'title' => 'commande_edit',
            ],
            [
                'id'    => '128',
                'title' => 'commande_show',
            ],
            [
                'id'    => '129',
                'title' => 'commande_delete',
            ],
            [
                'id'    => '130',
                'title' => 'commande_access',
            ],
            [
                'id'    => '131',
                'title' => 'commande_detail_access',
            ],
            [
                'id'    => '132',
                'title' => 'soin_create',
            ],
            [
                'id'    => '133',
                'title' => 'soin_edit',
            ],
            [
                'id'    => '134',
                'title' => 'soin_show',
            ],
            [
                'id'    => '135',
                'title' => 'soin_delete',
            ],
            [
                'id'    => '136',
                'title' => 'soin_access',
            ],
            [
                'id'    => '137',
                'title' => 'analysi_create',
            ],
            [
                'id'    => '138',
                'title' => 'analysi_edit',
            ],
            [
                'id'    => '139',
                'title' => 'analysi_show',
            ],
            [
                'id'    => '140',
                'title' => 'analysi_delete',
            ],
            [
                'id'    => '141',
                'title' => 'analysi_access',
            ],
            [
                'id'    => '142',
                'title' => 'reverenciel_access',
            ],
            [
                'id'    => '143',
                'title' => 'analyse_detail_access',
            ],
            [
                'id'    => '144',
                'title' => 'cash_register_create',
            ],
            [
                'id'    => '145',
                'title' => 'cash_register_edit',
            ],
            [
                'id'    => '146',
                'title' => 'cash_register_show',
            ],
            [
                'id'    => '147',
                'title' => 'cash_register_delete',
            ],
            [
                'id'    => '148',
                'title' => 'cash_register_access',
            ],
            [
                'id'    => '149',
                'title' => 'operation_cash_create',
            ],
            [
                'id'    => '150',
                'title' => 'operation_cash_edit',
            ],
            [
                'id'    => '151',
                'title' => 'operation_cash_show',
            ],
            [
                'id'    => '152',
                'title' => 'operation_cash_delete',
            ],
            [
                'id'    => '153',
                'title' => 'operation_cash_access',
            ],
            [
                'id'    => '154',
                'title' => 'appointment_create',
            ],
            [
                'id'    => '155',
                'title' => 'appointment_edit',
            ],
            [
                'id'    => '156',
                'title' => 'appointment_show',
            ],
            [
                'id'    => '157',
                'title' => 'appointment_delete',
            ],
            [
                'id'    => '158',
                'title' => 'appointment_access',
            ],
            [
                'id'    => '159',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
