<div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <div class="ml-3">
        <h3>Permissions</h3>
        <ul id="permissionListRol">
            @foreach ($permissionsRole as $p)
                <li class="p-2 border border-purple-400 flex items-center gap-3 mb-1 per_{{ $p->id }}">
                    {{-- <form action="{{ route('role.delete.permission', $role->id) }}" method="post"> --}}
                    @csrf
                    @method('delete')

                    <input type="hidden" name="permission" value="{{ $p->id }}">

                    {{ $p->name }}
                    <button class='btn-sm btn-danger' type="submit" data-per-id='{{ $p->id }}'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                    {{-- </form> --}}
                </li>
            @endforeach
        </ul>

        <h3>Assign</h3>
        {{-- <form action="{{ route('role.assign.permission', $role->id) }}" method="post"> --}}
        @csrf
        <select name="permission">
            @foreach ($permissions as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>
        <button class='btn btn-primary' type="submit" id="buttonAsignPermission">Send</button>
        {{-- </form> --}}
    </div>
    <script>
        // asignacion permisos
        document.getElementById("buttonAsignPermission").addEventListener('click', function() {
            assignPermissionToRol({{ $role->id }});

        })

        function assignPermissionToRol(roleId) {

            let perId = document.querySelector('select[name="permission"]').value
            if (document.querySelector('.per_' + perId) !==
                null /*document.querySelector("#permissionListRol li input[value='"+perId+"']") */ ) {
                return alert('Permission already assigned')
            }

            axios.post('/dashboard/role/assign/permission/' + roleId, {
                'permission': perId
            }).then((res) => {
                document.querySelector('#permissionListRol').innerHTML += `         
        <li class="p-2 border border-purple-400 flex items-center gap-3 mb-1 per_${perId}">
            <input type="hidden" name="permission" value="${res.data.id}">
            ${res.data.name}
            <button class='btn-sm btn-danger' type="submit" data-per-id='${res.data.id}'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </button>
        </li>
                `

                setListenerToDeletePermision()

            })

        }
    </script>

    <script>
        function setListenerToDeletePermision() {
            // eliminacion permisos
            document.querySelectorAll("#permissionListRol button").forEach(b => {

                b.addEventListener('click',
                    function( /*event  event.target.parentNode.getAttribute('data-per-id') */ ) {

                        let perId = b.getAttribute('data-per-id')

                        axios.post('{{ route('role.delete.permission', $role->id) }}', {
                            'permission': perId
                        }).then((res) => {
                            document.querySelector('.per_' + perId).remove()
                        })
                    })
            });
        }

        setListenerToDeletePermision()
    </script>
</div>
