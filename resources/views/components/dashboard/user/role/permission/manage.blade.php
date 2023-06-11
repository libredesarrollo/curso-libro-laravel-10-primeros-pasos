<div>

    <div class="card card-gray">
        <h3>Assign Role</h3>

        <div class="ml-3">

            <ul id="rolesListUser">
                @foreach ($user->roles as $r)
                    <li class='role_{{ $r->id }} p-2 border border-purple-400 flex items-center gap-3 mb-1'>
                        {{ $r->name }}
                        <button class="btn-sm btn-danger" data-rol-id='{{ $r->id }}'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <select name="role">
            @foreach ($roles as $r)
                <option value="{{ $r->id }}">{{ $r->name }}</option>
            @endforeach
        </select>
        <button id="buttonAssignRole" class="btn btn-primary">Send</button>
    </div>

    <div class="card card-gray mt-5">
        <h3>Assign Permission</h3>

        <div class="ml-3">
            <ul id="permissionsListUser">
                @foreach ($user->permissions as $p)
                    <li class='p-2 border border-purple-400 flex items-center gap-3 mb-1 permission_{{ $p->id }}'>
                        {{ $p->name }}
                        <button class="btn-sm btn-danger" data-permission-id='{{ $p->id }}'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </li>
                @endforeach
            </ul>

            <select name="permission">
                @foreach ($permissions as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
            <button id="buttonAssignPermission" class="btn btn-primary">Send</button>
        </div>
    </div>
    {{-- ROLES MANAGE --}}
    <script>
        document.getElementById("buttonAssignRole").addEventListener('click', function() {
            assignRolToUser()
        })

        function assignRolToUser() {

            let roleId = document.querySelector('select[name="role"]').value

            if (document.querySelector("[data-rol-id='" + roleId + "']") !== null) {
                return alert('Role already assigned')
            }

            axios.post("{{ route('user.assign.role', $user->id) }}", {
                'role': roleId
            }).then((res) => {
                document.getElementById("rolesListUser").innerHTML += `
                <li class='p-2 border border-purple-400 flex items-center gap-3 mb-1 role_${res.data.id}'>
                ${res.data.name }
                <button class='btn-sm btn-danger' data-rol-id='${res.data.id }'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </li>
                `
                setListenerToDeleteRole()
            })


        }
    </script>

    <script>
        function setListenerToDeleteRole() {
            document.querySelectorAll("#rolesListUser button").forEach(b => {
                b.addEventListener('click', function() {
                    let roleId = b.getAttribute('data-rol-id')

                    axios.post("{{ route('user.delete.role', $user->id) }}", {
                        'role': roleId
                    }).then((res) => {
                        // eliminar li
                        document.querySelector('.role_' + roleId).remove()
                    })
                })
            });
        }

        setListenerToDeleteRole()
    </script>

    {{-- PERMISSION MANAGE --}}
    <script>
        document.getElementById("buttonAssignPermission").addEventListener('click', function() {
            assignPermissionToUser()
        })

        function assignPermissionToUser() {

            let permissionId = document.querySelector('select[name="permission"]').value

            // if(document.querySelector("[data-rol-id='"+roleId+"']") !== null){
            //     return alert('Role already assigned')
            // }

            axios.post("{{ route('user.assign.permission', $user->id) }}", {
                'permission': permissionId
            }).then((res) => {
                document.getElementById("permissionsListUser").innerHTML += `
            <li class='p-2 border border-purple-400 flex items-center gap-3 mb-1 permission_${res.data.id}'>
            ${res.data.name }
            <button class='btn-sm btn-danger' data-permission-id='${res.data.id }'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </button>
        </li>
            `
                setListenerToDeletePermission()
            })
        }
    </script>

    <script>
        function setListenerToDeletePermission() {
            document.querySelectorAll("#permissionsListUser button").forEach(b => {
                b.addEventListener('click', function() {
                    let permissionId = b.getAttribute('data-permission-id')

                    axios.post("{{ route('user.delete.permission', $user->id) }}", {
                        'permission': permissionId
                    }).then((res) => {
                        // eliminar li
                        document.querySelector('.permission_' + permissionId).remove()
                    })
                })
            });
        }

        setListenerToDeletePermission()
    </script>

</div>
