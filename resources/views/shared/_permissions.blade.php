<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" aria-expanded="{{'true' }}" aria-controls="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
                {{ $title or 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </a>
        </h4>
    </div>
    <div id="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" class="panel-collapse collapse {{ 'in' }}" role="tabpanel" aria-labelledby="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
        <div class="panel-body">
            <div class="row">
                @foreach($permissions as $perm)
                    <?php
                        $per_found = null;

                        if( isset($role) ) {
                            $per_found = $role->hasPermissionTo($perm->name);
                        }

                        // if( isset($user)) {
                        //     $per_found = $user->hasDirectPermission($perm->name);
                        // }
                    ?>
                    <?php
                    $permissions_1_colunas = ['view_financeiro_extrato', 'view_financeiro_grafico_de_contas', 'view_agendamento_clinica', 'view_minha_agenda'];
                    $permissions_2_colunas = [];
                    $permissions_3_colunas = ['edit_clinicas'];
                    $class = 'col-md-3';
                    if(in_array($perm->name, $permissions_1_colunas))
                        $class = 'col-md-12';
                    elseif (in_array($perm->name, $permissions_2_colunas))
                        $class = 'col-md-9';
                    elseif(in_array($perm->name, $permissions_3_colunas))
                        $class = 'col-md-6';
                    ?>

                    @if(!in_array($perm->name, ['delete_clinicas']))
                    <div class="{{ $class }}">
                        <div class="checkbox">
                            <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                            </label>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>