@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.login') }}
                        </th>
                        <td>
                            {{ $user->login }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.is_doctor') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->is_doctor ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#user_articles" role="tab" data-toggle="tab">
                {{ trans('cruds.article.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_paiements" role="tab" data-toggle="tab">
                {{ trans('cruds.paiement.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_commandes" role="tab" data-toggle="tab">
                {{ trans('cruds.commande.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_operation_cashes" role="tab" data-toggle="tab">
                {{ trans('cruds.operationCash.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_articles">
            @includeIf('admin.users.relationships.userArticles', ['articles' => $user->userArticles])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_paiements">
            @includeIf('admin.users.relationships.userPaiements', ['paiements' => $user->userPaiements])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_commandes">
            @includeIf('admin.users.relationships.userCommandes', ['commandes' => $user->userCommandes])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_operation_cashes">
            @includeIf('admin.users.relationships.userOperationCashes', ['operationCashes' => $user->userOperationCashes])
        </div>
    </div>
</div>

@endsection