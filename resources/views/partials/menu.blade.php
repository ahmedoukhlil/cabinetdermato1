<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>

        @can('referenciel_access')
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.referenciel.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('type_consultation_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.type-consultations.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/type-consultations') || request()->is('admin/type-consultations/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.typeConsultation.title') }}
                    </a>
                </li>
                @endcan
                @can('type_visite_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.type-visites.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/type-visites') || request()->is('admin/type-visites/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.typeVisite.title') }}
                    </a>
                </li>
                @endcan
                @can('rdv_status_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.rdv-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/rdv-statuses') || request()->is('admin/rdv-statuses/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.rdvStatus.title') }}
                    </a>
                </li>
                @endcan
                @can('appointment_canal_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.appointment-canals.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/appointment-canals') || request()->is('admin/appointment-canals/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.appointmentCanal.title') }} 
                    </a>
                </li>
                @endcan
                @can('consultation_status_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.consultation-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/consultation-statuses') || request()->is('admin/consultation-statuses/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.consultationStatus.title') }}
                    </a>
                </li>
                @endcan
                @can('facture_status_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.facture-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/facture-statuses') || request()->is('admin/facture-statuses/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.factureStatus.title') }}
                    </a>
                </li>
                @endcan
                @can('paiement_status_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.paiement-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/paiement-statuses') || request()->is('admin/paiement-statuses/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.paiementStatus.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('user_management_access')
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.userManagement.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('permission_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.permission.title') }}
                    </a>
                </li>
                @endcan
                @can('role_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.role.title') }}
                    </a>
                </li>
                @endcan
                @can('user_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.user.title') }}
                    </a>
                </li>
                @endcan
                @can('audit_log_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.auditLog.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('administration_access')
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.administration.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('specilalte_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.specilaltes.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/specilaltes') || request()->is('admin/specilaltes/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.specilalte.title') }}
                    </a>
                </li>
                @endcan
                @can('grade_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.grades.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/grades') || request()->is('admin/grades/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.grade.title') }}
                    </a>
                </li>
                @endcan
                @can('consultation_price_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.consultation-prices.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/consultation-prices') || request()->is('admin/consultation-prices/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.consultationPrice.title') }}
                    </a>
                </li>
                @endcan
                @can('forme_medicament_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.forme-medicaments.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/forme-medicaments') || request()->is('admin/forme-medicaments/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.formeMedicament.title') }}
                    </a>
                </li>
                @endcan
                @can('type_soin_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.type-soins.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/soins') || request()->is('admin/soins/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-ambulance c-sidebar-nav-icon"></i>
                        {{ trans('cruds.type-soin.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan


        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle {{ request()->is('admin/medecins') || request()->is('admin/medecins/*') || request()->is('admin/patients') || request()->is('admin/patients/*') || request()->is('admin/consultations') || request()->is('admin/consultations/*') || request()->is('admin/appointments') || request()->is('admin/appointments/*') || request()->is('admin/appointment/*') || request()->is('admin/ordonnances') || request()->is('admin/ordonnances/*') || request()->is('admin/notes') || request()->is('admin/notes/*') || request()->is('admin/analysis') || request()->is('admin/analysis/*') || request()->is('admin/soins') || request()->is('admin/soins/*') ? 'active' : '' }}" href="#">
                <i class="fa-fw fas fa-ambulance c-sidebar-nav-icon"></i>
                Activité médicale
            </a>
            <ul class="c-sidebar-nav-dropdown-items">

                @can('medecin_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.medecins.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/medecins') || request()->is('admin/medecins/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user-graduate c-sidebar-nav-icon"></i>
                        {{ trans('cruds.medecin.title') }}
                    </a>
                </li>
                @endcan
                @can('patient_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.patients.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/patients') || request()->is('admin/patients/*') ? 'active' : '' }}">
                        <i class="fa-fw far fa-id-card c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.patient.title') }}
                    </a>
                </li>
                @endcan
                @can('appointment_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.appointments.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/appointments') || request()->is('admin/appointments/*') ? 'active' : '' }}">
                        <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.appointment.title') }}
                    </a>
                </li>
                @endcan
                @can('consultation_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.consultations.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/consultations') || request()->is('admin/consultations/*') ? 'active' : '' }}">
                        <i class="fa-fw far fa-eye c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.consultation.title') }}
                    </a>
                </li>
                @endcan
                @can('ordonnance_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.ordonnances.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/ordonnances') || request()->is('admin/ordonnances/*') ? 'active' : '' }}">
                        <i class="fa-fw far fa-edit c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.ordonnance.title') }}
                    </a>
                </li>
                @endcan
                @can('note_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.notes.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/notes') || request()->is('admin/notes/*') ? 'active' : '' }}">
                        <i class="fa-fw far fa-edit c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.note.title') }}
                    </a>
                </li>
                @endcan
                @can('analysi_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.analysis.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/analysis') || request()->is('admin/analysis/*') ? 'active' : '' }}">
                        <i class="fa-fw far fa-edit c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.analysi.title') }}
                    </a>
                </li>
                @endcan
                @can('soin_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.soins.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/soins') || request()->is('admin/soins/*') ? 'active' : '' }}">
                        <i class="fa-fw far fa-file-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.soin.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>


        @can('produit_access')
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle {{ request()->is('admin/categories') || request()->is('admin/categories/*') || 
                        request()->is('admin/articles') || request()->is('admin/articles/*') ||
                        request()->is('admin/commandes') || request()->is('admin/commandes/*') ||
                        request()->is('admin/sales') || request()->is('admin/sales/*') ||
                        request()->is('admin/commande-paiements') || request()->is('admin/commande-paiements/*')
                        
                ? 'active' : '' }}" href="#">
                <i class="fa-fw fab fa-product-hunt c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.produit.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('category_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.categories.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.category.title') }}
                    </a>
                </li>
                @endcan
                @can('article_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.articles.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/articles') || request()->is('admin/articles/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.article.title') }}
                    </a>
                </li>
                @endcan
                @can('commande_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.commandes.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/commandes') || request()->is('admin/commandes/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-dolly c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.commande.title') }}
                    </a>
                </li>
                @endcan
                @can('sale_access111')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.sales.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/sales') || request()->is('admin/sales/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-dolly c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.sale.title') }}
                    </a>
                </li>
                @endcan
                @can('commande_paiement_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.commande-paiements.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/commande-paiements') || request()->is('admin/commande-paiements/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.commandePaiements.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('fournisseur_access')
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.fournisseurs.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/fournisseurs') || request()->is('admin/fournisseurs/*') ? 'active' : '' }}">
                <i class="fa-fw fas fa-dolly c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.fournisseur.title') }}
            </a>
        </li>
        @endcan
        @can('facture_access')
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.factures.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/factures') || request()->is('admin/factures/*') ? 'active' : '' }}">
                <i class="fa-fw far fa-file-alt c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.facture.title') }}
            </a>
        </li>
        @endcan
        @can('paiement_access111')
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.paiements.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/paiements') || request()->is('admin/paiements/*') ? 'active' : '' }}">
                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.paiement.title') }}
            </a>
        </li>
        @endcan

        @can('grh_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/emplois*") ? "c-show" : "" }} {{ request()->is("admin/employees*") ? "c-show" : "" }} {{ request()->is("admin/motif-charges*") ? "c-show" : "" }} {{ request()->is("admin/charges*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.grh.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('emploi_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.emplois.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/emplois") || request()->is("admin/emplois/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.emploi.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('employee_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.employees.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/employees") || request()->is("admin/employees/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-address-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.employee.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('motif_charge_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.motif-charges.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/motif-charges") || request()->is("admin/motif-charges/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-pencil-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.motifCharge.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('charge_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.charges.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/charges") || request()->is("admin/charges/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.charge.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('cash_register_access111')
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.cash-registers.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/cash-registers') || request()->is('admin/cash-registers/*') ? 'active' : '' }}">
                <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.cashRegister.title') }}
            </a>
        </li>
        @endcan
        @can('operation_cash_access111')
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.operation-cashes.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/operation-cashes') || request()->is('admin/operation-cashes/*') ? 'active' : '' }}">
                <i class="fa-fw fas fa-exchange-alt c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.operationCash.title') }}
            </a>
        </li>
        @endcan
        @can('calendar_access')
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : '' }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @endcan

        <br/><br/><br/>
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
        @can('profile_password_edit')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                </i>
                {{ trans('global.change_password') }}
            </a>
        </li>
        @endcan
        @endif
        <a class="btn btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt"></i>  {{ trans('global.logout') }}
        </a>
    </ul>

</div>